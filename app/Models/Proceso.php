<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
	protected $table = 'proceso';
	protected $guarded = ['idpostulante', 'preinscripcion', 'datos_personales','datos_familiares','encuesta'];
	public $timestamps = false;
}
