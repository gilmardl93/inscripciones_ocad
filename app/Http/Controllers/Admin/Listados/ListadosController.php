<?php

namespace App\Http\Controllers\Admin\Listados;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;

class ListadosController extends Controller
{
	public function index()
	{
    	$Lista = Postulante::with('Procesos')->where('datos_ok',0)->IsNull(0)->get();
    	return view('admin.listados.index',compact('Lista'));
	}
}
