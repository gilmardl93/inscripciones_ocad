<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use PDF;
class ListadoNotasController extends Controller
{
    public function listadoNotas()
    {
    	return view('admin.ingresantes.listados.notas');
    }
    public function listadoNotaspdf()
    {
    	PDF::SetTitle('LISTADO GENERAL DE INGRESANTES CON NOTAS');
        PDF::AddPage('L','A4');
        PDF::SetAutoPageBreak(false);
        Reportheader('L');
    	Reportfooter('','','L');

    	$altodecelda=5;
        $incremento = 55;
        $numMaxLineas = 28;
        $x = 5;
        $y = 0;
        $i = 0;

        $postulantes = Postulante::select('postulante.*','f.nombre as facnom','e.codigo as codesp')
        						->with('ingresantes')
        						->join('ingresante as i','i.idpostulante','=','postulante.id')
        						->join('especialidad as e','e.id','=','i.idespecialidad')
        						->join('facultad as f','f.id','=','e.idfacultad')
        						->orderBy('facnom')
        						->orderBy('codesp')
        						->orderBy('paterno')
        						->orderBy('materno')
        						->orderBy('nombres')
        						->get();

        $facultad = $postulantes[0]->ingresantes->facultad;
        $codes = $postulantes[0]->ingresantes->codigo_especialidad;
        $especialidad = $postulantes[0]->ingresantes->especialidad;
        $this->TituloColumnas($facultad,$codes,$especialidad);
        foreach ($postulantes as $key => $postulante) {
            if($facultad != $postulante->ingresantes->facultad){
                PDF::AddPage('L', 'A4');
                Reportheader('L');
                Reportfooter('','L');
                $facultad = $postulante->ingresantes->facultad;
                $codes = $postulante->ingresantes->codigo_especialidad;
                $especialidad = $postulante->ingresantes->especialidad;
                $this->TituloColumnas($facultad,$codes,$especialidad);

                $y = 0;
                $i = 0;
            }
            if($especialidad != $postulante->ingresantes->especialidad){
                PDF::AddPage('L', 'A4');
                Reportheader('L');
                Reportfooter('','L');
                $codes = $postulante->ingresantes->codigo_especialidad;
                $especialidad = $postulante->ingresantes->especialidad;
                $this->TituloColumnas($facultad,$codes,$especialidad);

                $y = 0;
                $i = 0;
            }

        	if($i%$numMaxLineas==0 && $i!=0){
                PDF::AddPage('L', 'A4');
                Reportheader('L');
                Reportfooter('','L');
                $this->TituloColumnas($facultad,$codes,$especialidad);
                $y = 0;
            }

            if(($i+1)%5==0 && $i!=0){
                PDF::SetXY($x+10, $y*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 10);
                PDF::Cell(280, 5, '', 'B', 0, 'C');
            }
            #

            PDF::SetFont('helvetica', '', 9);
            #
            PDF::SetXY($x+10, $y*$altodecelda+$incremento);
            PDF::Cell(10, 5, $i+1, 0, 0, 'C');
            #
            PDF::SetXY($x+20, $y*$altodecelda+$incremento);
            PDF::Cell(15, 5, $postulante->codigo, 0, 1, 'C');
            #
            PDF::SetXY($x+35, $y*$altodecelda+$incremento);
            PDF::Cell(15, 5, $postulante->numero_identificacion, 0, 1, 'C');
            #
            PDF::SetXY($x+50, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 8);
            PDF::Cell(50, 5, $postulante->nombre_completo, 0, 1, 'L',0,'',1);
            PDF::SetFont('helvetica', '', 9);
            #
            PDF::SetXY($x+100, $y*$altodecelda+$incremento);
            PDF::Cell(20, 5, '*'.$postulante->ingresantes->codigo_especialidad.'*', 0, 1, 'C');
            #
            PDF::SetXY($x+120, $y*$altodecelda+$incremento);
            PDF::Cell(20, 5, $postulante->ingresantes->e1, 0, 1, 'R');
            #
            PDF::SetXY($x+140, $y*$altodecelda+$incremento);
            PDF::Cell(20, 5, $postulante->ingresantes->e2, 0, 1, 'R');
            #
            PDF::SetXY($x+160, $y*$altodecelda+$incremento);
            PDF::Cell(20, 5, $postulante->ingresantes->e3, 0, 1, 'R');
            #
            PDF::SetXY($x+180, $y*$altodecelda+$incremento);
            PDF::Cell(15, 5, $postulante->ingresantes->n, 0, 1, 'R');
            #
            if ($postulante->ingresantes->codigo_especialidad=='A1') {
                #
                PDF::SetXY($x+200, $y*$altodecelda+$incremento);
                PDF::Cell(16, 5, $postulante->ingresantes->nv, 0, 1, 'R');
                #
                PDF::SetXY($x+220, $y*$altodecelda+$incremento);
                PDF::Cell(16, 5, $postulante->ingresantes->na, 0, 1, 'R');
                #
            }
            $modalidad = str_replace(['EXTRAORDINARIO2 – ','EXTRAORDINARIO1 - '], '',$postulante->ingresantes->modalidad);
            PDF::SetXY($x+240, $y*$altodecelda+$incremento);
            PDF::Cell(35, 5, $modalidad, 0, 1, 'R',0,'',1);


            $y++;
            $i++;

        }

        PDF::Output(public_path('storage/tmp/')."listado_general.pdf",'FI');
    }
    function TituloColumnas($facultad=null,$codes,$especialidad = null){
        $y=50;
        $x=5;

        #TITULO REPORTE
        PDF::SetXY(35,30);
        PDF::SetTextColor(255,0,0);
        PDF::SetFont('helvetica','BI',12);
        PDF::Cell(230,5,"LISTADO GENERAL DE INGRESANTES A LA UNI EN EL CONCURSO DE ADMISIÓN",0,2,'C');
        #
        PDF::SetXY(35,35);
        PDF::Cell(230,5,'FACULTAD DE '.$facultad,0,2,'C');
        #
        PDF::SetXY(35,40);
        PDF::Cell(230,5,$codes.' - '.$especialidad,0,2,'C');

        #
        PDF::SetXY(35,29);
        PDF::SetTextColor(255,0,0);
        PDF::SetFont('helvetica','B',12);
        PDF::Cell(150,5,'',0,2,'C');

        PDF::SetTextColor(0);
        #
        PDF::SetLineWidth(0.5);
        #
        PDF::SetXY($x+10, $y);
        PDF::SetFont('times', 'BI', 9);
        PDF::Cell(10, 5, 'Nº', 'BT', 0, 'C');
        #
        PDF::SetXY($x+20, $y);
        PDF::Cell(15, 5, 'CODIGO', 'BT', 1, 'C');
        #
        PDF::SetXY($x+35, $y);
        PDF::Cell(15, 5, 'DNI', 'BT', 1, 'C');
        #
        PDF::SetXY($x+50, $y);
        PDF::Cell(50, 5, 'APELLIDOS Y NOMBRES', 'BT', 1, 'C',0,'',1);
        #
        PDF::SetXY($x+100, $y);
        PDF::Cell(20, 5, 'OPC.', 'BT', 1, 'C',0,'',1);
        #
        PDF::SetXY($x+120, $y);
        PDF::Cell(20, 5, '1RA PRUEBA', 'BT', 1, 'C',0,'',1);
        #
        PDF::SetXY($x+140, $y);
        PDF::Cell(20, 5, '2DA PRUEBA', 'BT', 1, 'C',0,'',1);
        #
        PDF::SetXY($x+160, $y);
        PDF::Cell(20, 5, '3RA PRUEBA', 'BT', 1, 'C',0,'',1);
        #
        PDF::SetXY($x+180, $y);
        PDF::Cell(20, 5, 'NOTA N', 'BT', 1, 'C',0,'',1);
        #
        if ($codes=='A1') {

            PDF::SetXY($x+200, $y);
            PDF::Cell(20, 5, 'NOTA V', 'BT', 1, 'C',0,'',1);
            #
            PDF::SetXY($x+220, $y);
            PDF::Cell(20, 5, 'NOTA NA', 'BT', 1, 'C',0,'',1);
        }else{
            PDF::SetXY($x+200, $y);
            PDF::Cell(20, 5, '', 'BT', 1, 'C',0,'',1);
            #
            PDF::SetXY($x+220, $y);
            PDF::Cell(20, 5, '', 'BT', 1, 'C',0,'',1);

        }
        #
        PDF::SetXY($x+240, $y);
        PDF::Cell(35, 5, 'MODALIDAD', 'BT', 1, 'C',0,'',1);

        PDF::SetLineWidth(0.2);
    }
}
