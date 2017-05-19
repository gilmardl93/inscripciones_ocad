<?php
Route::group(['middleware'=>'auth','namespace'=>'Datos'], function() {

	Route::get('datos','DatosController@index')->name('datos.index');
	Route::post('datos','DatosController@store')->name('datos.store');
	Route::put('datos/{postulante}','DatosController@update')->name('datos.update');

	Route::resource('datos-personales','DatosPersonalesController',['names'=>'datos.postulante','only'=>['index','store','update']]);
	Route::resource('datos-secundarios','DatosSecundariosController',['names'=>'datos.secundarios','only'=>['index','update']]);
	Route::resource('datos-familiar','DatosFamiliaresController',['names'=>'datos.familiares','only'=>['index','store']]);
	Route::post('datos-familiar-update','DatosFamiliaresController@update')->name('datos.familiares.update');
	Route::resource('datos-modalidad','DatosModalidadController',['names'=>'datos.modalidad','only'=>['index','store','update']]);
	Route::resource('datos-complementarios','DatosComplementariosController',['names'=>'datos.complementarios','only'=>['index','store','update']]);

	Route::get('info-modalidad','DatosModalidadController@infomodalidad')->name('datos.modalidad.info');


});


