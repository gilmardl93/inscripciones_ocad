<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Catalogo;
use App\Models\Postulante;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Storage;
use Styde\Html\Facades\Alert;
class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->codigo_rol) {
            case 'root':
                $Lista = User::all();
                break;
            case 'admin':
                $idrol = IdRole('alum');
                $Lista = User::where('idrole',$idrol)->get();
                break;
            case 'informes':
                $idrol = IdRole('alum');
                $Lista = User::where('idrole',$idrol)->get();
                break;

            default:
                $Lista = [];
                break;
        }

        return view('admin.users.index',compact('Lista'));
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
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $data['foto'] = $request->file('file')->store('avatar','public');
        };
        User::create($data);
        Alert::success('Usuario Registrado con exito');
        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $datos = Postulante::where('idusuario',$user->id)->first();
        $retVal = (isset($datos)) ? 'Tiene Datos de postulante ingresado' : '' ;
        if (isset($datos)) {
            Alert::danger('ALERTA')->details('No podrá eliminar este registro porque')
                               ->items([$retVal]);
        }else{
            Alert::danger('ALERTA')->details('Esta seguro de eliminar este registro no podra deshacer esta opcion');
        }
        return view('admin.users.delete',compact('user','datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
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
        $user = User::find($id);
        if ($request->has('password')) {
            $user->dni = $request->input('dni');
            $user->password = $request->input('password');
        }elseif ($request->hasFile('file')) {
            if(!str_contains($user->foto,'nofoto'))Storage::delete("/public/$user->foto");

            $user->foto = $request->file('file')->store('avatar','public');
        }else{
            $user->dni = $request->input('dni');
            $user->idrole = $request->input('idrole');
        }
        $user->save();
        Alert::success('Usuario actualizado');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Alert::success('Usuario Eliminado');
        return redirect()->route('admin.users.index');
    }
}
