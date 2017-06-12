<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    protected $table = 'validacion';
    public $timestamps = false;
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivos($cadenaSQL){
        $evaluacion = Evaluacion::Activo()->first();
        return $cadenaSQL->where('idevaluacion',$evaluacion->id);
    }
}
