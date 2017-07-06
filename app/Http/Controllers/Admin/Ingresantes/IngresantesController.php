<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Alert;
class IngresantesController extends Controller
{
    public function index()
    {
    	$Lista = [];
    	return view('admin.ingresantes.index',compact('Lista'));
    }
    public function search(Request $request)
    {
    	$Lista = Postulante::has('ingresantes')->where('numero_identificacion','like','%'.$request->get('dni').'%')->get();
    	if ($Lista->count()==0) Alert::warning('No existe este DNI como ingresante');

    	return view('admin.ingresantes.index',compact('Lista'));
    }
    public function show($id)
    {
    	$postulante = Postulante::with('ingresantes')->find($id);
    	return view('admin.ingresantes.show',compact('postulante'));
    }
    public function pdfdatos($id)
    {
        # code...
    }
}
