<?php

namespace App\Http\Controllers\Admin\Ventanilla;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportarPagosRequest;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Ventanilla;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
class VentanillaController extends Controller
{
	public function index()
	{
		return view('admin.ventanilla.index');
	}
	public function store(ImportarPagosRequest $request)
	{
		$date = Carbon::parse($request->get('fecha'))->toDateString();
		$this->obtener($date);
	}

    public function obtener($fecha = null)
    {
    	if (!isset($fecha)) $date = Carbon::now()->toDateString();

    	$recibos = Recaudacion::select('recibo')->get()->toArray();
    	$pagos = Ventanilla::where('fecha',$date)->whereNotIn('recibo',$recibos)->get();
    	if(!$pagos->isEmpty()){
	    	$contador = 0;
	    	$sw = false;
	    	foreach ($pagos as $key => $item) {
	    		$postulante = Postulante::where('numero_identificacion',$item->codigo)->first();
	    		if (!isset($postulante)) {
	    			Alert::warning('Peligro con este registro')
	    				 ->items([
	    				 	'codigo: '.$item->codigo,
	    				 	'nombre: '.$item->cliente,
	    				 	'servicio: '.$item->servicio,
	    				 	'monto: '.$item->precio,
	    				 	'fecha: '.$item->fecha,
	    				 	]);
	    			break;
	    		}
	    		Recaudacion::create([
	    				'servicio'=>$item->servicio,
	                    'recibo'=>$item->recibo,
	                    'descripcion'=>$item->descripcion,
	                    'monto'=>$item->precio,
	                    'fecha'=>$item->fecha,
	                    'codigo'=>$item->codigo,
	                    'nombrecliente'=>substr($item->cliente,0,100),
	                    'banco'=>$item->banco,
	                    'referencia'=>$item->numero_comprobante,
	    			]);
	    		$sw = true;
	    		$contador++;
	    	}
    		if($sw)Alert::success('Se han registrado con exito '.$contador.' pagos.');
    	}else{
    		Alert::success('No hay pagos nuevos');
    	}//end if

    	return back();
    }
}
