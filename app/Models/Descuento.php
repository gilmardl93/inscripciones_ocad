<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $table = 'descuento';
    protected $guarded = [];
    public $timestamps = false;
    /**
    * Atributos Servicio
    */
    public function getServicioAttribute()
    {
        $servicio = Servicio::find($this->idservicio);
        return $servicio->codigo;
    }
    /**
    * Atributos Servicio
    */
    public function getDatosServicioAttribute()
    {
    	$servicio = Servicio::find($this->idservicio);
    	return $servicio;
    }
}
