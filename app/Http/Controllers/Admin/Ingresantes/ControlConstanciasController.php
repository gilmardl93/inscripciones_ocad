<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Ingresante;
use App\Models\Postulante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
class ControlConstanciasController extends Controller
{
    public function index()
    {
        $Lista = Postulante::with('ingresantes')->whereHas('ingresantes', function ($query) {
						    $query->where('estado_constancia', 'ENTREGADO');
						})->get();
        if ($Lista->count()==0) $Lista = [];

        return view('admin.ingresantes.control.index',compact('Lista'));
    }
    public function store(Request $request)
    {
        $rules = array (
                'dni' => 'required'
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()) {
            return [
                   'errors' => $validator->getMessageBag()->toArray()
                    ];
        }else {
            $postulante = Postulante::where('numero_identificacion',$request->dni)->first();
            $date = Carbon::now();
            Ingresante::where('idpostulante',$postulante->id)->update(['estado_constancia'=>'ENTREGADO','fecha_constancia'=>$date]);
    	    $Lista = Postulante::with('ingresantes')->whereHas('ingresantes', function ($query) {
                                    $query->where('estado_constancia', 'ENTREGADO');
                                })->get();
            if ($Lista->count()==0) {
                return[
                    'errors'=> ['dni'=>'No constancias registradas']
                ];
            } else {
                return response ()->json ( $Lista );
            }

        }
    }
}
