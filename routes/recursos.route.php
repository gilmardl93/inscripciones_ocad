<?php
Route::group(['middleware'=>'auth','namespace'=>'Recursos'], function() {
	/**
	 * Busquedas
	 */
	Route::post('buscar','BusquedaController@buscar')->name('admin.buscar');
	/**
	 * Ubigeo
	 */
	Route::get('ubigeo','UbigeoController@ubigeo')->name('ubigeo.index');
	/**
	 * Colegios
	 */
	Route::get('colegio','ColegioController@colegio')->name('colegio.index');
	Route::resource('colegios','ColegioController',['names'=>'admin.colegios','only'=>['index','store']]);
	Route::get('admin/colegios-lista','ColegioController@lista')->name('admin.colegios.list');
	/**
	 * Universidades
	 */
	Route::get('universidad','UniversidadController@universidad')->name('universidad.index');
	Route::resource('universidades','UniversidadController',['names'=>'admin.universidades','only'=>['index','store']]);
	Route::get('admin/universidad-lista','UniversidadController@lista')->name('admin.universidad.list');
	/**
	 * Modalidad
	 */
	Route::get('modalidad','ModalidadController@modalidad')->name('modalidad.index');
	/**
	 * Pais
	 */
	Route::get('pais','UbigeoController@pais')->name('pais.index');
});

