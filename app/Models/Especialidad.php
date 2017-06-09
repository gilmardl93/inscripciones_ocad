<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    protected $fillable = ['idfacultad','codigo','nombre','canal','activo'];
    public $timestamps = false;

    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivo($cadenaSQL){
    	return $cadenaSQL->where('activo',1);
    }


}
