<?php
namespace App\Http\ViewComposers;

use App\Models\Cronograma;
use App\Models\Modalidad;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class ModalidadSelectData
{
	public function compose(View $view)
	{
		$date = Carbon::now()->toDateString();
        $fecha_inicio = Cronograma::FechaInicio('INCE');
        $fecha_fin = Cronograma::FechaFin('INCE');
        if ($date>=$fecha_inicio && $date<=$fecha_fin){
			$modalidad = Modalidad::Activo()->orderBy('id')->pluck('nombre','id')->toarray();
        }else{
			$modalidad = Modalidad::where('codigo','<>','ID-CEPRE')->Activo()->orderBy('id')->pluck('nombre','id')->toarray();
        }

		$segunda_modalidad_cepre = Modalidad::where('modalidad2','ID-CEPRE')->Activo()->orderBy('id')->pluck('nombre','id')->toarray();

		$view->with(compact('modalidad','segunda_modalidad_cepre'));
	}
}