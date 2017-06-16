<?php

namespace App\Http\Controllers\Admin\Estadisticas;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use DB;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
   public function index()
    {
    	$Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
    						->IsNull(0)
    						->Activos()
    						->groupBy('fecha_registro')
    						->orderBy('fecha_registro','desc')
    						->paginate();
    	return view('admin.estadisticas.index',compact('Lista'));
    }
}
