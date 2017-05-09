<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Ubigeo extends Model
{
    protected $table = 'ubigeo';
    protected $fillable = ['codigo','nombre','descripcion','activo'];
    public $timestamps = false;
    protected $connection = 'recursos';
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeObtener($cadenaSQL,$name){
    	$raw1 = DB::raw("SUBSTRING(codigo,5,2)");
    	return $cadenaSQL->select('id','descripcion as text')
                         ->where($raw1,'<>','00')
                         ->where('nombre','like',"%$name%")
                         ->orderBy('descripcion');
    }

}
