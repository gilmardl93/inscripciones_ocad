<?php

namespace App\Http\Controllers\Admin\Postulantes;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\User;
use Illuminate\Http\Request;
class PostulantesController extends Controller
{
    public function buscar(Request $request)
    {
        $name = strtoupper($request->input('name'));
        $postulantes = Postulante::whereRaw("numero_identificacion||' '||clearstring(paterno)||' '||clearstring(materno)||clearstring(nombres) like '%$name%'")->paginate();
        if($postulantes->total()>0){
            return view('admin.postulantes.index',compact('postulantes'));
        }else{
            $postulantes = [];
            Alert::danger('No hay coincidencias con su busqueda');
            return back();
        }

    }
    public function show($id)
    {
        $postulante = Postulante::with(['Recaudaciones','Usuarios'])->find($id);
        return view('admin.postulantes.show',compact('postulante'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);
        $postulante = Postulante::select('idusuario')->where('id',$request->input('idpostulante'))->first();

        User::where('id',$postulante->idusuario)->update(['password'=>bcrypt($request->input('password'))]);

        Alert::success('Clave Actualizada con exito');
        return back();
    }
    public function update(Request $request,$id)
    {
        $postulante = Postulante::find($id);
        $postulante->fill($request->all());
        $postulante->save();
        Alert::success('Datos Actualizados con exito');
        return back();
    }

    public function index()
    {
    	return view('admin.postulantes.index');
    }
    public function lista()
    {
	    $Lista = Postulante::Activos()->with(['Sexo','Sedes','Grado','Ubigeos','Especialidades','Colegios','Aulas'])->get();
	    $res['data'] = $Lista;
	    return $res;
    }
    public function ficha($id)
    {
        return view('admin.postulantes.ficha',compact('id'));
    }
    public function pago($id)
    {
        return view('admin.postulantes.pago',compact('id'));
    }
}
