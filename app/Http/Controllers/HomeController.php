<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use App\Models\Recaudacion;
use Auth;
use DB;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->role->nombre) {
            case 'root':
                $resumen = Postulante::Resumen()->orderBy('fecha_registro')->get();
                $pagantes = Recaudacion::Resumen()->orderBy('fecha')->get();
                return view('admin.index',compact('resumen','pagantes'));
                break;
            case 'Alumno':
                return view('index');
                break;

            default:
                return view('admin.index',compact('resumen','pagantes'));
                break;
        }
    }
}
