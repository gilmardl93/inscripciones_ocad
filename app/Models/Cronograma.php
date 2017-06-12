<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $table = 'cronograma';
    public $timestamps = false;

    /**
    * Atributos Fecha de inicio sin caracter de separacion
    */
    public function getBeginDateAttribute()
    {
        return str_replace('-', '', $this->fecha_inicio);
    }
    /**
    * Atributos Fecha de fin sin caracter de separacion
    */
    public function getEndDateAttribute()
    {
        return str_replace('-', '', $this->fecha_fin);
    }

    /**
     * Devuelve la fecha de inicio de la actividad
     * @param  string $cadenaSQL el codigo de la actividad
     * @param  strin $codigo
     * @return collection devuelve la coleccion segun el codigo ingresado
     */
    public function scopeFechaInicio($cadenaSQL,$codigo){
    	return $cadenaSQL->select('fecha_inicio')->where('codigo',$codigo)->first()->fecha_inicio;
    }
    /**
     * Devuelve la fecha final de la actividad
     * @param  string $cadenaSQL el codigo de la actividad
     * @param  strin $codigo
     * @return collection devuelve la coleccion segun el codigo ingresado
     */
    public function scopeFechaFin($cadenaSQL,$codigo){
    	return $cadenaSQL->select('fecha_fin')->where('codigo',$codigo)->first()->fecha_fin;
    }
}
