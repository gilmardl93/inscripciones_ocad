<?php
Route::group(['middleware'=>'auth','namespace'=>'Reglamento'], function() {

	Route::get('reglamento','ReglamentoController@index')->name('reglamento.index');
	Route::get('download-documents/{doc}','ReglamentoController@documento')->name('document.download');

});

