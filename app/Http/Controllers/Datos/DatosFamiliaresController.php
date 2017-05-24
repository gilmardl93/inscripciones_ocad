<?php

namespace App\Http\Controllers\Datos;

use App\Events\AfterUpdatingDataFamily;
use App\Http\Controllers\Controller;
use App\Models\Familiar;
use App\Models\Postulante;
use Auth;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class DatosFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulante = Postulante::Usuario()->first();
        $familiar = Familiar::where('idpostulante',$postulante->id)->orderBy('orden')->get();

        if($familiar->isEmpty())return view('datos.familiar.index',compact('postulante'));
        return view('datos.familiar.edit',compact('familiar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $sw = Familiar::insert([
                [
                'idpostulante'=>$data['idpostulante'],
                'paterno'=>$data['paterno'][0],
                'materno'=>$data['materno'][0],
                'nombres'=>$data['nombres'][0],
                'dni'=>$data['dni'][0],
                'email'=>$data['email'][0],
                'direccion'=>$data['direccion'][0],
                'telefonos'=>$data['telefonos'][0],
                'parentesco'=>$data['parentesco'][0],
                'orden'=>$data['orden'][0]
                ],
                [
                'idpostulante'=>$data['idpostulante'],
                'paterno'=>$data['paterno'][1],
                'materno'=>$data['materno'][1],
                'nombres'=>$data['nombres'][1],
                'dni'=>$data['dni'][1],
                'email'=>$data['email'][1],
                'direccion'=>$data['direccion'][1],
                'telefonos'=>$data['telefonos'][1],
                'parentesco'=>$data['parentesco'][1],
                'orden'=>$data['orden'][1]
                ],
                [
                'idpostulante'=>$data['idpostulante'],
                'paterno'=>$data['paterno'][2],
                'materno'=>$data['materno'][2],
                'nombres'=>$data['nombres'][2],
                'dni'=>$data['dni'][2],
                'email'=>$data['email'][2],
                'direccion'=>$data['direccion'][2],
                'telefonos'=>$data['telefonos'][2],
                'parentesco'=>$data['parentesco'][2],
                'orden'=>$data['orden'][2]
                ]
            ]);
        if ($sw) {
        $postulante = Postulante::find($data['idpostulante']);
            event(new AfterUpdatingDataFamily($postulante));
        }
        Alert::success('Se actualizaron sus datos con exito');
        return redirect()->route('datos.index');
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
    public function update(Request $request)
    {
        $data = $request->all();
        Familiar::Actualizar($data);

        Alert::success('Se actualizaron sus datos con exito');
        return redirect()->route('datos.index');
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
