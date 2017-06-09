<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Alert;
class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
    	$name = strtoupper($request->input('name'));
    	$postulantes = Postulante::whereRaw("numero_identificacion||' '||paterno||' '||materno||nombres like '%$name%'")->get();

    	if($postulantes->count()>0){
    		return view('admin.postulantes.index',compact('postulantes'));
    	}else{
    		$postulantes = [];
    		Alert::danger('No hay coincidencias con su busqueda');
    		return view('admin.postulantes.index',compact('postulantes'));
    	}

    }
}
