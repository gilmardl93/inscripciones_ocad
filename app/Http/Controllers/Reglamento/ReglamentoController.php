<?php

namespace App\Http\Controllers\Reglamento;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;

class ReglamentoController extends Controller
{
    public function index()
    {
    	return view('reglamento.index');
    }
    public function documento($doc)
    {
    	$headers = [];
    	return response()->download(
    			storage_path('app/documentos/'.$doc.'.pdf'),
    			null,
    			$headers
    		);
    }
}
