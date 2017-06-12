<?php

namespace App\Http\Controllers\Ficha;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pago\PagoController;
use App\Models\Evaluacion;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Models\Recaudacion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use PDF;
use Styde\Html\Facades\Alert;
class FichaController extends Controller
{
    /**
     * Mostrar la ficha
     * 1.- La foto debe estar editada y aprobada
     * 2.- Debe haber pagado
     * 3.- Debe haber llenado todos sus datos
     * @return view
     */
    public function index($id = null)
    {
        $postulante = Postulante::Usuario()->first();
        if (isset($postulante)) {
            $correcto_foto = false;
            $correcto_datos_p = false;
            $correcto_datos_f = false;
            $correcto_datos_e = false;
            $correcto_pagos = false;
            $msj = collect([]);

            #Valida Foto Editada
            if(isset($postulante) && $postulante->foto_estado == 'ACEPTADO')$correcto_foto = true;
            else{
                $correcto_foto = false;
                $msj->push(['titulo'=>'Error de Foto','mensaje'=>'Su foto ha sido rechazado']);
            }

            #Valida datos adicionales----------------------------------------
            $proceso = Proceso::where('idpostulante',$postulante->id)->first();
            if ($proceso->datos_personales)$correcto_datos_p = true;
            else {
                $correcto_datos_p = false;
                $msj->push(['titulo'=>'Error de datos','mensaje'=>'Usted no ha ingresado sus datos personales']);
            }

            if ($proceso->datos_familiares)$correcto_datos_f = true;
            else {
                $correcto_datos_f = false;
                $msj->push(['titulo'=>'Error de datos','mensaje'=>'Usted no ha ingresado sus datos familiares']);
            }

            if ($proceso->encuesta)$correcto_datos_e = true;
            else {
                $correcto_datos_e = false;
                $msj->push(['titulo'=>'Error de datos','mensaje'=>'Usted no ha ingresado los datos complementarios']);
            }

            #Valida Pagos-------------------------------------------------------
            $pagos = new PagoController();
            $pagos = $pagos->CalculoServicios();
            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();
            $pagos_realizados = $recaudacion->implode('servicio', ', ');

            foreach ($pagos as $key => $item) {
                if(str_contains($pagos_realizados,$item))$correcto_pagos = true;
                else{
                    $correcto_pagos = false;
                    $servicio = Servicio::where('codigo',$item)->first();
                    $msj->push(['titulo'=>'Error de pago','mensaje'=>'Usted no ha realizado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles']);
                }
            }

            Alert::warning('Debe cargar su foto tamaño pasaporte, para que podamos verificar y mostrar su ficha');

            if($correcto_foto &&
                $correcto_datos_p &&
                $correcto_datos_f &&
                $correcto_datos_e &&
                $correcto_pagos)return view('ficha.index',compact('id'));
            else return view('ficha.bloqueo',compact('msj'));


        }else{
            return view('ficha.bloqueo');
        }

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
            PDF::Image(asset('assets/pages/img/ficha.png'),0,0,210,297,'', '', '', false, 300, '', false, false, 0);
            #CCOLOR DEL TEXTO
            PDF::SetTextColor(0);
            #TITULO
            PDF::SetXY(10,72);
            PDF::SetFont('helvetica','B',19);
            PDF::Cell(60,5,$evaluacion->codigo,0,0,'C');
            #NUMERO DE INSCRIPCION
            PDF::SetXY(18,90);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Número de Inscripción :',0,0,'R');
            #
            PDF::SetXY(78,90);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->codigo,0,0,'L');
            #CODIGO ENCIMA DE LA FOTO
            PDF::SetXY(162,39);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(29,5,$postulante->codigo,0,0,'C');
            #NOMBRES Y APELLIDOS
            PDF::SetXY(18,95);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Nombres y Apellidos :',0,0,'R');
            PDF::SetXY(78,95);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->nombre_completo,0,0,'L');
            #MODALIDAD
            PDF::SetXY(18,100);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Modalidad 1 :',0,0,'R');
            PDF::SetXY(78,100);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->nombre_modalidad,0,0,'L');
            #ESPECIALIDAD
            PDF::SetXY(18,105);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Especialidad 1 :',0,0,'R');
            PDF::SetXY(78,105);
            PDF::SetFont('helvetica','B',10);
            PDF::Cell(110,5,$postulante->nombre_especialidad,0,0,'L');
            if ($postulante->codigo_modalidad == 'ID-CEPRE') {
                #SEGUNDA MODALIDAD
                PDF::SetXY(18,110);
                PDF::SetFont('helvetica','',11);
                PDF::Cell(60,5,'Modalidad 2 :',0,0,'R');
                PDF::SetXY(78,110);
                PDF::SetFont('helvetica','B',10);
                PDF::Cell(110,5,$postulante->nombre_modalidad2,0,0,'L');
                #SEGUNDA ESPECIALIDAD
                PDF::SetXY(18,115);
                PDF::SetFont('helvetica','',11);
                PDF::Cell(60,5,'Especialidad 2 :',0,0,'R');
                PDF::SetXY(78,115);
                PDF::SetFont('helvetica','B',10);
                PDF::Cell(110,5,$postulante->nombre_especialidad2,0,0,'L');
            }
            #AULAS
            PDF::SetXY(18,120);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(60,5,'Aulas :',0,0,'R');
            PDF::SetFont('helvetica','B',10);
            PDF::SetXY(78,120);
            PDF::SetFillColor(0, 0, 0, 12);
            PDF::Cell(30,7,'LU 22: S4-201',0,0,'C',1,'',1);
            #
            PDF::SetXY(110,120);
            PDF::Cell(30,7,'MI 24: COPRESA 45666',0,0,'C',1,'',1);
            #
            PDF::SetXY(142,120);
            PDF::Cell(30,7,'VI 26: Q1-302',0,0,'C',1,'',1);
            #
            PDF::SetXY(174,120);
            PDF::Cell(30,7,'VOCA 26: Q1-302',0,0,'C',1,'',1);
            #MENSAJE
            PDF::SetFillColor(255);
            PDF::SetTextColor(255);
            PDF::SetXY(0,134);
            $texto = 'El ingreso al campus de la UNI para rendir las tres pruebas del Exámen de Admisión es de 7h00 a 8h00';
            PDF::Cell(210,7,$texto,0,0,'C');
            PDF::SetTextColor(0);
            #NUMERO DE DNI
            PDF::SetXY(18,150);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Lugar de Nacimiento :',0,0,'R');
            PDF::SetXY(78,150);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo,0,0,'L');
            #FECHA DE NACIMIENTO
            PDF::SetXY(18,155);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Fecha de Nacimiento :',0,0,'R');
            PDF::SetXY(78,155);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->fecha_nacimiento,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(18,160);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Documento de identidad :',0,0,'R');
            PDF::SetXY(78,160);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->identificacion,0,0,'L');
            #DIRECCIÓN
            PDF::SetXY(18,165);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Dirección :',0,0,'R');
            PDF::SetXY(78,165);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->direccion,0,0,'L');
            #
            PDF::SetXY(78,170);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo_nacimiento,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(18,175);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'TELÉFONOS :',0,0,'R');
            PDF::SetXY(78,175);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->telefonos,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(18,180);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'EMAIL :',0,0,'R');
            PDF::SetXY(78,180);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->email,0,0,'L');
            #
            $style = array('width' => 0.3, 'cap' => 'round', 'join' => 'miter', 'dash' => '0', 'phase' => 34, 'color' => array(181));
            PDF::Line(0, 192, 210, 192,$style);
            #DECLARACION JURADA
            PDF::SetXY(18,192);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(170,5,'DECLARACION JURADA',0,0,'C');
            PDF::SetXY(5,203);
            PDF::SetFont('helvetica','',11);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, y que la imagen subida al sistema es mi foto actual. En caso de faltar a la verdad perderé mis derechos de participante sometiéndome a las sanciones reglamentarias y legales que correspondan. Asimismo, declaro no tener antecedentes policiales, autorizando a la Oficina Central de Admisión OCAD-UNI el uso de mis datos personales que libremente proporciono, para los fines que involucran las actividades propias de la OCAD-UNI, y la publicación de los resultados de la prueba rendida en todo medio de comunicación. Declaro haber leído y conocer el reglamento del $evaluacion->nombre.";
            PDF::MultiCell(155,5,$texto,1,'J',false);

            #
            #
            $persona = ($postulante->edad>=18) ? 'Postulante' : 'Apoderado' ;
            PDF::SetXY(18,272);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18,277);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'DNI del '.$persona.':','B',0,'L');
            #FOTO
            PDF::Image($postulante->mostrar_foto_editada,163,45,27);

            PDF::Output(public_path('storage/tmp/').'Ficha_'.$postulante->numero_identificacion.'.pdf','FI');
        }else{
            Alert::warning('Debe cargar su foto tamaño pasaporte, para que podamos verificar y mostrar su ficha');
        }//fin if
    }
}
