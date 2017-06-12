<?php

namespace App\Http\Controllers\Datos;

use App\Events\AfterUpdatingDataQuiz;
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
        $complementarios = Complementario::where('idpostulante',IdPostulante())->first();
        if(is_null($complementarios))return view('datos.complementarios.index',compact('postulante'));
        return view('datos.complementarios.edit',compact('complementarios'));
    }
    public function store(CreateComplementarioRequest $request)
    {
        $data = $request->all();
        if(!$request->has('idrenuncia'))$data['idrenuncia']=null;

        $sw = Complementario::create($data);
        if ($sw) {
            $postulante = Postulante::find(IdPostulante());
            event(new AfterUpdatingDataQuiz($postulante));
        }
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
        $data = $request->all();
        if(!$request->has('idrenuncia'))$data['idrenuncia']=null;

        $complementarios->fill($data);
        $complementarios->save();
        Alert::success('Se actualizaron sus datos con exito');
        return redirect()->route('datos.index');
    }

}
