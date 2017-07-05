<?php

namespace App\Http\Controllers\Admin\Comunicacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComunicacionController extends Controller
{
    public function index()
    {
    	return view('admin.comunicacion.index');
    }
}
