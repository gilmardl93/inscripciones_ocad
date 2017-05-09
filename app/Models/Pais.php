<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
    protected $fillable = ['codigo','nombre','activo'];
    public $timestamps = false;
    protected $connection = 'recursos';
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivo($cadenaSQL){
    	return $cadenaSQL->where('activo',1);
    }
}
