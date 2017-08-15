<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateIngresanteRequest;
use App\Models\Evaluacion;
use App\Models\Familiar;
use App\Models\Ingresante;
use App\Models\Postulante;
use App\Models\Recaudacion;
use DB;
use Illuminate\Http\Request;
use PDF;
use Validator;
class IngresantesController extends Controller
{
    public function index()
    {
    	$Lista = [];
    	return view('admin.ingresantes.index',compact('Lista'));
    }
    public function search(Request $request)
    {
        $rules = array (
                'dni' => 'required'
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()) {
            return [
                   'errors' => $validator->getMessageBag()->toArray()
                    ];
        }else {
            $name = strtoupper(trim($request->dni));
    	    $Lista = Postulante::has('ingresantes')
                               ->whereRaw("numero_identificacion||' '||clearstring(paterno)||' '||clearstring(materno)||clearstring(nombres) like '%$name%'")
                               ->get();
            if ($Lista->count()==0) {
                return[
                    'errors'=> ['dni'=>'El numero de DNI ingresado no existe']
                ];
            } else {
                return response ()->json ( $Lista );
            }

        }
    }
    public function show($id)
    {
    	$postulante = Postulante::with('ingresantes')->find($id);
        $ingresante = Ingresante::where('idpostulante',$postulante->id)->first();
    	return view('admin.ingresantes.show',compact('postulante','ingresante'));
    }
    public function update(UpdateIngresanteRequest $request,$id)
    {
        $data = $request->all();
        if(empty($data['numero_creditos']))$data['numero_creditos']=0;

        $ingresante = Ingresante::find($id);
        $ingresante->fill($data);
        $ingresante->save();
        return back();
    }
    public function pdfdatos($id)
    {
        $postulante = Postulante::find($id);
        $familiar = Familiar::where('idpostulante',$postulante->id)->orderBy('orden')->get();

        PDF::SetTitle('DATOS GENERALES DEL INGRESANTE');
        PDF::SetAutoPageBreak(false);
        PDF::AddPage('U','A4');
        #MARCO
        PDF::Rect(15, 15, 180, 270);
        #TITULO
        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','',22);
        PDF::Cell(170,15,"DATOS GENERALES DEL INGRESANTE",0,0,'C');
        #FOTO POSTULANTE
        PDF::Image($postulante->mostrar_foto_editada,20,35,25,35);
        PDF::SetXY(20,70);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'POSTULANTE',1,0,'C');
        #FOTO INGRESANTE
        if($postulante->ingresantes->foto)
        PDF::Image($postulante->ingresantes->foto,50,35,25,35);
        #
        PDF::SetXY(50,70);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'INGRESANTE',1,0,'C');
        #
        PDF::SetXY(90,35);
        PDF::SetFont('helvetica','B',13);
        PDF::Cell(105,5,$postulante->ingresantes->facultad,0,0,'R',0,'',1);
        #
        PDF::SetXY(90,42);
        PDF::SetFont('helvetica','B',13);
        PDF::Cell(105,5,$postulante->ingresantes->especialidad,0,0,'R',0,'',1);
        #
        PDF::SetXY(90,48);
        PDF::SetFont('helvetica','B',13);
        PDF::Cell(105,5,$postulante->identificacion,0,0,'R',0,'',1);
        #
        PDF::SetXY(90,54);
        PDF::SetFont('helvetica','',13);
        PDF::Cell(105,5,$postulante->codigo,0,0,'R',0,'',1);
        #
        PDF::SetXY(90,59);
        PDF::SetFont('helvetica','',13);
        PDF::Cell(105,5,$postulante->nombre_completo,0,0,'R',0,'',1);
        #
        PDF::SetXY(90,65);
        PDF::SetFont('helvetica','',13);
        PDF::Cell(105,5,mb_strtoupper($postulante->sexo,'UTF8'),0,0,'R',0,'',1);


        #
        $y=80;
        PDF::SetXY(20,$y);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'APELLIDOS Y NOMBRES DEL PADRE:',0,0,'L');
        #
        PDF::SetXY(100,$y);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($familiar[0]->nombre_completo,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+5);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'APELLIDOS Y NOMBRES DE LA MADRE:',0,0,'L');
        #
        PDF::SetXY(100,$y+5);
        PDF::SetFont('helvetica','B',8);
        PDF::Cell(70,5,mb_strtoupper($familiar[1]->nombre_completo,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+10);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'APELLIDOS Y NOMBRES DEL APODERADO:',0,0,'L');
        #
        PDF::SetXY(100,$y+10);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($familiar[2]->apoderado,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+15);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'LUGAR DE NACIMIENTO:',0,0,'L');
        #
        PDF::SetXY(100,$y+15);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->descripcion_ubigeo_nacimiento,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+20);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'FECHA DE NACIMIENTO:',0,0,'L');
        #
        PDF::SetXY(100,$y+20);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->fecha_nacimiento,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+25);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'DOMICILIO:',0,0,'L');
        #
        PDF::SetXY(100,$y+25);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->direccion,'UTF8'),0,0,'L');
        PDF::SetXY(100,$y+30);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->descripcion_ubigeo,'UTF8'),0,0,'L');
        #
        PDF::SetXY(20,$y+35);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'TELÉFONOS:',0,0,'L');
        #
        PDF::SetXY(100,$y+35);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,$postulante->telefonos,0,0,'L');
        #
        PDF::SetXY(20,$y+40);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'EMAIL:',0,0,'L');
        #
        PDF::SetXY(100,$y+40);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,$postulante->email,0,0,'L');
        #
        PDF::SetXY(20,$y+45);
        PDF::SetFont('helvetica','',8);
        $ie = (isset($postulante->idcolegio)) ? 'COLEGIO' : 'UNIVERSIDAD' ;
        PDF::Cell(80,5,$ie.' DE PROCEDENCIA:',0,0,'L');
        #
        PDF::SetXY(100,$y+45);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,$postulante->institucion_educativa,0,0,'L');
        #
        PDF::SetXY(20,$y+50);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'GESTION EDUCATIVA:',0,0,'L');
        #
        PDF::SetXY(100,$y+50);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->gestion_ie,'UTF-8'),0,0,'L');
        #
        PDF::SetXY(20,$y+55);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'RAZÓN DE PRIMERA PRIORIDAD:',0,0,'L');
        #
        PDF::SetXY(100,$y+55);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->Complementarios->razon,'UTF-8'),0,0,'L');
        #
        PDF::SetXY(20,$y+60);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'PREPARACIÓN:',0,0,'L');
        #
        PDF::SetXY(100,$y+60);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,mb_strtoupper($postulante->Complementarios->tipo_preparacion,'UTF-8'),0,0,'L');
        #
        PDF::SetXY(20,$y+65);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'VECES QUE POSTULÓ A LA UNI:',0,0,'L');
        #
        PDF::SetXY(100,$y+65);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,$postulante->Complementarios->numeroveces,0,0,'L');
        #
        PDF::SetXY(20,$y+70);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'INGRESÓ Y RENUNCIÓ:',0,0,'L');
        #
        PDF::SetXY(100,$y+70);
        PDF::SetFont('helvetica','',8);
        #
        PDF::SetXY(20,$y+75);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'INGRESO ECONÓMICO FAMILIAR:',0,0,'L');
        #
        PDF::SetXY(100,$y+75);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(70,5,$postulante->Complementarios->ingreso_economico,0,0,'L');
        #
        PDF::SetXY(20,$y+80);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'PAGOS:',0,0,'L');
        #
        $pagos = Recaudacion::select(DB::raw("descripcion||':'||monto as descripcion"))->where('idpostulante',$postulante->id)->get();
        $lblpagos = $pagos->implode('descripcion', "\n" );

        PDF::SetXY(100,$y+80);
        PDF::SetFont('helvetica','',7);
        PDF::MultiCell(95, 15, $lblpagos, 0, '', 0, 1, '', '', true);
        #
        PDF::SetXY(20,$y+95);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(80,5,'OBSERVACIONES:',0,0,'L');
        #
        PDF::Rect(20, $y+95, 170, 30);
        #HUELLA INGRESANTE
        if($postulante->ingresantes->huella)
        PDF::Image($postulante->ingresantes->huella,20,$y+120,25,35);

        PDF::SetXY(20,$y+155);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'HUELLA DIGITAL',1,0,'C');
        #FIRMA INGRESANTE
        if($postulante->ingresantes->firma)
        PDF::Image($postulante->ingresantes->firma,55,$y+120,27);

        PDF::SetXY(55,$y+155);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(30,5,'FIRMA',1,0,'C');
        #
        PDF::SetXY(120,$y+140);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
        PDF::write1DBarcode($postulante->numero_identificacion, 'C39', '', '', '', 18, 0.4, $style, 'N');

        #EXPORTO
        PDF::Output(public_path('storage/tmp/').'DG_'.$postulante->numero_identificacion.'.pdf','FI');
    }
    public function pdfconstancia($id)
    {
        $postulante = Postulante::find($id);
        $evaluacion = Evaluacion::Activo()->first();
        $muestra = true;
        PDF::SetTitle(' EXPEDIENTE DEL INGRESANTE');


        if ($postulante->ingresantes->codigo_modalidad=='E1TE'
            && isset($postulante->ingresantes->facultad_procedencia) && $postulante->ingresantes->facultad_procedencia!=''
            && isset($postulante->ingresantes->numero_creditos) && $postulante->ingresantes->numero_creditos>0
            ) {
            $muestra = true;
        }elseif (str_contains($postulante->ingresantes->codigo_modalidad,['E1TG','E1TGU']
            && isset($postulante->ingresantes->facultad_procedencia)
            && (isset($postulante->ingresantes->grado) || isset($postulante->ingresantes->titulo)))) {
            $muestra = true;
        }elseif (str_contains($postulante->ingresantes->codigo_modalidad,['O','E1DPA','E1DB','E1CD','E1CABI','E1CABC','E1VTI','E1VTC','E1PDI','E1PDC','IEN','ID-CEPRE','E1DCAN'])) {
            $muestra = true;
        }else{
            $muestra = false;
        }
        if ($muestra) {
            $this->ReportFotoConstancia($postulante);
            #DUPLICADO DE CONSTANCIA
            $this->ReportConstancia($postulante,$evaluacion);
            #EXPEDIENTE DE CONVALIDACION
            if (str_contains($postulante->ingresantes->codigo_modalidad,['E1TE','E1TG','E1TGU'])){
                $this->ReportConvalidacion($postulante,$evaluacion);
            }
            #EXPORTO
            PDF::Output(public_path('storage/tmp/').'Expediente_'.$postulante->numero_identificacion.'.pdf','FI');
        } else {
            return view('alerts.simpletext')->with('mensaje','No ingreso los datos adicionales por esta modalidad');
        }

    }
    public function pdfconstancias()
    {
        $this->AsignaNumeroConstancia();

        $ingresantes = Postulante::select('postulante.*','i.numero_constancia')
                                   ->has('ingresantes')
                                   ->with('ingresantes')
                                   ->join('ingresante as i','i.idpostulante','=','postulante.id')
                                   ->orderBy('i.id')->get();
        $evaluacion = Evaluacion::Activo()->first();
        PDF::SetTitle(' CONSTANCIAS DE INGRESANTES');

        PDF::SetAutoPageBreak(false);
        foreach ($ingresantes as $key => $ingresante) {
            $this->ReportConstancia($ingresante,$evaluacion,false);
        }
        PDF::Output(public_path('storage/tmp/').'Constancias.pdf','F');

        $headers = [];
        return response()->download(
                storage_path('app/public/tmp/Constancias.pdf'),
                null,
                $headers
            );
    }
    public function AsignaNumeroConstancia()
    {
        $ingresantes = Ingresante::whereNull('numero_constancia')->orderBy('id')->get();
        if ($ingresantes->count()>0) {
            foreach ($ingresantes as $key => $ingresante) {
                $numero = DB::select("SELECT nextval('numero_constancia')");
                $numero = $numero[0]->nextval;
                $ingresante->numero_constancia=$numero;
                $ingresante->save();
            }
        }

    }
    public function ReportFotoConstancia($postulante)
    {
        PDF::AddPage('U','A4');
        PDF::SetAutoPageBreak(false);
        PDF::Image($postulante->ingresantes->foto,164, 60, 26,34);
    }
    public function ReportConstancia($postulante,$evaluacion,$copia = true)
    {
        #FONDO
        PDF::AddPage('U','A4');
        PDF::Image(asset('assets/pages/img/constancia.png'),0,0,210,297,'', '', '', false, 300, '', false, false, 0);
        #FOTO
        if($copia)PDF::Image($postulante->ingresantes->foto,164, 60, 26,34);
        #
        PDF::SetXY(161,96);
        PDF::SetFont('helvetica','B',18);
        $numero_constancia = pad($postulante->ingresantes->numero_constancia,4,'0','L');
        PDF::Cell(30,5,'N° '.$numero_constancia,0,0,'C');
        #
        PDF::SetXY(15,105);
        PDF::SetFont('helvetica','',14);
        $texto = 'El jefe de la Oficina Central de Admisión de la Universidad Nacional de Ingeniería deja constancia que:                              ';
        PDF::MultiCell(180, 15, $texto, 1, 'J', 0, 1, '', '', true);
        #
        PDF::SetXY(15,120);
        PDF::SetFont('helvetica','',13);
        PDF::Cell(30,5,$postulante->prefijo_sexo,0,0,'L');
        #
        PDF::SetXY(15,126);
        PDF::SetFont('helvetica','B',18);
        PDF::Cell(100,5,mb_strtoupper($postulante->paterno.' '.$postulante->materno,'UTF-8'),0,0,'L');
        #
        PDF::SetXY(15,134);
        PDF::SetFont('helvetica','',18);
        PDF::Cell(100,5,mb_strtoupper($postulante->nombres,'UTF-8'),0,0,'L');
        #
        PDF::SetXY(15,145);
        PDF::SetFont('helvetica','',15);
        $texto = 'Con '.$postulante->identificacion.', y número de inscripcion de postulante N° <b>'.$postulante->codigo.'</b> ';
        $texto .= 'Ingresó a la especialidad de <b>'.$postulante->ingresantes->especialidad.'</b> en la modalidad ';
        $texto .= '<b>'.$postulante->ingresantes->modalidad.'</b> del '.$evaluacion->nombre.', según consta en las actas correspondientes';
        $texto .= ' de esta Oficina, con nota vigesimal de '.$postulante->ingresantes->nota_coma.' (equivalente a '.$postulante->ingresantes->nota_equivalente.' en escala centesimal)';
        PDF::MultiCell(180, 15, $texto, 1, 'J', 0, 1, '', '', true,0,true);
        #
        $y = 260;
        if($copia)PDF::Image(asset('assets/pages/img/jefe_firma_sello_quinteros.png'),35,$y-20,45);
        PDF::SetXY(18,$y+3);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(73,5,'Mag. Ing. Silvio Quinteros Chávez',0,0,'C');
        PDF::SetXY(18,$y+8);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(73,5,'Jefe. Oficina Central de Admisión',0,0,'C');
        #
        if($copia)PDF::Image(asset('assets/pages/img/sg_firma_balta.png'),130,$y-14,25);
        if($copia)PDF::Image(asset('assets/pages/img/sg_sello_balta.png'),155,$y-18,20);
        PDF::SetXY(118,$y+3);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(73,5,'Ing. Armando Ulises Baltazar Franco',0,0,'C');
        PDF::SetXY(118,$y+8);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(73,5,'Secretario General',0,0,'C');
        #
        PDF::SetXY(120,200);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
        PDF::write1DBarcode($postulante->numero_identificacion, 'C39', '', '', '', 18, 0.4, $style, 'N');
    }
    public function ReportConvalidacion($postulante,$evaluacion)
    {
        PDF::AddPage('L','A4');
        PDF::SetAutoPageBreak(false);
        $x = 14.5;
        $y = 50;
        $alto_celda = 10;
        PDF::Image(asset('assets/pages/img/escudo.png'),15, 10, 15, 20);
        PDF::SetFont('helvetica','B',9);
        PDF::SetXY(29,10);
        PDF::Cell(150,5,'UNIVERSIDAD NACIONAL DE INGENIERÍA',0,2,'L');
        PDF::SetXY(29,13);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(150,5,'OFICINA CENTRAL DE ADMISIÓN',0,2,'L');
        PDF::SetXY(29,17);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(150,5,$evaluacion->nombre,0,2,'L');
        #TITULO
        PDF::SetXY(29,25);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(250,5,'MODALIDAD : '.$postulante->ingresantes->modalidad.'-'.$evaluacion->nombre,0,2,'C');
        #
        PDF::Image($postulante->ingresantes->foto, 259, 35, 25, 35, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        #
        PDF::Rect(15, 35, 269, 65, 'D');
        PDF::Line(85, 35, 85, 100);
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::MultiCell(70, 5, 'EVALUACIÓN', 0, 'C', 0, 0, 15, 35, true);
        #
        PDF::SetFont('helvetica', '', 9);
        if (str_contains($postulante->ingresantes->codigo_modalidad,['E1TG','E1TG']))
        {
            PDF::SetXY(20,60);
            PDF::Cell(50, 5, 'NOTA FINAL : '.$postulante->ingresantes->nota_ingreso, 0, 'L');
        }
        if(str_contains($postulante->ingresantes->codigo_modalidad,'E1TGU')){
            PDF::SetXY(20,70);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(65, 5, 'EGRESADO UNI', 0, 'L');
        }
        else {
            //PDF::Cell(65, 5, 'ORDEN DE MÉRITO FACULTAD Y MODALIDAD: '.$postulante->ingresantes->merito, 0, 'L');
        }
        PDF::SetXY(20,85);
        PDF::SetFont('helvetica','',10);
        PDF::MultiCell(65, 5, $postulante->ingresantes->reglamento_modalidad.' '.$evaluacion->codigo, 0, 'J', 0, 0, '', '', true);
        #PROCEDENCIA Y ADMISION UNI
        PDF::SetFont('helvetica', 'B', 11);
        PDF::MultiCell(144, 5, 'PROCEDENCIA Y ADMISIÓN UNI', 0, 'C', 0, 0, 100, 35, true);
        PDF::SetFont('helvetica', '', 9);
        PDF::MultiCell(50, 5, 'Nº de Inscripción', 0, 'L', 0, 0, 86, 45, true);
        PDF::MultiCell(50, 5, 'Nombre del Ingresante', 0, 'L', 0, 0, 86, 52, true);
        PDF::MultiCell(50, 5, 'Universidad y Facultad', 0, 'L', 0, 0, 86, 59, true);
        PDF::MultiCell(50, 5, 'de procedencia', 0, 'L', 0, 0, 86, 63, true);
        #
        if (str_contains($postulante->ingresantes->codigo_modalidad,'E1TE'))
        {
             PDF::MultiCell(50, 5, 'Nº de créditos aprobados', 0, 'L', 0, 0, 86, 70, true);
        }
        else
        {
            if (empty($postulante->ingresantes->titulo))
            {
                PDF::MultiCell(50, 5, 'Grado académico', 0, 'L', 0, 0, 86, 70, true);
            }
            else
            {
                PDF::MultiCell(50, 5, 'Título profesional', 0, 'L', 0, 0, 86, 70, true);
            }
        }

        PDF::MultiCell(50, 5, 'Admitido a la Facultad', 0, 'L', 0, 0, 86, 77, true);
        PDF::MultiCell(50, 5, 'Especialidad de Ingreso', 0, 'L', 0, 0, 86, 84, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 45, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 52, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 61, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 70, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 77, true);
        PDF::MultiCell(5, 5, ':', 0, 'L', 0, 0, 123, 84, true);
        PDF::MultiCell(100, 5, $postulante->codigo, 0, 'L', 0, 0, 125, 45, true);
        PDF::MultiCell(100, 5, $postulante->nombre_completo, 0, 'L', 0, 0, 125, 52, true);
        PDF::MultiCell(100, 5, $postulante->institucion_educativa, 0, 'L', 0, 0, 125, 59, true);
        PDF::MultiCell(100, 5, $postulante->ingresantes->facultad_procedencia, 0, 'L', 0, 0, 125, 63, true);
        PDF::MultiCell(100, 5, $postulante->ingresantes->facultad, 0, 'L', 0, 0, 125, 77, true);
        PDF::MultiCell(100, 5, $postulante->ingresantes->especialidad, 0, 'L', 0, 0, 125, 84, true);
        #
        PDF::MultiCell(100, 5, 'Mag. Ing. Silvio Quinteros Chávez', 0, 'C', 0, 0,175,92   , true);
        PDF::MultiCell(100, 5, 'Jefe (e), Oficina Central de Admisión', 0, 'C', 0, 0,175,95.5 , true);
        #CUADRO DE CREDITOS
        PDF::MultiCell(20, 7, 'CICLO', 1, 'C', 0, 0,15,105 , true,0, false, true, 7, 'M');
        PDF::MultiCell(20, 7, 'CÓDIGO', 1, 'C', 0, 0,35,105   , true,0, false, true, 7, 'M');
        PDF::MultiCell(90, 7, 'NOMBRE DEL CURSO', 1, 'C', 0, 0,55,105  , true,0, false, true, 7, 'M');
        PDF::MultiCell(12, 7, 'CRED.', 1, 'C', 0, 0,145,105    , true,2, false, true, 7, 'M');
        PDF::MultiCell(110, 7, 'CURSO QUE CONVALIDAN', 1, 'C', 0, 0,162,105    , true,0, false, true, 7, 'M');
        PDF::MultiCell(12, 7, 'CRED.', 1, 'L', 0, 0,272,105    , true,0, false, true, 7, 'M');
        #
        PDF::Rect(15, 115, 142, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(35, 115 + ($j + 1) * 5.5, 157, 115 + ($j + 1) * 5.5);
        }
        PDF::Line(35, 115, 35, 153.5);
        PDF::Line(55, 115, 55, 153.5);
        PDF::Line(145, 115, 145, 153.5);

        PDF::Rect(15, 158.5, 142, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(35, 158.5 + ($j + 1) * 5.5, 157, 158.5 + ($j + 1) * 5.5);
        }
        PDF::Line(35, 158.5, 35, 197.5);
        PDF::Line(55, 158.5, 55, 197.5);
        PDF::Line(145, 158.5, 145, 197.5);

        PDF::Rect(162 ,115, 122, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(162, 115 + ($j + 1) * 5.5, 284, 115 + ($j + 1) * 5.5);
        }
        PDF::Line(182, 115, 182, 153.5);
        PDF::Line(272, 115, 272, 153.5);

        PDF::Rect(162, 158.5, 122, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(162, 158.5 + ($j + 1) * 5.5, 284, 158.5 + ($j + 1) * 5.5);
        }
        PDF::Line(182, 158.5, 182, 197.5);
        PDF::Line(272, 158.5, 272, 197.5);
        #SEGUNDA PAGINA
        PDF::AddPage();

        PDF::MultiCell(20, 7, 'CICLO', 1, 'C', 0, 0, 15, 15, true, 0, false, true, 7, 'M');
        PDF::MultiCell(20, 7, 'CÓDIGO', 1, 'C', 0, 0, 35, 15, true, 0, false, true, 7, 'M');
        PDF::MultiCell(90, 7, 'NOMBRE DEL CURSO', 1, 'C', 0, 0, 55, 15, true, 0, false, true, 7, 'M');
        PDF::MultiCell(12, 7, 'CRED.', 1, 'C', 0, 0, 145, 15, true, 2, false, true, 7, 'M');
        PDF::MultiCell(110, 7, 'CURSO QUE CONVALIDAN', 1, 'C', 0, 0, 162, 15, true, 0, false, true, 7, 'M');
        PDF::MultiCell(12, 7, 'CRED.', 1, 'L', 0, 0, 272, 15, true, 0, false, true, 7, 'M');

        PDF::Rect(15, 25, 142, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(35, 25 + ($j + 1) * 5.5, 157, 25 + ($j + 1) * 5.5);
        }
        PDF::Line(35, 25, 35, 63.5);
        PDF::Line(55, 25, 55, 63.5);
        PDF::Line(145, 25, 145, 63.5);

        PDF::Rect(15, 68.5, 142, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(35, 68.5 + ($j + 1) * 5.5, 157, 68.5 + ($j + 1) * 5.5);
        }
        PDF::Line(35, 68.5, 35, 107.5);
        PDF::Line(55, 68.5, 55, 107.5);
        PDF::Line(145, 68.5, 145, 107.5);

        PDF::Rect(15, 112, 142, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(35, 112 + ($j + 1) * 5.5, 157, 112 + ($j + 1) * 5.5);
        }
        PDF::Line(35, 112, 35, 150.5);
        PDF::Line(55, 112, 55, 150.5);
        PDF::Line(145, 112, 145, 150.5);

        PDF::Rect(162 ,25, 122, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(162, 25 + ($j + 1) * 5.5, 284, 25 + ($j + 1) * 5.5);
        }
        PDF::Line(182, 25, 182, 63.5);
        PDF::Line(272, 25, 272, 63.5);

        PDF::Rect(162, 68.5, 122, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(162, 68.5 + ($j + 1) * 5.5, 284, 68.5 + ($j + 1) * 5.5);
        }
        PDF::Line(182, 68.5, 182, 107.5);
        PDF::Line(272, 68.5, 272, 107.5);

        PDF::Rect(162, 112, 122, 38.5, 'D');
        for ($j = 0; $j < 7; $j++)
        {
            PDF::Line(162, 112 + ($j + 1) * 5.5, 284, 112 + ($j + 1) * 5.5);
        }
        PDF::Line(182, 112, 182, 150.5);
        PDF::Line(272, 112, 272, 150.5);
        #FIRMA FACULTAD
        PDF::MultiCell(267, 7, utf8_encode('La facultad de ').$postulante->ingresantes->facultad.
                                                                ' Especialidad de '.$postulante->ingresantes->especialidad.
                                                                ' ha admitido y convalidado los cursos antes mencionados de '.
                                                                $postulante->nombre_completo.".\n", 0, 'J', 0, 0, 15, 155, true);
        PDF::MultiCell(267, 7, "Lima, \n", 0, 'J', 0, 0, 15, 170, true);
        PDF::MultiCell(100, 7, "Decano de la Facultad", 0, 'L', 0, 0, 180, 185, true);

    }

}
