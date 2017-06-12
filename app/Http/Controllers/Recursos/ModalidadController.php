<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    /**
     * Devuelve datos de la modalidad
     * @return [type] [description]
     */
    public function modalidad(Request $request)
    {
        $idmodalidad = $request->varsearch ?:'1';

        $modalidad = Modalidad::find($idmodalidad);
        return $modalidad;
    }
}
