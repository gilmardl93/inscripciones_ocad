<?php
namespace App\Http\ViewComposers;

use App\Models\Catalogo;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class SexoSelectData
{
	public function compose(View $view)
	{
		$sexo = Catalogo::Combo('SEXO')->pluck('nombre','id')->toarray();
		$view->with(compact('sexo'));
	}
}