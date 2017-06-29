<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventanilla extends Model
{
    protected $table = 'ventas_admision';
    protected $guarded = [];
    protected $connection = 'ventas';
}
