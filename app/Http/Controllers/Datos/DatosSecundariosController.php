<?php

namespace App\Http\Controllers\Datos;

use App\Events\AfterUpdatingDataPersonal;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSecundariosRequest;
use App\Models\Postulante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;

class DatosSecundariosController extends Controller
{
    public function index()
    {
    	$postulante = Postulante::Usuario()->first();
    	return view('datos.secundarios.index',compact('postulante'));

    }
    public function update(UpdateSecundariosRequest $request,$id)
    {
        $data = $request->all();
        $date = Carbon::now();
    	$postulante = Postulante::find($id);

        if ($request->hasFile('file') && $postulante->foto_estado!='ACEPTADO') {
            if(!str_contains($postulante->foto_cargada,'nofoto'))
            Storage::delete("/public/$postulante->foto_cargada");

            $data['foto_cargada'] = $request->file('file')->store('fotos','public');
            $data['foto_estado']='CARGADO';
            $data['foto_fecha']=$date;
        }

        $postulante->fill($data);

        if ($postulante->save()) {
            event(new AfterUpdatingDataPersonal($postulante));
        }

        Alert::success('se actualizo sus datos con exito');
        return redirect()->route('home.index');
    }
}

