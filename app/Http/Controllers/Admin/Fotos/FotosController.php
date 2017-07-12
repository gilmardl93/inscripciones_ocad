<?php

namespace App\Http\Controllers\Admin\Fotos;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
class FotosController extends Controller
{
    public function index()
    {
        $postulante = Postulante::where('foto_estado','CARGADO')->orderBy('foto_fecha_carga')->first();
        $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
    	if(isset($postulante)){
           return view('admin.fotos.index',compact('postulante','resumen'));
        }else{
           Alert::success('No hay Foto por Editar');
           return view('admin.fotos.blank',compact('resumen'));
        }
    }
    public function buscar(Request $request)
    {
        $postulante = Postulante::where('numero_identificacion',$request->get('dni'))->first();
        $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
        return view('admin.fotos.index',compact('postulante','resumen'));
    }
    public function update($id,$estado)
    {
    	$postulante = Postulante::find($id);
    	$archivo = 'public/'.$postulante->foto;
        $nuevo_archivo = 'public/fotosok/'.$postulante->numero_identificacion.extension($archivo);
        $nuevo_archivo_tmp = 'public/fotosok/tmp/'.$postulante->numero_identificacion.extension($archivo);
        $nuevo_archivo_rechazo = 'public/fotos_rechazadas/'.$postulante->foto;
    	$nuevo_archivo_rechazo = str_replace('fotos/','',$nuevo_archivo_rechazo);
        switch ($estado) {
            case '1':
                if(!Storage::exists($nuevo_archivo))Storage::copy($archivo, $nuevo_archivo);
                if(!Storage::exists($nuevo_archivo_tmp))Storage::copy($archivo, $nuevo_archivo_tmp);

                chmod(storage_path('app/'.$nuevo_archivo),0777);
                chmod(storage_path('app/'.$nuevo_archivo_tmp),0777);

                $postulante->foto_estado = 'ACEPTADO';
                $nuevo_archivo = str_replace('public/','',$nuevo_archivo);
                $postulante->foto_editada = $nuevo_archivo;
                $postulante->foto_fecha_edicion = Carbon::now();

                $postulante->save();
                break;

            case '0':
                if (Storage::exists($archivo)) {
                    if(!Storage::exists($nuevo_archivo_rechazo))Storage::copy($archivo, $nuevo_archivo_rechazo);
                }
                $postulante->foto_estado = 'RECHAZADO';
                $postulante->foto_rechazada = $postulante->foto;
                $postulante->foto_cargada = 'avatar/nofoto.jpg';
                $postulante->foto_fecha_rechazo = Carbon::now();

                $postulante->save();
    			break;
    	}
    	return redirect()->route('admin.fotos.index');
    }
    public function cargareditado(Request $request)
    {
        $postulante = Postulante::find($request->idpostulante);
        $postulante->foto_estado = 'ACEPTADO';

        $fileContents = file_get_contents($request->nueva_imagen);
        $nuevo_archivo = 'fotosok/'.$postulante->numero_identificacion.extension($postulante->foto);
        Storage::put('public/'.$nuevo_archivo,$fileContents);
        chmod(storage_path('app/public/'.$nuevo_archivo),0777);
        $postulante->foto_editada = $nuevo_archivo;
        $postulante->foto_fecha_edicion = Carbon::now();
        $postulante->save();
    }
    public function fotosrechazadas()
    {
        $Lista = Postulante::where('foto_estado','RECHAZADO')->get();
        return view('admin.fotos.list',compact('Lista'));
    }

}
