<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Recaudacion extends Model
{
    protected $table = 'recaudacion';
    protected $fillable = ['recibo', 'servicio', 'descripcion','monto','fecha','codigo','nombrecliente','idpostulante','banco','referencia'];

    /**
     * Atributos Banco
     */
    public function setBancoAttribute($value)
    {
        $this->attributes['banco'] = strtoupper($value);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeResumen($cadenaSQL){
        return $cadenaSQL->select('fecha',DB::raw('count(*) as cantidad'))
                         ->groupBy('fecha');
    }


    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Postulantes()
    {
        return $this->hasOne(Postulante::class,'id','idpostulante');
    }
}
