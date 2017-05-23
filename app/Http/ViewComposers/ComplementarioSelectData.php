<?php
namespace App\Http\ViewComposers;

use App\Models\Catalogo;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class ComplementarioSelectData
{
	public function compose(View $view)
	{
		$razon = Catalogo::Combo('RAZON')->pluck('descripcion','id')->toarray();
		$preparacion = Catalogo::Combo('TIPO PREPARACION')->pluck('descripcion','id')->toarray();
		$academia = Catalogo::Combo('ACADEMIA')->pluck('nombre','id')->toarray();
		$ingreso = Catalogo::Combo('INGRESO')->pluck('descripcion','id')->toarray();
		$publicidad = Catalogo::Combo('INFORMES')->pluck('descripcion','id')->toarray();
		for ($i=0; $i <= 10; $i++) {
			$veces[$i] = $i;
		}

		$view->with(compact('razon','preparacion','academia','ingreso','publicidad','veces'));
	}
}