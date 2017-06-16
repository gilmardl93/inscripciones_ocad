<?php

namespace App\Http\Middleware;

use App\Models\Postulante;
use Closure;
use Alert;
class DatoOkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $datos = Postulante::Usuario()->Activos()->first()->datos_ok;
        if($datos){
            Alert::info('Usted ya no puede modificar sus datos');
            return redirect()->route('home.index');
        }
        return $next($request);
    }
}
