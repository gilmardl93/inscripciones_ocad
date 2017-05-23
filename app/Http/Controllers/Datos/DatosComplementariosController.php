<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComplementarioRequest;
use App\Models\Complementario;
use App\Models\Postulante;
use Auth;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
class DatosComplementariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulante = Postulante::Usuario()->first();
        $complementarios = Complementario::where('idpostulante',$postulante->id)->first();

        if($complementarios->count()<1)return view('datos.complementarios.index',compact('postulante'));
        return view('datos.complementarios.edit',compact('complementarios'));
    }
    public function store(CreateComplementarioRequest $request)
    {
        Complementario::create($request->all());
        Alert::success('Se registro sus datos con exito');
        return redirect()->route('datos.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $complementarios = Complementario::find($id);
        $complementarios->fill($request->all());
        $complementarios->save();
        Alert::success('Se actualizaron sus datos con exito');
        return redirect()->route('datos.index');
    }

}
