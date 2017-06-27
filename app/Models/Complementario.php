<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complementario extends Model
{
    protected $table = 'complementario';
    protected $guarded = [];
    public $timestamps = false;

    /**
    * Atributos Razon
    */
    public function getRazonAttribute()
    {
    	if(isset($this->idrazon))$razon = Catalogo::find($this->idrazon);
    	else $razon = new Catalogo(['nombre'=>'---']);
    	return $razon->nombre;
    }
    /**
    * Atributos Tipo de preparacion
    */
    public function getTipoPreparacionAttribute()
    {
    	$tipo = Catalogo::find($this->idtipopreparacion);
    	return $tipo->nombre;
    }
    /**
    * Atributos Renuncia
    */
    public function getRenuncioAttribute()
    {
    	if(isset($this->idrenuncia))$renuncia = Especialidad::find($this->keyfor);
    	else $renuncia = new Especialidad(['nombre'=>'--']);
    	return $renuncia->nombre;
    }
    /**
    * Atributos Ingreso Economico
    */
    public function getIngresoEconomicoAttribute()
    {
    	$ingreso = Catalogo::find($this->idingresoeconomico);
    	return $ingreso->nombre;
    }
    /**
    * Atributos Publicidad
    */
    public function getPublicidadAttribute()
    {
    	$publicidad = Catalogo::find($this->idpublicidad);
    	return $publicidad->nombre;
    }
    /**
    * Atributos Academia
    */
    public function getAcademiaAttribute()
    {
    	$academia = Catalogo::find($this->idacademia);
    	return $academia->nombre;
    }
}
