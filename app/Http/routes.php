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

Route::get('/', 'Homecontroller@index')->name('home');

Route::group(['prefix' => 'administracao'], function() {
    Route::get('filiais', 'FiliaisController@index');
    Route::get('precos', 'PrecosController@index');
    Route::get('funcionarios', 'FuncionariosController@index');
    Route::get('cargos', 'CargosController@index');
    Route::get('vendedores', 'VendedoresController@index');
});


