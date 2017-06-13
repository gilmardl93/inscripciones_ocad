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
use Styde\Html\Facades\Alert;
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
        $servicio = Catalogo::table('SERVICIO')->first();
        $pago = Recaudacion::where('codigo',$request->input('codigo'))->where('servicio',$servicio->nombre)->first();
        $pos = Postulante::Activos()->where('dni',$request->input('codigo'))->first();
        $ser = $servicio->nombre;
        $cod = $request->input('codigo');
        $banco = $request->input('banco');
        $ref = $request->input('referencia');
        $des = $servicio->descripcion;
        $mon = $servicio->valor;
        $date = Carbon::now();

        $pago = Recaudacion::create([
                            'servicio'=>$ser,
                            'recibo'=>$ser.$cod,
                            'descripcion'=>$des,
                            'monto'=>$mon,
                            'fecha'=>$date,
                            'codigo'=>$cod,
                            'nombrecliente'=>$pos->nombre_cliente,
                            'banco'=>$banco,
                            'referencia'=>$ref,
                            'idpostulante'=>$pos->id
                            ]);
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

        }elseif (str_contains($nombre,'Pagos')) {
            $request->file('file')->storeAs('pagos/financiero',$nombre);
            $archivo = storage_path('app/pagos/financiero/').$nombre;
            $archivo = file($archivo);
            $banco = 'financiero';
        }else{
            $request->file('file')->storeAs('pagos/scotiabank',$nombre);
            $archivo = storage_path('app/pagos/scotiabank/').$nombre;
            $archivo = file($archivo);
            $banco = 'scotiabank';
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
                        ]);
                }
            } else {
                Alert::success('No hay Pagos Nuevos');
            }
            return back();

        } else {
            Alert::danger('Error de Codigos')->items($error['data']);
            return back();
        }

    }
    public function ValidoPagos($data)
    {
        #Valido existencia de codigo
        $postulantes = Postulante::select('numero_identificacion as codigo')
                                 ->whereIn('numero_identificacion',array_pluck($data,'codigo'))->IsNull(0)->pluck('codigo');
        $codigo = array_diff(array_pluck($data,'codigo'),$postulantes->toArray());
        if(count($codigo)>0){
            $collection = collect(['correcto'=>false,'data'=>$codigo]);
        }else{
            $collection = collect(['correcto'=>true,'data'=>$data]);
        }
        return $collection;
    }
    public function PreparaData($archivo,$banco)
    {
        $i = 0;
        $data = [];
        switch ($banco) {
            case 'financiero':
                # code...
                break;

            default:
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' && substr($value, 33 ,3)=='INS') {
                        $data[$i]['recibo'] = substr($value, 15 ,11);
                        $data[$i]['servicio'] = substr($value, 15 ,3);
                        $data[$i]['descripcion'] = substr($value, 157 ,22);
                        $data[$i]['monto'] = (float)substr($value, 77 ,2);
                        $data[$i]['fecha'] = substr($value, 134 ,4).'-'.substr($value, 138 ,2).'-'.substr($value, 140 ,2);
                        $data[$i]['codigo'] = substr($value, 40 ,8);
                        $data[$i]['nombrecliente'] = substr($value, 48 ,20);
                        $data[$i]['banco'] = $banco;
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
        foreach ($servicios as $key => $servicio) {

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

    	Alert::success('Cartera Creada con exito');
    	return back();
    }
    public function PostulantesAPagar($codigo)
    {
        switch ($codigo) {
            case '475':
                $postulantes = Postulante::Prospecto()->Alfabetico()->get();
                break;
            case '464':
                $postulantes = Postulante::PagoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->Alfabetico()->get();
                break;
            case '465':
                $postulantes = Postulante::PagoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->get();
                break;
            case '469':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública'],['E1TE'])->get();
                break;
            case '470':
                $postulantes = Postulante::PagoGestion('Universidad',['Privada'],['E1TE'])->get();
                break;
            case '468':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública','Privada'],['E1TG','E1TGU'])->get();
               break;
            case '473':
                $postulantes = Postulante::PagoGestion(null,['Pública','Privada'],['E1DB','E1CD','E1CABI','E1CABC'])->get();
               break;
            case '474':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1')->get();
               break;
            case '516':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1')->get();
               break;
            case '507':
                $postulantes = Postulante::IsNull(0)->get();
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
			$ImporteConcepto = pad(pad($servicio->valor,4,'0'),9,'0','L'),
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
			$ImporteConcepto = pad(pad($servicio->valor,4,'0'),15,'0','L'),
			$ImporteConcepto = pad(pad($servicio->valor,4,'0'),15,'0','L'),
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
