<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use PDF;
class ListadoFirmaController extends Controller
{
    public function listadofirma()
    {
    	return view('admin.ingresantes.listados.firma');
    }
    public function listadofirmapdf()
    {
    	PDF::SetTitle('LISTADO GENERAL DE INGRESANTES');
        PDF::AddPage('U','A4');
        PDF::SetAutoPageBreak(false);
        Reportheader();
    	Reportfooter();

    	$altodecelda=10;
        $incremento = 55;
        $numMaxLineas = 20;
        $x = 0;
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
                PDF::AddPage('U', 'A4');
                Reportheader();
                Reportfooter();
                $facultad = $postulante->ingresantes->facultad;
		        $codes = $postulante->ingresantes->codigo_especialidad;
		        $especialidad = $postulante->ingresantes->especialidad;
                $this->TituloColumnas($facultad,$codes,$especialidad);
                $y = 0;
                $i = 0;
            }
            if($especialidad != $postulante->ingresantes->especialidad){
                PDF::AddPage('U', 'A4');
                Reportheader();
                Reportfooter();
                $codes = $postulante->ingresantes->codigo_especialidad;
                $especialidad = $postulante->ingresantes->especialidad;
                $this->TituloColumnas($facultad,$codes,$especialidad);

                $y = 0;
                $i = 0;
            }

            if($i%$numMaxLineas==0 && $i!=0){
                PDF::AddPage('U', 'A4');
                Reportheader();
                Reportfooter();
                $this->TituloColumnas($facultad,$codes,$especialidad);
                $y = 0;
            }

            if(($i+1)%5==0 && $i!=0){
                PDF::SetXY($x+10, $y*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 10);
                PDF::Cell(140, 10, '', 'B', 0, 'C');
            }
            #
            #
            PDF::SetXY($x+10, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(10, 10, $i+1, 1, 0, 'C');
            #
            PDF::SetXY($x+20, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(20, 10, $postulante->codigo, 1, 1, 'C');
            #
            PDF::SetXY($x+40, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(20, 10, $postulante->numero_identificacion, 1, 1, 'C');
            #
            PDF::SetXY($x+60, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(90, 10, $postulante->nombre_completo, 1, 1, 'L');
            #
            PDF::SetXY($x+150, $y*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(50, 10, '', 1, 1, 'L');


            $y++;
            $i++;

        }

        PDF::Output(public_path('storage/tmp/')."listado_general_firma.pdf",'FI');
    }
    function TituloColumnas($facultad=null,$codes,$especialidad = null){
        $y=50;
        $x=0;

        #TITULO REPORTE
        PDF::SetXY(35,30);
        PDF::SetTextColor(255,0,0);
        PDF::SetFont('helvetica','BI',12);
        PDF::Cell(150,5,"Listado General de Ingresantes en Orden Alfabético",0,2,'C');
        #
        PDF::SetXY(35,35);
        PDF::Cell(150,5,'FACULTAD DE '.$facultad,0,2,'C');
        #
        PDF::SetXY(35,40);
        PDF::Cell(150,5,$codes.' - '.$especialidad,0,2,'C');

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
        PDF::SetFont('times', 'BI', 11);
        PDF::Cell(10, 5, 'Nº', 1, 0, 'C');
        #
        PDF::SetXY($x+20, $y);
        PDF::SetFont('times', 'BI', 11);
        PDF::Cell(20, 5, 'CODIGO', 1, 1, 'C');
        #
        PDF::SetXY($x+40, $y);
        PDF::Cell(20, 5, 'DNI', 1, 1, 'C');
        #
        PDF::SetXY($x+60, $y);
        PDF::Cell(90, 5, 'APELLIDOS Y NOMBRES', 1, 1, 'C');
        #
        PDF::SetXY($x+150, $y);
        PDF::Cell(50, 5, 'FIRMA', 1, 1, 'C');
        #
        PDF::SetLineWidth(0.2);
    }
}
