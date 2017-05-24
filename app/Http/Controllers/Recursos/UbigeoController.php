<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Ubigeo;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    /**
     * Devuelve el Ubigeo
     * @return [type] [description]
     */
    public function ubigeo(Request $request)
    {
        $name = $request->varsearch ?:'';
        $name = trim(strtoupper($name));

        return Ubigeo::Obtener($name)->get();
    }
    /**
     * Devuelve datos de Pais
     * @return [type] [description]
     */
    public function pais(Request $request)
    {
        $idpais = $request->varsearch ?:'1';

        return Pais::find($idpais);
    }
}
