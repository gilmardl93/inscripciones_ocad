<?php

namespace App\Http\Controllers\Contacto;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
use App\Models\Mensaje;
use App\Models\Postulante;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
class ContactoController extends Controller
{
    public function index()
    {
    	$postulante = Postulante::Usuario()->first();
        if (isset($postulante)) {
            $mensajes = Mensaje::where('idpostulante',$postulante->id)->orderBy('created_at')->get();
    	   return view('contacto.index',compact('mensajes'));
        }else{
            Alert::warning('Debe realizar su Preinscripción para acceder a esta opción');
            return back();
        }
    }
    public function store(ContactoRequest $request)
    {
    	$postulante = Postulante::Usuario()->first();
    	if (isset($postulante)) {
	    	$data = $request->all();
            $data['idpostulante'] = $postulante->id;
            Mensaje::create($data);
	    	//Notification::send($user,new PreguntasNotification($postulante,$data));
	    	Alert::success('Mensaje enviado con exito');
	    	return back();
    	}else{
	    	Alert::success('Ingrese sus datos para poder enviar mensajes');
	    	return back();
    	}
    }
    public function listar()
    {
        $postulante = Postulante::Usuario()->first();
        if (isset($postulante)) {
            $mensajes = Mensaje::where('idpostulante',$postulante->id)->orderBy('created_at','desc')->get();
        }else{
            $mensajes = null;
        }
        return view('contacto.listamensaje',compact('mensajes'));
    }
}
