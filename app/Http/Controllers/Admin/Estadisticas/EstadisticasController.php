<?php

namespace App\Http\Controllers\Admin\Estadisticas;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Solicitante;
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
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->paginate();
        $Pagos = Recaudacion::select('s.descripcion as descripcion',DB::raw('count(*) as cantidad'))
                            ->join('servicio as s','s.codigo','=','recaudacion.servicio')
                            ->groupBy('s.descripcion')
                            ->get();
        $Fotos = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();

        $Semibecas = Solicitante::select('otorga',DB::raw('count(*) as cantidad'))->Activo()->groupBy('otorga')->get();

        $Preinscritos_provincia = DB::table('est_pre_ins_region')->paginate(10);
        $Inscritos_provincia = DB::table('est_ins_region')->paginate(10);

        return view('admin.estadisticas.index',compact('Inscritos','Lista','Pagantes','Modalidades','Pagos','Fotos','Semibecas','Preinscritos_provincia','Inscritos_provincia'));
    }
}
