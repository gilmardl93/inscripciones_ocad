<?php

namespace App\Http\Controllers\Admin\Ventanilla;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Ventanilla;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Alert;
use DB;
class VentanillaController extends Controller
{
    public function obtener()
    {
    	$date = Carbon::now()->toDateString();
    	$recibos = Recaudacion::select('recibo')->get()->toArray();
    	$pagos = Ventanilla::where('fecha',$date)->whereNotIn('recibo',$recibos)->get();
    	if(!$pagos->isEmpty()){
	    	$contador = 0;
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
    public function CreaJS()
    {
    	$query = "numero_identificacion||'-'||clearstring(paterno)||' '||clearstring(materno)||','||clearstring(nombres) as nombres";
    	$pagantes = Postulante::select(DB::raw($query))->Alfabetico()->Pagantes()->get();
    	dd($pagantes->toArray());

    }
}
