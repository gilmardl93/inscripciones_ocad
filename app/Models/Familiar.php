<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    protected $table = 'familiar';
    protected $guarded = [];
    public $timestamps = false;

    /**
    * Atributos Nombre Completo
    */
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->paterno.'-'.$this->materno.','.$this->nombres;
        return $nombre;
    }
    /**
    * Atributos Nombre Completo
    */
    public function getApoderadoAttribute()
    {
        $nombre = $this->paterno.'-'.$this->materno.','.$this->nombres.'/'.$this->dni.'/'.$this->telefonos;
        return $nombre;
    }
    public static function Actualizar($data)
    {
    	Familiar::where('id',$data['id'][0])->update([
                'paterno'=>$data['paterno'][0],
                'materno'=>$data['materno'][0],
                'nombres'=>$data['nombres'][0],
                'dni'=>$data['dni'][0],
                'email'=>$data['email'][0],
                'direccion'=>$data['direccion'][0],
                'telefonos'=>$data['telefonos'][0]
            ]);
        Familiar::where('id',$data['id'][1])->update([
                'paterno'=>$data['paterno'][1],
                'materno'=>$data['materno'][1],
                'nombres'=>$data['nombres'][1],
                'dni'=>$data['dni'][1],
                'email'=>$data['email'][1],
                'direccion'=>$data['direccion'][1],
                'telefonos'=>$data['telefonos'][1]
            ]);
        Familiar::where('id',$data['id'][2])->update([
                'paterno'=>$data['paterno'][2],
                'materno'=>$data['materno'][2],
                'nombres'=>$data['nombres'][2],
                'dni'=>$data['dni'][2],
                'email'=>$data['email'][2],
                'direccion'=>$data['direccion'][2],
                'telefonos'=>$data['telefonos'][2]
            ]);
    }
}
