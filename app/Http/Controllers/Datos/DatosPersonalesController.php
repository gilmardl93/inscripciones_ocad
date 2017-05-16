<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatosPersonalesRequest;
use App\Models\Postulante;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
class DatosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulante = Postulante::Usuario()->first();

        if(is_null($postulante))return view('datos.personal.index',compact('dni'));
        else return view('datos.personal.edit',compact('postulante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DatosPersonalesRequest $request)
    {
        $data = $this->AnulaModalidad2($request);

        $date = Carbon::now();
        $data['idevaluacion'] = IdEvaluacion();
        $data['idusuario'] = Auth::user()->id;
        $data['fecha_registro'] = $date;

        Postulante::create($data);
        Alert::success('se registro sus datos con exito, puede proceder a imprimir su formato de pago');
        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DatosPersonalesRequest $request, $id)
    {
        $data = $this->AnulaModalidad2($request);

        $postulante = Postulante::find($id);
        $postulante->fill($data);
        $postulante->save();
        Alert::success('se actualizo sus datos con exito');
        return redirect()->route('datos.index');
    }
    /**
     * Quita la modalidad 2 y sus derivados cuando solo se escoge una modalidad
     * @param [type] $request [description]
     */
    public function AnulaModalidad2($request)
    {
        $data = $request->all();
        if(!$request->has('idmodalidad2')){
            $data = array_except($data, ['codigo_verificacion','idmodalidad2','idespecialidad2']);
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
