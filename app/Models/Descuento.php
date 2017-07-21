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
        if(isset($this->idservicio)){
            $servicio = Servicio::find($this->idservicio);
            return $servicio->codigo;
        }else return '--';
    }
    /**
    * Atributos Servicio
    */
    public function getDatosServicioAttribute()
    {
        if(isset($this->idservicio)){
            $servicio = Servicio::find($this->idservicio);
        }else {
            $servicio = new Servicio(['codigo'=>'--','descripcion'=>'--','partida'=>'--','banco'=>'--','monto'=>0]);
        }

    	return $servicio;
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
