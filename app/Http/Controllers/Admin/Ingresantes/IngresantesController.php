<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Evaluacion;
use App\Models\Familiar;
use App\Models\Postulante;
use Illuminate\Http\Request;
use PDF;
class IngresantesController extends Controller
{
    public function index()
    {
    	$Lista = [];
    	return view('admin.ingresantes.index',compact('Lista'));
    }
    public function search(Request $request)
    {
    	$Lista = Postulante::has('ingresantes')->where('numero_identificacion','like','%'.$request->get('dni').'%')->get();
    	if ($Lista->count()==0) Alert::warning('No existe este DNI como ingresante');

    	return view('admin.ingresantes.index',compact('Lista'));
    }
    public function show($id)
    {
    	$postulante = Postulante::with('ingresantes')->find($id);
    	return view('admin.ingresantes.show',compact('postulante'));
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
        PDF::Image($postulante->mostrar_foto_editada,20,35,27);
        PDF::SetXY(20,70);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'POSTULANTE:',1,0,'C');
        #FOTO INGRESANTE
        PDF::Image($postulante->ingresantes->foto,50,35,27);
        PDF::SetXY(50,70);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'INGRESANTE:',1,0,'C');
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
        PDF::Cell(80,5,'OBSERVACIONES:',0,0,'L');
        #
        PDF::Rect(20, $y+85, 170, 30);
        ##HUELLA INGRESANTE
        PDF::Image($postulante->ingresantes->huella,20,$y+120,27);
        PDF::SetXY(20,$y+155);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(25,5,'HUELLA DIGITAL',1,0,'C');
        ##HUELLA MANUAL INGRESANTE
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
        PDF::SetTitle(' CONSTANCIA DEL INGRESANTE');

        PDF::SetAutoPageBreak(false);
        PDF::AddPage('U','A4');
        PDF::Image($postulante->ingresantes->foto,162, 88, 24, 33);
        #DUPLICADO DE CONSTANCIA
        #FONDO
        PDF::AddPage('U','A4');
        PDF::Image(asset('assets/pages/img/constancia.png'),0,0,210,297,'', '', '', false, 300, '', false, false, 0);
        #FOTO
        PDF::Image($postulante->ingresantes->foto,164, 60, 26,34);
        #
        PDF::SetXY(161,96);
        PDF::SetFont('helvetica','B',18);
        PDF::Cell(30,5,'N° '.$postulante->ingresantes->numero_constancia,0,0,'C');
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
        $texto .= ' de esta Oficina, con nota vigesimal de 11.628 (equivalente a 58.140 en escala centesimal)';
        PDF::MultiCell(180, 15, $texto, 1, 'J', 0, 1, '', '', true,0,true);
        #
        $y = 260;
        PDF::Image(asset('assets/pages/img/jefe_firma_sello_quinteros.png'),35,$y-20,45);
        PDF::SetXY(23,$y+3);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(73,5,'Mag. Ing. Silvio Quinteros Chávez',0,0,'C');
        PDF::SetXY(23,$y+8);
        PDF::SetFont('helvetica','',8);
        PDF::Cell(73,5,'Jefe. Oficina Central de Admisión',0,0,'C');
        #
        PDF::Image(asset('assets/pages/img/sg_firma_balta.png'),130,$y-14,25);
        PDF::Image(asset('assets/pages/img/sg_sello_balta.png'),155,$y-18,20);
        PDF::SetXY(103,$y+3);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(73,5,'Ing. Armando Ulises Baltazar Franco',0,0,'C');
        PDF::SetXY(103,$y+8);
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

        #EXPORTO
        PDF::Output(public_path('storage/tmp/').'Constancia_'.$postulante->numero_identificacion.'.pdf','FI');
    }

}
