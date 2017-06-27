<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $guarded = [];
    public $timestamps = false;
    /**
    * Atributos descripcion de servicio
    */
    public function getDescripcionRecortadaAttribute()
    {
    	return substr($this->descripcion, 0,30);
    }
    /**
    * Atributos Monto sin signo de separacion
    */
    public function getValorAttribute()
    {
        return str_replace('.','',$this->monto);
    }
    /**
    * Atributos Monto sin signo de separacion
    */
    public function getValorEnteroAttribute()
    {
        return (int)$this->monto;
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivo($cadenaSQL){
        return $cadenaSQL->where('activo',1);
    }

}
