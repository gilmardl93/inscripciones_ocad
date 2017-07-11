<?php
namespace App\Http\ViewComposers;

use App\Models\Especialidad;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class EspecialidadSelectData
{
	public function compose(View $view)
	{
		$especialidad = Especialidad::Activo()->orderBy('nombre')->pluck('nombre','id')->toarray();
		$especialidad_edit = ['' => 'Seleccionar Especialidad']+Especialidad::Activo()->orderBy('nombre')->pluck('nombre','id')->toarray();
		$view->with(compact('especialidad','especialidad_edit'));
	}
}