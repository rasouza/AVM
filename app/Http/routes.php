<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'administracao'], function() {
    Route::resource('filiais', 'FiliaisController');

    Route::resource('precos', 'PrecosController@index');
    Route::resource('funcionarios', 'FuncionariosController@index');
    Route::resource('cargos', 'CargosController@index');
    Route::resource('vendedores', 'VendedoresController@index');
});


