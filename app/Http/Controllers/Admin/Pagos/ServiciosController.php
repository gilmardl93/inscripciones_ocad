<?php

namespace App\Http\Controllers\Admin\Pagos;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Alert;
class ServiciosController extends Controller
{
    public function index()
    {
    	$Lista = Servicio::all();
    	return view('admin.servicios.index',compact('Lista'));
    }
    public function edit($id)
    {
    	$servicio = Servicio::find($id);
    	return view('admin.servicios.edit',compact('servicio'));
    }
    public function update(Request $request,$id)
    {
    	$servicio = Servicio::find($id);
    	$servicio->fill($request->all());
    	$servicio->save();
    	Alert::success('El Registro se actualizo con exito');
    	return redirect()->route('admin.servicios.index');

    }
    public function activate($id)
    {
    	$servicio = Servicio::find($id);
    	$servicio->activo = !$servicio->activo;
    	$servicio->save();
    	Alert::success('El Registro se actualizo con exito');
    	return back();
    }
}
