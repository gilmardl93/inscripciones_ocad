<?php
namespace App\Http\ViewComposers;

use App\Models\Modalidad;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class ModalidadSelectData
{
	public function compose(View $view)
	{
		$modalidad = Modalidad::Activo()->orderBy('id')->pluck('nombre','id')->toarray();
		$segunda_modalidad_cepre = Modalidad::where('modalidad2','ID-CEPRE')->Activo()->orderBy('id')->pluck('nombre','id')->toarray();
		$view->with(compact('modalidad','segunda_modalidad_cepre'));
	}
}