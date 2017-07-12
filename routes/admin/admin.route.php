<?php

Route::resource('users', 'UsersController',['names'=>'admin.users']);
/**
 * Control de usuarios
 */
Route::group(['namespace'=>'Usuarios'], function() {
	Route::get('usuarios','UsuariosController@index')->name('admin.usuarios.index');
	Route::get('editar-usuarios/{id}','UsuariosController@editar')->name('admin.usuarios.editar');
	Route::post('buscar-usuarios','UsuariosController@search')->name('admin.usuarios.search');
	Route::put('actualizar-usuarios/{id}','UsuariosController@update')->name('admin.usuarios.actualizar');
});

/**
 * Postulantes
 */
Route::group(['namespace'=>'Postulantes'], function() {
	Route::post('buscar-postulantes','PostulantesController@buscar')->name('admin.pos.buscar');
	Route::post('postulante','PostulantesController@store')->name('admin.pos.store');
	Route::get('postulantes','PostulantesController@index')->name('admin.pos.index');
	Route::get('postulantes/{id}','PostulantesController@show')->name('admin.pos.show');
	Route::put('postulantes/{id}','PostulantesController@update')->name('admin.pos.update');
	Route::get('postulantes-ficha/{id}','PostulantesController@ficha')->name('admin.pos.ficha');
	Route::get('postulantes-pago/{id}','PostulantesController@pago')->name('admin.pos.pago');
	Route::get('postulantes-lista','PostulantesController@lista')->name('admin.pos.list');

});
/**
 * Ingresantes
 */
Route::group(['namespace'=>'Ingresantes'], function() {
	Route::resource('ingresantes', 'IngresantesController',['names'=>'admin.ingresantes','only'=>['index','show','update']]);
	Route::post('ingresantes-search', 'IngresantesController@search')->name('admin.ingresantes.search');
	Route::get('datos-pdf/{id?}','IngresantesController@pdfdatos')->name('admin.ingresantes.pdfdatos');
	Route::get('constancia-pdf/{id?}','IngresantesController@pdfconstancia')->name('admin.ingresantes.pdfconstancia');
	Route::get('constancias','IngresantesController@pdfconstancias')->name('admin.ingresantes.constancias');
	#Control de entreda
	Route::resource('control', 'ControlConstanciasController',['names'=>'admin.ingresantes.control','only'=>['index','store']]);
	#Etiquetas para folders
	Route::get('ingresantes-etiquetas','EtiquetasController@index')->name('admin.ingresantes.etiquetas');
	Route::get('ingresantes-etiquetas-pdf','EtiquetasController@pdf')->name('admin.ingresantes.etiquetas.pdf');
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
	Route::post('pago-cambiar','PagosController@pagochange')->name('admin.pagos.change');
	Route::get('recaudacion','PagosController@show')->name('admin.recaudacion');
	#Servicios
	Route::resource('servicios','ServiciosController',['names'=>'admin.servicios','only'=>['index','store','edit','update']]);
	Route::get('activar-servicios/{id}','ServiciosController@activate')->name('admin.servicios.activate');
});
/**
 * Ventanilla
 */
Route::group(['namespace'=>'Ventanilla'], function() {
	Route::resource('ventanilla','VentanillaController',['names'=>'admin.ventanilla','only'=>['index','store']]);
	Route::get('obten-pagos-ventanilla','VentanillaController@obtener')->name('admin.ventanilla.obtener');

});
/**
 * Fotos
 */
Route::group(['namespace'=>'Fotos'], function() {
	Route::resource('fotos','FotosController',['names'=>'admin.fotos','only'=>['index','store','update']]);
	Route::get('update/{postulante}/{estado}','FotosController@update')->name('admin.fotos.update');
	Route::get('cargar-editado','FotosController@cargareditado')->name('admin.fotos.cargar');
	Route::post('buscar-foto','FotosController@buscar')->name('admin.fotos.buscar');
	Route::get('fotos-rechazadas','FotosController@fotosrechazadas')->name('admin.fotos.rechazadas');

});

/**
 * Aulas
 */
Route::resource('aulas', 'Aulas\AulasController',['names'=>'admin.aulas']);
Route::get('editar-aulas-activas/{id}/edit','Aulas\AulasController@editaraulaactiva')->name('admin.aulas.activas.editar');
Route::put('actualizar-aulas-activas/{id}','Aulas\AulasController@actualizaraulaactiva')->name('admin.aulas.activas.actualizar');

Route::get('lista-aulas', 'Aulas\AulasController@lista_aulas')->name('admin.lista.aulas');
Route::get('lista-aulas-activas', 'Aulas\AulasController@lista_aulas_activas')->name('admin.lista.aulas.activas');
Route::get('lista-aulas-habilitadas', 'Aulas\AulasController@lista_aulas_habilitadas')->name('admin.lista.aulas.habilitadas');

Route::get('activar-aula/{aula}', 'Aulas\AulasController@activar')->name('admin.activar.aula');
Route::get('habilitar-aula/{aula}', 'Aulas\AulasController@habilitar')->name('admin.habilitar.aula');
Route::post('activar-aulas', 'Aulas\AulasController@activaraulas')->name('admin.activar.aulas');
Route::post('habilitar-aulas', 'Aulas\AulasController@habilitaraulas')->name('admin.habilitar.aulas');
Route::post('desactivar-aulas', 'Aulas\AulasController@desactivaraulas')->name('admin.desactivar.aulas');
Route::get('delete-aulas/{aulas}', 'Aulas\AulasController@delete')->name('admin.delete.aulas');
Route::get('ordenar-aulas', 'Aulas\AulasController@ordenar')->name('admin.ordenar.aulas');
Route::post('disponible-aulas', 'Aulas\AulasController@disponible')->name('admin.disponible.aulas');

Route::get('aulas-activas', 'Aulas\AulasController@activas')->name('admin.activas.aulas');
Route::get('aulas-habilitadas', 'Aulas\AulasController@habilitadas')->name('admin.activas.habilitadas');


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
/**
 * Descuentos
 */
Route::group(['namespace'=>'Descuentos'], function() {
	Route::resource('descuentos','DescuentosController',['names'=>'admin.descuentos','only'=>['index','store','edit','update']]);
	Route::get('activar-descuento/{id}','DescuentosController@activate')->name('admin.descuentos.activate');

});
/**
 * Listados
 */
Route::group(['namespace'=>'Listados'], function() {
	Route::get('listados','ListadosController@index')->name('admin.listados.index');
});
/**
 * Comunicacion
 */
Route::group(['namespace'=>'Comunicacion'], function() {
	Route::get('comunicacion','ComunicacionController@index')->name('admin.comunicacion.index');
	Route::post('comunicacion-emails','ComunicacionController@emails')->name('admin.comunicacion.emails');
	Route::post('comunicacion-sms','ComunicacionController@sms')->name('admin.comunicacion.sms');
});