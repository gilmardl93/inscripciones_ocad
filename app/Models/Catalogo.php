<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogo';
    protected $fillable = ['idtable', 'iditem', 'codigo','nombre','descripcion','valor','activo'];
    // public $timestamps = false;
    #####################################################################
	public function Maestro($NameTable){
		$data=$this->select('iditem')
				   ->where('idtable',0)
			       ->where('nombre',"$NameTable")->first();
		return $data->iditem;
	}
	#--------------------------------------------------------------------
	public function scopeCombo($cadenaSQL,$NameTable){
		$idtable=$this->Maestro($NameTable);
		return $cadenaSQL->where('idtable',$idtable)
						 ->where('activo',1);
	}
	#--------------------------------------------------------------------
	public function scopeIdCatalogo($cadenaSQL,$NameTable,$NameSubTable){
		$idtable=$this->Maestro($NameTable);
		return $cadenaSQL->where('idtable',$idtable)
						 ->where('nombre',$NameSubTable)
						 ->where('activo',1)->lists('id')[0];
	}
	#--------------------------------------------------------------------
	public function scopeIdCatalogoCodigo($cadenaSQL,$NameTable,$codigo){
		$idtable=$this->Maestro($NameTable);
		return $cadenaSQL->where('idtable',$idtable)
						 ->where('codigo',$codigo)
						 ->where('activo',1)->pluck('id')[0];
	}
	 #--------------------------------------------------------------------
    public function scopeTable($cadenaSQL,$NameTable){
        $NameTable = strtoupper($NameTable);
        $idtable=$this->Maestro($NameTable);
        return $cadenaSQL->where('idtable',$idtable)
                         ->orderBy('iditem','asc');
    }
    #--------------------------------------------------------------------
    public function scopeIdtable($cadenaSQL,$NameTable){
        $NameTable = strtoupper($NameTable);
        return $cadenaSQL->select('iditem')
                         ->where('idtable',0)
                         ->where('nombre',"$NameTable")
                         ->where('activo',1)
                         ->first();
    }
    #--------------------------------------------------------------------
	public function scopeidroot($cadenaSQL){
		return $cadenaSQL->select('id')->where('codigo','root')->where('nombre','root')->get()[0];
	}
}
