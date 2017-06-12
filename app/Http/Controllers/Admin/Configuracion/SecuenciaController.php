<?php

namespace App\Http\Controllers\Admin\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Secuencia;
use DB;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
class SecuenciaController extends Controller
{
    public function index()
    {
    	$Lista = Secuencia::all();
    	return view('admin.secuencia.index',compact('Lista'));
    }
    public function store(Request $request)
    {
    	$secuencia = Secuencia::create(['nombre'=>$request->input('nombre')]);
    	if($secuencia->id>0){
    		$sql = "
    		create sequence $secuencia->nombre ;
    		";
    		if(DB::statement($sql)){
    			Alert::success('Secuencia creada con exito');
    			return redirect()->route('admin.secuencia.index');
    		}

    	};


    }
    public function edit($id)
    {
    	$secuencia = Secuencia::find($id);
    	return view('admin.secuencia.edit',compact('secuencia'));
    }
    public function update(Request $request,$id)
    {
    	$secuencia = Secuencia::find($id);
    	if(DB::statement('ALTER SEQUENCE '.$secuencia->nombre.' RESTART WITH '.$request->input('numero'))){
            Alert::success('Numeracion Actualizada con exito');
        }
    	Alert::success('Secuencia actualizada con exito');
    	return redirect()->route('admin.secuencia.index');
    }
    public function delete($id)
    {
    	$secuencia = Secuencia::find($id);
    	$secuencia->delete();
    	$sql = "
    		drop sequence $secuencia->nombre ;
    		";
    		if(DB::statement($sql)){
    			Alert::success('Secuencia creada con exito');
    			return redirect()->route('admin.secuencia.index');
    		}

    }
}
