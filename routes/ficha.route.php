<?php
Route::group(['middleware'=>'auth','namespace'=>'Ficha'], function() {

	Route::get('ficha/{id?}','FichaController@index')->name('ficha.index');
	Route::get('ficha-pdf/{id?}','FichaController@pdf')->name('ficha.pdf');
	Route::post('confirmar-datos','FichaController@confirmar')->name('ficha.confirmar');

});

