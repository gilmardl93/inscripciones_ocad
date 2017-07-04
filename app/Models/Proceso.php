<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
	protected $table = 'proceso';
	protected $guarded = ['idpostulante', 'preinscripcion', 'datos_personales','datos_familiares','encuesta'];
	public $timestamps = false;

	/**
	* Atributos Datos Personales
	*/
	public function getPersonalAttribute()
	{
		if($this->datos_personales)return '<span class="label label-sm label-info"> SI </span>';
		else return '<span class="label label-sm label-danger"> NO </span>';
	}
	/**
	* Atributos Datos Familiares
	*/
	public function getFamiliarAttribute()
	{
		if($this->datos_familiares)return '<span class="label label-sm label-info"> SI </span>';
		else return '<span class="label label-sm label-danger"> NO </span>';
	}
	/**
	* Atributos Datos Encuesta
	*/
	public function getDatosEncuestaAttribute()
	{
		if($this->encuesta)return '<span class="label label-sm label-info"> SI </span>';
		else return '<span class="label label-sm label-danger"> NO </span>';
	}
}
