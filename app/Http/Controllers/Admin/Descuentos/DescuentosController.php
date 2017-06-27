<?php

namespace App\Http\Controllers\Admin\Descuentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDescuentoRequest;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Alert;
class DescuentosController extends Controller
{
    public function index()
    {
    	$Lista = Descuento::all();
    	return view('admin.descuentos.index',compact('Lista'));
    }
    public function store(CreateDescuentoRequest $request)
    {
    	Descuento::create($request->all());
    	Alert::success('Descuento Registrado con exito');
    	return back();
    }
    public function edit($id)
    {
    	$descuento = Descuento::find($id);
    	return view('admin.descuentos.edit',compact('descuento'));
    }
    public function update(CreateDescuentoRequest $request,$id)
    {
    	$descuento = Descuento::find($id);
    	$descuento->fill($request->all());
    	$descuento->save();
    	Alert::success('Descuento Actualizado con exito');
    	return redirect()->route('admin.descuentos.index');
    }
    public function activate($id)
    {
    	$descuento = Descuento::find($id);
    	$descuento->activo = !$descuento->activo;
    	$descuento->save();
    	Alert::success('El Registro se actualizo con exito');
    	return back();
    }
}
