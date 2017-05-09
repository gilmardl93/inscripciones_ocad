<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    protected $table = 'universidad';
    protected $fillable = ['codigo','nombre','idubigeo','idpais','activo'];
    public $timestamps = false;
    protected $connection = 'recursos';
}
