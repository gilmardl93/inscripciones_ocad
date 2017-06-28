<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Colegio;
use App\Models\Modalidad;
use App\Models\Universidad;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class UniversidadController extends Controller
{
    public function index()
    {
        return view('admin.universidad.index');
    }
    public function store(Request $request)
    {
        Universidad::create($request->all());
        Alert::success('Universidad Registrado con exito');
        return back();
    }
    public function lista()
    {
        $Lista = Universidad::with(['Distrito','Paises'])->orderBy('nombre')->get();
        $res['data'] = $Lista;
        return $res;
    }
    public function universidad(Request $request)
    {
        $name = $request->varuni ?:'';
        $name = trim(strtoupper($name));

        #Valido la modalidad para restringir la UNI a los Titulado o Graduado en la UNI
        $idmodalidad = $request->varidmodalidad;
        $modalidad = Modalidad::find($idmodalidad);

        $cond = '<>';
        $coduni = 'TODAS';
        if (str_contains($modalidad->codigo,['E1TG','E1TE'])) { $coduni= 'UNI'; $cond = '<>';}
        if ($modalidad->codigo == 'E1TGU') { $coduni= 'UNI'; $cond = '='; $name = '';}


        #-------------------------------------------------------------------------------------
        $universidad = Universidad::select('id','codigo','nombre as text','gestion','idubigeo','idpais')
        					->with(['Distrito','Paises'])
                            ->where('codigo',$cond,$coduni)
        					->where('nombre','like',"%$name%")
        					->get();

        return $universidad;
    }
}
