<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $guarded = [];
    public $timestamps = false;
    /**
     * Atributos sector
     */
    public function setSectorAttribute($value)
    {
        $this->attributes['sector'] = strtoupper($value);
    }
    /**
     * Atributos codigo
     */
    public function setCodigoAttribute($value)
    {
        $this->attributes['codigo'] = strtoupper($value);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivas($cadenaSQL,$estado = true){
    	return $cadenaSQL->where('activo',$estado);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeObtenerAula($cadenaSQL,$dia,$especial = false){
        if ($dia=='voca' && !$especial) {
            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('disponible_voca','>',0)
                            ->inRandomOrder();
        }elseif ($especial) {
            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('especial',true)
                            ->where('disponible_0'.$dia,'>',0)
                            ->inRandomOrder();
        }else {
            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('especial',false)
                            ->where('disponible_0'.$dia,'>',0)
                            ->inRandomOrder();
        }

    }
}
