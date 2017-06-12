<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDatosRequest;
use App\Models\Postulante;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
class DatosController extends Controller
{
    public function index()
    {
        $postulante = Postulante::Usuario()->first();
        $swp = !is_null($postulante);
        return view('datos.index',compact('swp'));
    }
    public function store(UpdateDatosRequest $request)
    {
    	$data = $request->all();
        $date = Carbon::now();
        if ($request->hasFile('file')) {
            $data['foto'] = $request->file('file')->store('fotos','public');
            $data['fecha_foto']=$date;
            $data['foto_estado']='CARGADO';
        }
        $data['idevaluacion'] = IdEvaluacion();
        $data['idusuario'] = Auth::user()->id;
        $data['fecha_registro'] = $date;

        Postulante::create($data);
        Alert::success('se registro sus datos con exito');
        return redirect()->route('home.index');
    }
    public function update(UpdateDatosRequest $request,$id)
    {
    	$data = $request->all();
        $postulante = Postulante::find($id);
        $date = Carbon::now();
        if ($request->hasFile('file') && $postulante->foto_estado!='ACEPTADO') {
            if(!str_contains($postulante->foto,'nofoto'))
        	Storage::delete("/public/$postulante->foto");

            $data['foto'] = $request->file('file')->store('fotos','public');
            $data['fecha_foto']=$date;
            $data['foto_estado']='CARGADO';
        }
        $data['idevaluacion'] = IdEvaluacion();
        $data['idusuario'] = Auth::user()->id;

        $postulante->fill($data);
        $postulante->save();

        Alert::success('se actualizo sus datos con exito');
        return redirect()->route('home.index');
    }
}
