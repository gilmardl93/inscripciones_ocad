<?php

namespace App\Http\Controllers\Pago;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Cronograma;
use App\Models\Descuento;
use App\Models\Postulante;
use App\Models\Servicio;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
class PagoController extends Controller
{
    public function index($id = null)
    {
        $existe = Postulante::where('idusuario',Auth::user()->id)->count();
        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                    ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                    ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');
            return back();
        }else{
            $pagos = $this->CalculoServicios();
            return view('pagos.list',compact('id','pagos'));
        }
    }
    public function formato($servicio,$id = null)
    {
    	return view('pagos.index',compact('id','servicio'));
    }
    public function pdf($servicio,$id = null)
    {
        if (isset($id)) {
           $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        if(isset($postulante)){
        $servicio = Servicio::where('codigo',$servicio)->first();
        $this->FormatoScotiabank($servicio,$postulante,'Scotiabank');
        $this->FormatoScotiabank($servicio,$postulante,'Bcp');
        $this->FormatoScotiabank($servicio,$postulante,'Financiero');


        PDF::Output(public_path('storage/tmp/').'FormatoPago_'.$servicio->codigo.'_'.$postulante->numero_identificacion.'.pdf','FI');
        }//fin if
    }
    public function CalculoServicios($id = null)
    {
        $postulante = Postulante::Usuario()->first();
        #Pago de Prospecto-----------------------------------------------------------------------------------------------
        $pagos = collect(['prospecto'=>475]);
        #Pago por derecho de examen---------------------------------------------------------------------------------------

        #Modalidad Ordinario, Dos primeros alumnos, Deportisca calificado (Iniciar),Cepre Uni
        if (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',464);
        elseif (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Privada')) {
            $pagos->put('examen',465);
         }

        #Diplomado con bachillerato, Andres bello (Continuar), convenio diplomatico
        if (str_contains($postulante->codigo_modalidad, ['E1DB','E1CABC','E1CABI','E1CD']))
            $pagos->put('examen',473);

            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1DB','E1CABC','E1CABI','E1CD']))
                $pagos->put('examen2',473);



        #Traslado Externo
        if (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',469);
        elseif (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Privada')) {
             $pagos->put('examen',470);
         }
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Pública'))
                $pagos->put('examen2',469);
            elseif (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Privada')) {
                 $pagos->put('examen2',470);
             }
        #Titulado o graduado
        if (str_contains($postulante->codigo_modalidad, ['E1TG','E1TGU']))
            $pagos->put('examen',468);
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1TG','E1TGU']))
                $pagos->put('examen2',468);

        #Descuentos por simulacro, semibeca o hijo de trabajador
        $descuento = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->first();
        if (isset($descuento)) {
            $pagos->pull('examen');
            if($descuento->tipo=='Parcial')$pagos->put('examen',$descuento->servicio);
        }
        #Pago por examen vocacional---------------------------------------------------------------------------------------
        if (str_contains($postulante->codigo_modalidad, 'ID-CEPRE') && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('vocacepre',516);
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE','E1VTI','E1VTC']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        if (str_contains($postulante->codigo_especialidad2, 'A1')){
            $pagos->put('voca',474);
        }
        #Pago extemporaneo---------------------------------------------------------------------------------------------------
        $date = Carbon::now()->toDateString();
        $fecha_inicio = Cronograma::FechaInicio('INEX');
        $fecha_fin = Cronograma::FechaFin('INEX');
        if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }
    public function FormatoScotiabank($servicio,$postulante,$banco)
    {
        switch ($banco) {
            case 'Scotiabank':
                $imagen = asset('assets/pages/img/scotiabank_logo.jpg');
                $lblconcepto = 'Concepto :';
                $lblservicio = ($servicio->codigo+100).' - ';
                break;
            case 'Bcp':
                $imagen = asset('assets/pages/img/bcp_logo.jpg');
                $lblconcepto = 'Partida :';
                $lblservicio = $servicio->partida.' - ';
                break;
            case 'Financiero':
                $imagen = asset('assets/pages/img/financiero_logo.jpg');
                $lblconcepto = 'Partida :';
                $lblservicio = $servicio->partida.' - ';
                break;
        }
        PDF::SetTitle('RECIBO DE PAGO');
        PDF::AddPage('L','A5');
        #MARCO
        PDF::Rect(15,15, 180,100 );
        #IMAGEN
        PDF::Image($imagen,18,20,40);
        #TITULO
        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','',22);
        PDF::Cell(170,15,"FORMATO DE PAGO",0,0,'C');
        #CCOLOR DEL TEXTO
        PDF::SetTextColor(0);
        #INSTITUCION
        PDF::SetXY(18,40);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'Cuenta :',1,0,'R');
        PDF::SetXY(78,40);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(110,5,'ADMISION-UNI',1,0,'L');
        #ETIQUETA NOMBRE DEL ALUMNO
        PDF::SetXY(18,45);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'DNI POSTULANTE',1,0,'R');
        PDF::SetXY(78,45);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$postulante->numero_identificacion,1,0,'L');
        #CODIGO CNE
        PDF::SetXY(18,50);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'Nombre del postulante :',1,0,'R');
        PDF::SetXY(78,50);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$postulante->nombre_completo,1,0,'L');
        #CONCEPTO
        PDF::SetXY(18,55);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,$lblconcepto,1,0,'R');
        PDF::SetXY(78,55);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$lblservicio.$servicio->descripcion,1,0,'L');
        #ETIQUETA IMPORTE
        PDF::SetXY(18,60);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,"Importe :",1,0,'R');
        PDF::SetXY(78,60);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,"S/. $servicio->monto ",1,0,'L');
        #TITULO INSTRUCCIONES
        PDF::SetXY(18,65);
        PDF::SetFont('helvetica','',15);
        PDF::SetTextColor(255,0,0);
        PDF::Cell(123,5,"Instrucciones para el postulante",0,0,'L');
        #INSTRUCCIONES
        PDF::SetXY(18,73);
        PDF::SetFont('helvetica','',11);
        PDF::SetTextColor(0);
        PDF::Cell(123,0,"1. Verificar que los datos registrados en la parte superior sean los correctos.",0,0,'L');
        PDF::SetXY(18,78);
        PDF::Cell(123,0,"2. Verificar que el nombre sea del postulante no del apoderado o de quien pague.",0,0,'L');
    }
}
