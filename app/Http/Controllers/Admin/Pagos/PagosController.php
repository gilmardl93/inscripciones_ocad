<?php

namespace App\Http\Controllers\Admin\Pagos;

use App\Http\Controllers\Controller;
use App\Http\Requests\PagoUnitarioRequest;
use App\Http\Requests\PagosRequest;
use App\Models\Catalogo;
use App\Models\Colegio;
use App\Models\Cronograma;
use App\Models\Evaluacion;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Alert;
use DB;
use Validator;
class PagosController extends Controller
{
	private $cuentaUNI;


	function __construct()
	{
		$this->cuentaUNI = '978853000001';
	}
    public function index()
    {
    	return view('admin.pagos.index');
    }
    public function show()
    {
        return view('admin.pagos.show');
    }
    public function lista()
    {
	    $Lista = Recaudacion::with('Postulantes')->get();
	    $res['data'] = $Lista;
	    return $res;
    }
    public function pagocreate(PagoUnitarioRequest $request)
    {
        $servicio = Servicio::find($request->servicio);
        $pos = Postulante::Activos()->where('numero_identificacion',$request->input('codigo'))->first();
        $ser = $servicio->codigo;
        $cod = $request->input('codigo');
        $banco = $request->input('banco');
        $ref = $request->input('referencia');
        $des = $servicio->descripcion;
        $mon = $servicio->monto;
        $date = Carbon::now();
        $recibo = $ser.$cod;
        $validator = Validator::make(['recibo'=>$recibo], [
            'recibo' => 'unique:recaudacion,recibo',
        ],[
            'recibo.unique'=>'Este pago ya ha sido registrado'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $pago = Recaudacion::create([
                            'servicio'=>$ser,
                            'recibo'=>$recibo,
                            'descripcion'=>$des,
                            'monto'=>$mon,
                            'fecha'=>$date,
                            'codigo'=>$cod,
                            'nombrecliente'=>$pos->nombre_cliente,
                            'banco'=>$banco,
                            'referencia'=>$ref,
                            'idpostulante'=>$pos->id
                            ]);
        Alert::success('Pago Registrado con exito');
        return back();
    }
    public function pagochange(Request $request)
    {
        $servicio_ini = Servicio::find($request->servicio_ini);
        $servicio_fin = Servicio::find($request->servicio_fin);
        $recibo = $servicio_ini->codigo.$request->codigo;
        $recibo_nuevo = $servicio_fin->codigo.$request->codigo;
        $pos = Postulante::Activos()->where('numero_identificacion',$request->input('codigo'))->first();
        Recaudacion::where('recibo',$recibo)->update([
            'recibo'=>$recibo_nuevo,
            'servicio'=>$servicio_fin->codigo,
            'descripcion'=>$servicio_fin->descripcion,
            'monto'=>$servicio_fin->monto,
            ]);

        Alert::success('Pago Registrado con exito');
        return back();
    }
    public function store(PagosRequest $request)
    {
        #Guardo el archivo
    	$file = $request->file('file');
    	$nombre = $file->getClientOriginalName();
    	$archivo = '';
        $banco = '';
    	if (str_contains($nombre,'bws')) {

            $request->file('file')->storeAs('pagos/resumen_scotiabank/',$nombre);
            $archivo = storage_path('app/pagos/resumen_scotiabank/').$nombre;
            $archivo = file($archivo);
            $banco = 'scotiabank';

        }elseif (str_contains($nombre,'ConsMov')) {
            $request->file('file')->storeAs('pagos/financiero',$nombre);
            $archivo = storage_path('app/pagos/financiero/').$nombre;
            $archivo = file($archivo);
            $banco = 'financiero';
        }elseif (str_contains($nombre,'bcp')) {
            $request->file('file')->storeAs('pagos/bcp',$nombre);
            $archivo = storage_path('app/pagos/bcp/').$nombre;
            $archivo = file($archivo);
            $banco = 'bcp';
        }elseif (str_contains($nombre,'P')){
            $request->file('file')->storeAs('pagos/scotiabank',$nombre);
            $archivo = storage_path('app/pagos/scotiabank/').$nombre;
            $archivo = file($archivo);
            $banco = 'scotiabank';
    	}else{
            Alert::success('Este Archivo no es valido');
            return back();
        }
        #Preparo la data antes de subir a la DB
        $data = $this->PreparaData($archivo,$banco);
        #valido pagos
        #Si los datos son correctos ejecuto la subida de datos
        $error = $this->ValidoPagos($data);
        if ($error['correcto']) {
            if (count($data)>0) {
                Alert::success(count($data).' Pagos Nuevos se han registrado');
                foreach ($data as $key => $item) {
                    Recaudacion::create([
                        'recibo'=>$item['recibo'],
                        'servicio'=>$item['servicio'],
                        'descripcion'=>$item['descripcion'],
                        'monto'=>$item['monto'],
                        'fecha'=>$item['fecha'],
                        'codigo'=>$item['codigo'],
                        'nombrecliente'=>$item['nombrecliente'],
                        'banco'=>$item['banco'],
                        'referencia'=>$item['referencia'],
                        ]);
                }
            } else {
                Alert::success('No hay Pagos Nuevos');
            }
            return back();

        } else {
            switch ($error['tipo_error']) {
                case 'Codigo':
                    Alert::danger('Error de Codigos')->details('Los siguientes codigos no existen')->items($error['data']);
                    break;
                case 'Partida':
                    Alert::danger('Error de Partida')
                         ->details('El pago contiene una partida que no corresponde al monto pagado')
                         ->items([
                                 'codigo postulante: '.$error['codigo'],
                                 'Servicio: '.$error['servicio'],
                                 'Partida: '.$error['partida'],
                                 'Monto: '.$error['monto']
                                 ]);
                    break;

            }
            return back();
        }

    }
    public function ValidoPagos($data)
    {
        #Valido existencia de codigo
        $postulantes = Postulante::select('numero_identificacion as codigo')
                                 ->whereIn('numero_identificacion',array_pluck($data,'codigo'))->IsNull(0)->pluck('codigo');
        $codigo = array_diff(array_pluck($data,'codigo'),$postulantes->toArray());

        if(count($codigo)>0)$collection = collect(['correcto'=>false,'tipo_error'=>'Codigo','data'=>$codigo]);
        else $collection = collect(['correcto'=>true,'data'=>$data]);

        if(!$collection['correcto'])return $collection;

        #Valido coherencia de partida y monto depositado
        $servicios = Servicio::Activo()->get();

        foreach ($data as $key => $item) {
            $servicio = $servicios->where('codigo', $item['servicio'])->where('monto',$item['monto']);

            if($servicio->count()==0){
                $collection = collect([
                                        'correcto'=>false,'tipo_error'=>'Partida',
                                        'codigo'=>$item['codigo'],'servicio'=>$item['servicio'],'monto'=>$item['monto'],'partida'=>$item['partida']
                                        ]);
                break;
            }
        }
        if(!$collection['correcto'])return $collection;

        return $collection;
    }
    public function PreparaData($archivo,$banco)
    {
        $i = 0;
        $data = [];
        switch ($banco) {
            case 'financiero':
                $servicios = Servicio::Activo()->get();
                foreach ($archivo as $key => $value) {
                    if (strlen(trim($value)) > 0 ) {
                        $operacion = substr(trim(strtok($value, "\t")), -6);
                        $recibo = substr(trim(strtok("\t")),-8);
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $banco = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $dni = trim(strtok("\t"));
                        $cliente = trim(strtok("\t"));
                        $monto = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $fecha = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $descripcion_banco = trim(strtok("\t"));

                        $partida = trim(strtok($descripcion_banco,"|"));

                        $servicio = $servicios->where('partida', $partida);

                        if(!$servicio->isEmpty()){
                            $key = $servicio->keys()[0];
                        }else{
                            $key = 0;
                            $servicio[$key] = new Servicio(['codigo'=>'No ubicado','descripcion'=>'---']);
                        }
                        $data[$i]['recibo'] = $servicio[$key]->codigo.$dni;
                        $data[$i]['servicio'] = $servicio[$key]->codigo;
                        $data[$i]['descripcion'] = $servicio[$key]->descripcion;
                        $data[$i]['monto'] = (float)$monto/100;
                        $data[$i]['fecha'] = str_replace('/','-',$fecha);
                        $data[$i]['codigo'] = $dni;
                        $data[$i]['nombrecliente'] = $cliente;
                        $data[$i]['banco'] = $banco;
                        $data[$i]['partida'] = $partida;
                        $data[$i]['referencia'] = 'recibo:'.$recibo.'- operacion:'.$operacion;
                        $i++;
                    }
                }
                break;

            case 'bcp':
                $servicios = Servicio::Activo()->get();
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D') {
                        $partida = (int)substr($value, 13 ,20);
                        $servicio = $servicios->where('partida', $partida);

                        if(!$servicio->isEmpty()){
                            $key = $servicio->keys()[0];
                        }else{
                            $key = 0;
                            $servicio[$key] = new Servicio(['codigo'=>'No ubicado','descripcion'=>'---']);
                        }

                        $data[$i]['recibo'] = $servicio[$key]->codigo.substr($value, 113 ,8);
                        $data[$i]['servicio'] = $servicio[$key]->codigo;
                        $data[$i]['descripcion'] = $servicio[$key]->descripcion;
                        $data[$i]['monto'] = (float)substr($value, 151 ,9)/100;
                        $data[$i]['fecha'] = substr($value, 73 ,4).'-'.substr($value, 77 ,2).'-'.substr($value, 79 ,2);
                        $data[$i]['codigo'] = substr($value, 113 ,8);
                        $data[$i]['nombrecliente'] = substr($value, 113 ,8);
                        $data[$i]['banco'] = $banco;
                        $data[$i]['partida'] = $partida;
                        $data[$i]['referencia'] = 'sucursal:'.substr($value, 178 ,6).'- operacion:'.substr($value, 184 ,6);
                        $i++;
                    }
                }

                break;

            default:
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' && substr($value, 33 ,3)=='INS') {
                        $data[$i]['recibo'] = substr($value, 15 ,11);
                        $data[$i]['servicio'] = substr($value, 15 ,3);
                        $data[$i]['descripcion'] = substr($value, 157 ,22);
                        $data[$i]['monto'] = (float)substr($value, 76 ,3);
                        $data[$i]['fecha'] = substr($value, 134 ,4).'-'.substr($value, 138 ,2).'-'.substr($value, 140 ,2);
                        $data[$i]['codigo'] = substr($value, 40 ,8);
                        $data[$i]['nombrecliente'] = substr($value, 48 ,20);
                        $data[$i]['banco'] = $banco;
                        $data[$i]['referencia'] = ' ';
                        $i++;
                    }
                }
                break;
        }
        $recaudacion = Recaudacion::select('recibo')->pluck('recibo')->toArray();
        $diferencia = array_diff(array_pluck($data,'recibo'),$recaudacion);
        $diferencia = implode(",", $diferencia);
        $data = array_where($data, function ($value, $key) use($diferencia) {
            if (str_contains($diferencia,$value['recibo']))
            return $value;
        });

        return $data;
    }
    /**
     * Crea el archivo que se envia al banco
     * @return [type] [description]
     */
    public function create()
    {
    	$name = 'UNIADMIS.txt';
        Storage::disk('carteras')->delete($name);

        $servicios = Servicio::where('activo',1)->get();

        foreach ($servicios->chunk(5) as $key => $items) {
            foreach ($items as $key => $servicio) {

                $postulantes = $this->PostulantesAPagar($servicio->codigo);
                if($postulantes->count()>0){
                    $codigo_servicio = $servicio->codigo;
                    $codigo_cronograma = ($servicio->codigo=='507') ? 'INEX' : 'INSC' ;

                    $param = $this->Parametros($postulantes,$codigo_servicio,$codigo_cronograma);

                    Storage::disk('carteras')->append($name,$param['header']);
                    foreach ($postulantes as $key => $postulante) {
                        $detalle = $this->ParametrosDetalle($postulante,$codigo_servicio,$codigo_cronograma);
                        Storage::disk('carteras')->append($name, $detalle);
                    }
                    Storage::disk('carteras')->append($name, $param['footer']);
                }//end if
            }//end foreach
        }

    	Alert::success('Cartera Creada con exito');
    	return back();
    }
    public function PostulantesAPagar($codigo)
    {
        switch ($codigo) {
            case '475':
                $postulantes = Postulante::Prospecto()->IsNull(0)->Alfabetico()->get();
                break;
            case '464':
                $postulantes = Postulante::PagoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                break;
            case '465':
                $postulantes = Postulante::PagoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                break;
            case '466':
                $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                break;
            case '467':
                $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                break;
            case '469':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública'],['E1TE'])->IsNull(0)->get();
                break;
            case '470':
                $postulantes = Postulante::PagoGestion('Universidad',['Privada'],['E1TE'])->IsNull(0)->get();
                break;
            case '468':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública','Privada'],['E1TG','E1TGU'])->IsNull(0)->get();
               break;
            case '473':
                $postulantes = Postulante::PagoGestion(null,['Pública','Privada'],['E1DB','E1CD','E1CABI','E1CABC'])->IsNull(0)->get();
               break;
            case '474':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1')->IsNull(0)->get();
               break;
            case '516':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1')->IsNull(0)->get();
               break;
            case '507':
                $postulantes = Postulante::IsNull(0)->get();
               break;
            case '521':
                $postulantes = Postulante::PagoFormatoSemibeca()->IsNull(0)->get();
               break;
            default:
                $postulantes = collect([]);
                break;
        }
        return $postulantes;
    }
    public function Parametros($postulantes,$servicio,$cronograma)
    {
    	$servicio = Servicio::where('codigo',$servicio)->first();
    	$cronograma = Cronograma::where('codigo',$cronograma)->first();
    	$cabecera = collect([
    		$tipoCabecera = 'H',
	    	$Cuenta = pad($this->cuentaUNI,14,' '),
			$Concepto = $servicio->codigo,
			$TotalAlumnos = pad($postulantes->count(),7,'0','L'),
			$TotalSoles = pad(pad($servicio->valor_entero*$postulantes->count(),15,'0','L'),17,'0'),
			$TotalDolares = pad(0,17,'0','L'),
			$RucEmpresa = '02016900400',
			$FechaEnvio = Carbon::now()->format('Ymd'),
			$FechaVigencia = $cronograma->end_date,
			$FillerInicio = pad('0',3,'0','L'),
			$Diasmora = pad('0',3,'0','L'),
			$Tipomora = pad('0',2,'0','L'),
			$Moraflat = pad('0',9,'0','L'),
			$Porcentajemora = pad('0',8,'0','L'),
			$Montofijo = pad('0',9,'0','L'),
			$Tipodescuento = pad('0',2,'0','L'),
			$Montoadescontar = pad('0',9,'0','L'),
			$Porcentajedescuento = pad('0',8,'0','L'),
			$Diasdescuento = pad('0',3,'0','L'),
			$FillerFin = pad(' ',111,' ','L'),
			$Finderegistro = '*'
    	]);
		$pie = collect([
			$TipoPie = 'C',
			$Cuenta = pad($this->cuentaUNI,14,' '),
			$Concepto = $servicio->codigo,
			$CodigoConcepto = '01',
			$DescripcionConcepto = pad($servicio->descripcion_recortada,30,' '),
			$AfectoPagoParcial = '0',
			$Cuenta = pad($this->cuentaUNI,14,' '),
			$FillerFinPie = pad(' ',188,' ','L'),
			$FinderegistroPie = '*'
	    ]);
    	return [
    		'header' => $cabecera->implode(''),
    		'footer' => $pie->implode('')
    	];
    }
    public function ParametrosDetalle($postulante,$servicio,$cronograma)
    {
    	$servicio = Servicio::where('codigo',$servicio)->first();
        $cronograma = Cronograma::where('codigo',$cronograma)->first();
    	$detalle = collect([
	    	$TipoDetalle = 'D',
	    	$Cuenta = pad($this->cuentaUNI,14,' '),
	    	$Concepto = $servicio->codigo,
	    	$Codigo = pad($postulante->numero_identificacion,15,' '),
			$NroRecibo = 'INS'.pad($postulante->numero_identificacion,12,'0','L'),
			$CodigoAgrupacion = pad('',11,' '),
			$Situacion = '0',
			$MonedaCobro = '0000',
			$Cliente = pad(substr($postulante->nombre_cliente,0,20),20,' '),
			$DescripcionConcepto = pad($servicio->descripcion_recortada,30,' '),
			$CodigoConcepto = '01',
			$ImporteConcepto = pad($servicio->valor,9,'0','L'),
			$CodigoConcepto2 = pad('',2,' '),
			$ImporteConcepto2 = pad('0',9,'0'),
			$CodigoConcepto3 = pad('',2,' '),
			$ImporteConcepto3 = pad('0',9,'0'),
			$CodigoConcepto4 = pad('',2,' '),
			$ImporteConcepto4 = pad('0',9,'0'),
			$CodigoConcepto5 = pad('',2,' '),
			$ImporteConcepto5 = pad('0',9,'0'),
			$CodigoConcepto6 = pad('',2,' '),
			$ImporteConcepto6 = pad('0',9,'0'),
			$ImporteConcepto = pad($servicio->valor,15,'0','L'),
			$ImporteConcepto = pad($servicio->valor,15,'0','L'),
			$PorcentajeMinimo = pad('0',8,'0','L'),
			$OrdenCronologico = '1',
			$FechaEnvio = Carbon::now()->format('Ymd'),
			$FechaVigencia = str_replace('-', '', $cronograma->fecha_fin),
			$DiasProrroga = '000',
			$FillerFinDetalle = pad(' ',15,' ','L'),
			$FinderegistroDetalle = '*'
		]);
		return $detalle->implode('');
    }
    public function descarga()
    {
    	$headers = [];
    	return response()->download(
    			storage_path('app/carteras/UNIADMIS.txt'),
    			null,
    			$headers
    		);
    }
}
