<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secuencia extends Model
{
    protected $table = 'secuencia';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
