<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    protected $table = 'universidad';
    protected $fillable = ['codigo','nombre','idubigeo','idpais','activo'];
    public $timestamps = false;
    protected $connection = 'recursos';
    /**
    * Atributos Descripcion Ubigeo
    */
    public function getDescripcionUbigeoAttribute()
    {
        $ubigeo = Ubigeo::find($this->idubigeo);
        return $ubigeo->descripcion;
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Distrito()
    {
        return $this->hasOne(Ubigeo::class,'id','idubigeo');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Paises()
    {
        return $this->hasOne(Pais::class,'id','idpais');
    }
}
