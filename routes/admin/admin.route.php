<?php

Route::resource('users', 'UsersController',['names'=>'admin.users']);

/**
 * Postulantes
 */
Route::group(['namespace'=>'Postulantes'], function() {
	Route::post('buscar-postulantes','PostulantesController@buscar')->name('admin.pos.buscar');
	Route::post('postulante','PostulantesController@store')->name('admin.pos.store');
	Route::get('postulantes','PostulantesController@index')->name('admin.pos.index');
	Route::get('postulantes/{id}','PostulantesController@show')->name('admin.pos.show');
	Route::get('postulantes-ficha/{id}','PostulantesController@ficha')->name('admin.pos.ficha');
	Route::get('postulantes-pago/{id}','PostulantesController@pago')->name('admin.pos.pago');
	Route::get('postulantes-lista','PostulantesController@lista')->name('admin.pos.list');

});
/**
 * Pagos
 */
Route::group(['namespace'=>'Pagos'], function() {
	Route::resource('pagos','PagosController',['names'=>'admin.pagos','only'=>['index','store']]);
	Route::get('cartera','PagosController@create')->name('admin.cartera.create');
	Route::get('download','PagosController@descarga')->name('admin.cartera.download');
	Route::get('pagos-lista','PagosController@lista')->name('admin.pagos.list');
	Route::post('pago-create','PagosController@pagocreate')->name('admin.pagos.create');
	Route::get('recaudacion','PagosController@show')->name('admin.recaudacion');

});
/**
 * Fotos
 */
Route::group(['namespace'=>'Fotos'], function() {
	Route::resource('fotos','FotosController',['names'=>'admin.fotos','only'=>['index','store','update']]);
	Route::get('update/{postulante}/{estado}','FotosController@update')->name('admin.fotos.update');
	Route::get('cargar-editado','FotosController@cargareditado')->name('admin.fotos.cargar');

});

/**
 * Aulas
 */
Route::resource('aulas', 'Aulas\AulasController',['names'=>'admin.aulas']);
Route::get('lista-aulas', 'Aulas\AulasController@lista_aulas')->name('admin.lista.aulas');
Route::get('lista-aulas-activas', 'Aulas\AulasController@lista_aulas_activas')->name('admin.lista.aulas.activas');
Route::get('activar-aula/{aula}', 'Aulas\AulasController@activar')->name('admin.activar.aula');
Route::post('activar-aulas', 'Aulas\AulasController@activaraulas')->name('admin.activar.aulas');
Route::post('habilitar-aulas', 'Aulas\AulasController@habilitaraulas')->name('admin.habilitar.aulas');
Route::post('desactivar-aulas', 'Aulas\AulasController@desactivaraulas')->name('admin.desactivar.aulas');
Route::get('delete-aulas/{aulas}', 'Aulas\AulasController@delete')->name('admin.delete.aulas');
Route::get('aulas-activas', 'Aulas\AulasController@activas')->name('admin.activas.aulas');
Route::get('ordenar-aulas', 'Aulas\AulasController@ordenar')->name('admin.ordenar.aulas');
Route::post('disponible-aulas', 'Aulas\AulasController@disponible')->name('admin.disponible.aulas');

/**
 * Secuencia
 */
Route::group(['namespace'=>'Configuracion'], function() {
	Route::resource('secuencia','SecuenciaController',['names'=>'admin.secuencia','only'=>['index','store','edit','update']]);
	Route::get('secuencia-delete/{secuencia}','SecuenciaController@delete')->name('admin.secuencia.delete');
});
/**
 * Evaluacion
 */
Route::group(['namespace'=>'Evaluacion'], function() {
	Route::resource('evaluacion','EvaluacionController',['names'=>'admin.evaluacion','only'=>['index','edit','update']]);
});
/**
 * Mensajes
 */
Route::group(['namespace'=>'Mensajes'], function() {
	Route::resource('mensajes','MensajesController',['names'=>'admin.mensajes','only'=>['index','show','update']]);
	Route::get('mensajes-atendidos','MensajesController@atendidos')->name('admin.mensajes.atendidos');
});

/**
 * Padron
 */
Route::group(['namespace'=>'Padron'], function() {
	Route::get('padron','PadronController@index')->name('admin.padron.index');
});

/**
 * Estadisticas
 */
Route::group(['namespace'=>'Estadisticas'], function() {
	Route::get('estadisticas','EstadisticasController@index')->name('admin.estadisticas.index');
});