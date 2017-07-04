<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'Semibecas.solicitantes';
    protected $guarded = [];

   /**
   * Devuelve los valores Activos
   * @param  [type]  [description]
   * @return [type]            [description]
   */
   public function scopeActivo($cadenaSQL){
   	return $cadenaSQL->where('activo',1);
   }
}
