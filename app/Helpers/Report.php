<?php

use App\Models\Evaluacion;

if (! function_exists('Reportheader')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function Reportheader($orientacion='U')
    {
        $examen = Evaluacion::first();
    	PDF::Image(public_path('assets/pages/img/').'logo-uni.jpg',15,7,13);
    	PDF::SetFont('helvetica','B',9);
        PDF::SetXY(29,10);
        PDF::Cell(150,5,'UNIVERSIDAD NACIONAL DE INGENIERÍA',0,2,'L');
        PDF::SetXY(29,13);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(150,5,'OFICINA CENTRAL DE ADMISIÓN',0,2,'L');
        PDF::SetXY(29,17);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(150,5,$examen->nombre,0,2,'L');
        #
        PDF::SetXY(29,20);
		PDF::Cell(150,5,'',0,0,'L');
        #   NUMERO DE PAGINA
        $x = ($orientacion=='U') ? 160 : 260 ;

        PDF::SetFont('helvetica', 'B', 8);
        PDF::SetXY($x, 10);
        PDF::Cell(13, 5, "Fecha :", 0, 0, 'L');
        PDF::SetXY($x+13, 10);
        PDF::Cell(17, 5, date('d/m/Y'), 0, 0, 'R');
        PDF::SetXY($x, 13);
        PDF::Cell(13, 5, "Hora :", 0, 0, 'L');
        PDF::SetXY($x+13, 13);
        PDF::Cell(17, 5, date('H:i:s'), 0, 0, 'R');
        PDF::SetXY($x, 17);
        PDF::Cell(13, 5, 'Página :', 0, 0, 'L');
        PDF::SetXY($x+13, 17);
        $pagina = trim(PDF::PageNo().' de '.PDF::getAliasNbPages());
        PDF::Cell(17, 5,$pagina, 0, 0, 'R');
    }
}

if (! function_exists('Reportfooter')) {
    /**
     * Funcion que retorna el prefijo para nombres de archivos
     * @return [type] [description]
     */
    function Reportfooter($codigo=null)
    {
        PDF::SetTextColor(0);
        PDF::SetLineWidth(0.5);
        PDF::SetFont('helvetica', '', 9);
        PDF::Line(12,285,200,285);
        PDF::SetXY(15,-28);
        //PDF::Text(55,285,$codigo);
        PDF::Text(150,285,'Oficina Central de Admisión');
    }
}