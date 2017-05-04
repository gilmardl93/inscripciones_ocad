<?php
Route::group(['middleware'=>'auth','namespace'=>'Datos'], function() {

	Route::get('datos','DatosController@index')->name('datos.index');
	Route::post('datos','DatosController@store')->name('datos.store');
	Route::put('datos/{postulante}','DatosController@update')->name('datos.update');

	Route::resource('datos-personales','DatosPersonalesController',['names'=>'datos.potulante','only'=>['index','store','update']]);

});


