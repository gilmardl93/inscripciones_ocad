<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use PDF;
class EtiquetasController extends Controller
{
    public function index()
    {
    	return view('admin.ingresantes.etiquetas.index');
    }
    public function pdf()
    {
    	PDF::SetTitle('Etiquetas Folders');

        PDF::SetFillColor(197,197,197);
		PDF::SetTextColor(0);
		PDF::SetDrawColor(0,0,0);
		PDF::SetLineWidth(0.25);
        PDF::SetAutoPageBreak(false);

		$pagina=0;
		$numlineas=4;
		$numcolumnas=2;
		$lineaActual=0;
		$anchoCelda=93;
		$altoCelda=45;
		$columnaActual=0;
		$secuencia=0;


        $postulantes = Postulante::with('ingresantes')->has('ingresantes')->whereIn('numero_identificacion',['72430674','77341542'])->get();

        foreach ($postulantes as $key => $postulante) {
			if((($columnaActual==$numcolumnas-1)&&($lineaActual>$numlineas))||($pagina==0)){
				PDF::AddPage('U','A4');
				$lineaActual=0;
				$pagina++;
				$columnaActual=0;

			}
			if($lineaActual>$numlineas){$columnaActual++;$lineaActual=0;}

			$x1=$columnaActual*$anchoCelda+7+($columnaActual%2)*10;
			$y1=$lineaActual*$altoCelda+25+$lineaActual*6;
			$secuencia++;

			PDF::SetLineWidth(0.5);
            PDF::SetFont('helvetica','B',11);
            PDF::SetXY($x1,$y1);
            PDF::Cell($anchoCelda,$altoCelda-1,"",1,1,'C');
	        #
	        PDF::SetXY($x1,$y1+3);
	        PDF::SetFont('helvetica','B',14);
	        PDF::Cell(93,5,$postulante->nombre_completo,0,2,'L',0,'',1);
	        #
	        PDF::SetXY($x1,$y1+10);
	        PDF::SetFont('helvetica','',14);
	        PDF::Cell(93,5,$postulante->ingresantes->modalidad ,0,2,'L',0,'',1);
	        #
	        PDF::SetXY($x1,$y1+17);
	        PDF::SetFont('helvetica','',14);
	        PDF::Cell(93,5,$postulante->ingresantes->codigo_especialidad.' - '.$postulante->ingresantes->especialidad ,0,2,'L',0,'',1);
	        #
	        PDF::SetXY($x1+7,$y1+25);
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


            $lineaActual++;
        }


    	PDF::Output(public_path('storage/tmp/')."etiquetas_folderes.pdf",'FI');
    }

}
