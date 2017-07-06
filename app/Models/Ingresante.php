<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ingresante extends Model
{
    protected $table = 'ingresante';
    protected $guarded = [];
    public $timestamps = false;
        /**
    * Atributos Foto Ingresante
    */
    public function getFotoAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        $fotoing = 'fotoIng/'.$postulante->numero_identificacion.'.jpg';
        if(Storage::exists('public/'.$fotoing))$foto = asset('/storage/'.$fotoing);
        else $foto = false;

        return $foto;
    }
    /**
    * Atributos Huella del Ingresante
    */
    public function getHuellaAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        $huella = 'huella/'.$postulante->numero_identificacion.'.bmp';
        if(Storage::exists('public/'.$huella))$imagen = asset('/storage/'.$huella);
        else $imagen = false;

        return $imagen;
    }
    /**
    * Atributos Huella del Ingresante
    */
    public function getFirmaAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        $firma = 'firma/'.$postulante->numero_identificacion.'.bmp';
        if(Storage::exists('public/'.$firma))$imagen = asset('/storage/'.$firma);
        else $imagen = false;

        return $imagen;
    }
}
