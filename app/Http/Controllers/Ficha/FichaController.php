<?php

namespace App\Http\Controllers\Ficha;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pago\PagoController;
use App\Models\Evaluacion;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Models\Recaudacion;
use App\Models\Servicio;
use App\User;
use Auth;
use Carbon\Carbon;
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
            $correcto_datos_i = false;
            $correcto_datos_p = false;
            $correcto_datos_f = false;
            $correcto_datos_e = false;
            $correcto_pagos = false;
            $msj = collect([]);

            #Valida Foto Editada

            if(isset($postulante) && $postulante->foto_estado == 'ACEPTADO'){
                $correcto_foto = true;
            }elseif (isset($postulante) && $postulante->foto_estado == 'SIN FOTO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Falta Foto','mensaje'=>'Usted no ha cargado su foto']);
            }elseif (isset($postulante) && $postulante->foto_estado == 'RECHAZADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Foto Rechazada','mensaje'=>'La foto que usted ha cargado en el sistema ha sido rechazada, vuelva a cargar una foto mas nitida con fondo blanco sin lentes, si tiene problemas puede enviar su foto al correo informes@admisionuni.edu.pe']);
            }elseif(isset($postulante) && $postulante->foto_estado == 'CARGADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Edicion de Foto','mensaje'=>'En estos momentos estamos editando su foto']);
            }

            #Valida datos adicionales----------------------------------------
            $proceso = Proceso::where('idpostulante',$postulante->id)->first();

            if ($proceso->preinscripcion)$correcto_datos_i = true;
            else {
                $correcto_datos_i = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos de Preinscripcion']);
            }
            if ($proceso->datos_personales)$correcto_datos_p = true;
            else {
                $correcto_datos_p = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos personales']);
            }

            if ($proceso->datos_familiares)$correcto_datos_f = true;
            else {
                $correcto_datos_f = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos familiares']);
            }

            if ($proceso->encuesta)$correcto_datos_e = true;
            else {
                $correcto_datos_e = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado los datos complementarios']);
            }

            #Valida Pagos-------------------------------------------------------
            $pagos = new PagoController();
            $pagos = $pagos->CalculoServicios();
            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();
            $pagos_realizados = $recaudacion->implode('servicio', ', ');
            $debe = false;
            foreach ($pagos as $key => $item) {
                if(str_contains($pagos_realizados,$item))$correcto_pagos = true;
                else{
                    $correcto_pagos = false;
                    $servicio = Servicio::where('codigo',$item)->first();
                    $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 2 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                    $debe = true;
                }
            }
            $correcto_pagos = ($debe) ? false : true ;
            if ($correcto_pagos) {
                Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
            }

            #-------------------------------------------------------------------------------------------
            if($correcto_foto && $correcto_datos_i && $correcto_datos_p && $correcto_datos_f && $correcto_datos_e && $correcto_pagos){
                #Si los datos son correctos muestro el formulario de conformidad
                if ($postulante->datos_ok)return view('ficha.index',compact('id'));
                else return view('ficha.confirmacion',compact('id'));

            }else{
                return view('ficha.bloqueo',compact('msj'));
            }

        }

    }
    public function confirmar(Request $request)
    {
        if (Auth::attempt(['dni' => $request->get('dni'), 'password' => $request->get('password')])) {
            $postulante = Postulante::Usuario()->first();
            $postulante->datos_ok=true;
            $postulante->fecha_conformidad=Carbon::now();
            $postulante->save();
            #Asigno Aulas
            Postulante::AsignarAula($postulante->id);
            #Asigno codigo
            Postulante::AsignarCodigo($postulante->id,$postulante->canal,$postulante->codigo_modalidad);
            $id = $request->get('id');
            return view('ficha.index',compact('id'));
        }else{
            Alert::danger('Su clave o DNI no es correcto');
            return back();
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
            PDF::SetXY(10,120);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(20,5,'Aulas :',0,0,'R');
            PDF::SetFont('helvetica','B',17);
            PDF::SetXY(35,120);
            PDF::SetFillColor(0, 0, 0, 12);
            PDF::Cell(40,7,'LU 07: '.$postulante->datos_aula_uno->codigo,0,0,'C',1,'',1);
            #
            PDF::SetXY(80,120);
            PDF::Cell(40,7,'MI 09: '.$postulante->datos_aula_dos->codigo,0,0,'C',1,'',1);
            #
            PDF::SetXY(125,120);
            PDF::Cell(40,7,'VI 11: '.$postulante->datos_aula_tres->codigo,0,0,'C',1,'',1);
            #
            if($postulante->codigo_especialidad=='A1'){
                PDF::SetXY(168,120);
                PDF::Cell(40,7,'VOCA 05: '.$postulante->datos_aula_voca->codigo,0,0,'C',1,'',1);
            }
            PDF::SetFont('helvetica','B',12);
            #MENSAJE
            PDF::SetFillColor(255);
            PDF::SetTextColor(255);
            PDF::SetXY(0,134);
            $texto = 'El ingreso al campus de la UNI para rendir las tres pruebas del Examen de Admisión es de 7h00 a 8h00';
            PDF::Cell(210,7,$texto,0,0,'C');
            PDF::SetTextColor(0);
            #NUMERO DE DNI
            PDF::SetXY(18,150);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Lugar de Nacimiento :',0,0,'R');
            PDF::SetXY(78,150);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo_nacimiento,0,0,'L');
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
            PDF::Cell(60,5,'Documento de Identidad :',0,0,'R');
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
            PDF::Cell(110,5,$postulante->descripcion_ubigeo,0,0,'L');
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
            PDF::Cell(170,5,'DECLARACIÓN JURADA',0,0,'C');
            PDF::SetXY(5,203);
            PDF::SetFont('helvetica','',11);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, y que la imagen subida al sistema es mi foto actual. En caso de faltar a la verdad perderé mis derechos de participante sometiéndome a las sanciones reglamentarias y legales que correspondan. Asimismo, declaro no tener antecedentes policiales, autorizando a la Oficina Central de Admisión OCAD-UNI el uso de mis datos personales que libremente proporciono, para los fines que involucran las actividades propias de la OCAD-UNI, y la publicación en todo medio de comunicación de los resultados de las pruebas rendidas. Declaro haber leído y conocer el reglamento del $evaluacion->nombre.";
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
            #Mapa
            PDF::AddPage('U','A4');
            PDF::StartTransform();
            PDF::Rotate(90,140,135);
            PDF::Image(asset('assets/pages/img/mapa-uni.jpg'),0,0,270);
            PDF::StopTransform();

            #EXPORTO
            PDF::Output(public_path('storage/tmp/').'Ficha_'.$postulante->numero_identificacion.'.pdf','FI');
        }else{
            //dd('Todavia no se puede visualizar la ficha');
        }//fin if
    }
}
