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
        $Inscritos = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_conformidad')
                            ->orderBy('fecha_conformidad','desc')
                            ->paginate();

    	$Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
    						->IsNull(0)
    						->Activos()
    						->groupBy('fecha_registro')
    						->orderBy('fecha_registro','desc')
    						->paginate();
        $Pagantes = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                            ->where('pago',1)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','desc')
                            ->paginate();
        $Modalidades = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->groupBy('m.nombre')
                            ->paginate();

    	return view('admin.estadisticas.index',compact('Inscritos','Lista','Pagantes','Modalidades'));
    }
}
