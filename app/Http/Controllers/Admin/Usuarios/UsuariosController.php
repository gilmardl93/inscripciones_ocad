<?php

namespace App\Http\Controllers\Admin\Usuarios;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsuariosRequest;
use App\User;
use Illuminate\Http\Request;
class UsuariosController extends Controller
{
    public function index()
    {
    	$Lista = [];
    	return view('admin.usuarios.index',compact('Lista'));
    }
    public function search(Request $request)
    {
    	$Lista = User::where('dni','like','%'.$request->get('dni').'%')->get();

    	return view('admin.usuarios.index',compact('Lista'));
    }
    public function editar($id)
    {
    	$user = User::findOrFail($id);
        return view('admin.usuarios.edit',compact('user'));
    }
    public function update(UpdateUsuariosRequest $request, $id)
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
        }
        $user->save();
        Alert::success('Usuario actualizado');
        $Lista = $user;
        return redirect()->route('admin.usuarios.index',compact('Lista'));
    }
}
