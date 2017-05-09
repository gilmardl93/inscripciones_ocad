<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    protected $table = 'colegio';
    protected $fillable = ['codigo_modular', 'anexo', 'nombre','nivel','forma','area','gestion','direccion','director','email','telefonos','idubigeo','idpais','activo'];
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
    public function getGestionOptions()
    {
        return ['Privada', 'Pública'];
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
