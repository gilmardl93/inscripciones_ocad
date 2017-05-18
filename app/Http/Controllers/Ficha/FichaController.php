<?php

namespace App\Http\Controllers\Ficha;

use App\Http\Controllers\Controller;
use App\Models\Evaluacion;
use App\Models\Postulante;
use Illuminate\Http\Request;
use PDF;
use Styde\Html\Facades\Alert;
class FichaController extends Controller
{
    public function index($id = null)
    {
        $postulante = Postulante::Usuario()->first();
        #if(isset($postulante) && $postulante->foto_estado!='ACEPTADO')
        #    Alert::warning('Debe cargar su foto tamaño pasaporte, para que podamos verificar y mostrar su ficha');

    	return view('ficha.index',compact('id'));
    }
     public function pdf($id = null)
    {
        if (isset($id)) {
    	   $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        $evaluacion = Evaluacion::Activo()->first();
        #if(isset($postulante) && $postulante->foto_estado=='ACEPTADO'){
        if(true){

            PDF::SetTitle('FICHA DE INSCRIPCION');
            PDF::AddPage('U','A4');
            PDF::SetAutoPageBreak(false);
            PDF::Rect(15,15, 180,170);
            #FONDO
            PDF::Image(asset('assets/pages/img/ficha2.jpg'),0,0,210,297,'', '', '', false, 300, '', false, false, 0);
            #CCOLOR DEL TEXTO
            PDF::SetTextColor(0);
            #TITULO
            PDF::SetXY(0,99);
            PDF::SetFont('helvetica','B',15);
            PDF::Cell(210,5,'FICHA DE INSCRIPCION DEL PARTICIPANTE',0,0,'C');
            #NUMERO DE INSCRIPCION
            PDF::SetXY(18,110);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Número de Inscripción :',0,0,'R');
            #
            PDF::SetXY(78,110);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->codigo,0,0,'L');

            #NUMERO DE DNI
            PDF::SetXY(18,115);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Número de DNI :',0,0,'R');
            PDF::SetXY(78,115);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->dni,0,0,'L');
            #NOMBRES Y APELLIDOS
            PDF::SetXY(18,120);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Nombres y Apellidos :',0,0,'R');
            PDF::SetXY(78,120);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->nombre_completo,0,0,'L');
            #TELEFONOS
            PDF::SetXY(18,125);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Telefono :',0,0,'R');
            PDF::SetXY(78,125);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->telefono,0,0,'L');
            #CORREO
            PDF::SetXY(18,130);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Correo :',0,0,'R');
            PDF::SetXY(78,130);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->email,0,0,'L');
            #FECHA NACIMIENTO
            PDF::SetXY(18,135);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Fecha de Nacimiento :',0,0,'R');
            PDF::SetXY(78,135);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->fecha_nacimiento,0,0,'L');
            #GENERO
            PDF::SetXY(18,140);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Sexo :',0,0,'R');
            PDF::SetXY(78,140);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->sexo,0,0,'L');
            #AULA
            PDF::SetXY(18,145);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Sede donde rendira el examen:',0,0,'R');
            PDF::SetXY(78,145);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->sede,0,0,'L');
            #SEDE
            PDF::SetXY(18,150);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Aula :',0,0,'R');
            PDF::SetXY(78,150);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->aula,0,0,'L');
            #DIRECCION
            PDF::SetXY(18,154);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Sede :',0,0,'R');
            PDF::SetXY(78,154);
            PDF::SetFont('helvetica','B',10);
            $retVal = (str_contains($postulante->aula,'HYO')) ? 'COLEGIO SALESIANO SANTA ROSA CALLE AREQUIPA 299' : 'UNIVERSIDAD NACIONAL DE INGENIERIA AV. TUPAC AMARU 210 RIMAC' ;
            PDF::Cell(110,5,$retVal,0,0,'L');

            #DECLARACION JURADA
            PDF::SetXY(18,165);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(170,5,'DECLARACION JURADA',0,0,'C');
            #
            PDF::SetXY(18,185);
            PDF::SetFont('helvetica','',11);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, y que la imagen subida al sistema es mi foto actual. En caso de faltar a la verdad perderé mis derechos de participante sometiéndome a las sanciones reglamentarias y legales que correspondan. Asimismo, declaro no tener antecedentes policiales, autorizando a la Oficina Central de Admisión OCAD-UNI el uso de mis datos personales que libremente proporciono, para los fines que involucran las actividades propias de la OCAD-UNI, y la publicación de los resultados de la prueba rendida en todo medio de comunicación. Declaro haber leído y conocer el reglamento del $evaluacion->nombre.";
            PDF::MultiCell(170,5,$texto,1,'J',false);
            #
            $persona = ($postulante->edad>=18) ? 'Postulante' : 'Apoderado' ;
            PDF::SetXY(18,250);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18,255);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'DNI del '.$persona.':','B',0,'L');
            #FOTO
            PDF::Image($postulante->mostrar_foto_editada,169,42,34);

            PDF::Output(public_path('storage/tmp/').'FichaPostulante'.$postulante->dni.'.pdf','FI');
        }else{
            Alert::warning('Debe cargar su foto tamaño pasaporte, para que podamos verificar y mostrar su ficha');
        }//fin if
    }
}
