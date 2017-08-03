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
                            ->paginate(10);

    	$Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
    						->IsNull(0)
    						->Activos()
    						->groupBy('fecha_registro')
    						->orderBy('fecha_registro','desc')
    						->paginate(10);
        $Pagantes = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                            ->where('pago',1)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','desc')
                            ->paginate(10);
        $Modalidades = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->orderBy('m.nombre')
                            ->paginate(5);
        $ModalidadesIns = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->orderBy('m.nombre')
                            ->paginate(5);
        $Pagos = Recaudacion::select('s.descripcion as descripcion',DB::raw('count(*) as cantidad'))
                            ->join('servicio as s','s.codigo','=','recaudacion.servicio')
                            ->groupBy('s.descripcion')
                            ->orderBy('descripcion')
                            ->get();
        $Fotos = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();

        $Semibecas = Solicitante::select('otorga',DB::raw('count(*) as cantidad'))->Activo()->groupBy('otorga')->get();

        $Preinscritos_provincia = DB::table('est_pre_ins_region')
                                    ->select('region',DB::raw("sum(cantidad) as cantidad"))
                                    ->groupBy('region')->paginate(10);
        $Inscritos_provincia = DB::table('est_ins_region')
                                    ->select('region',DB::raw("sum(cantidad) as cantidad"))
                                    ->groupBy('region')->paginate(10);

        $CepreUniPre = Postulante::where('idmodalidad',16)->IsNull(0)->Activos()->get()->count();
        $CepreUniIns = Postulante::where('idmodalidad',16)->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $CepreUniPag = Postulante::where('idmodalidad',16)->IsNull(0)->where('pago',1)->Activos()->get()->count();

        $CepreUniPreVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->Activos()->get()->count();
        $CepreUniInsVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $CepreUniPagVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->where('pago',1)->Activos()->get()->count();
        $CepreUniModalidad = DB::table('est_cepre_modalidad')->get();

        $PreVoca = Postulante::where('idespecialidad',1)->IsNull(0)->Activos()->get()->count();
        $InsVoca = Postulante::where('idespecialidad',1)->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $PagVoca = Postulante::where('idespecialidad',1)->IsNull(0)->where('pago',1)->Activos()->get()->count();

        return view('admin.estadisticas.index',compact(
            'Inscritos','Lista','Pagantes','Modalidades','Pagos','Fotos','Semibecas','Preinscritos_provincia','Inscritos_provincia',
            'CepreUniPre','CepreUniIns','CepreUniPag','CepreUniPreVoca','CepreUniInsVoca','CepreUniPagVoca','CepreUniModalidad',
            'PreVoca','InsVoca','PagVoca','ModalidadesIns'
            ));
    }
}
