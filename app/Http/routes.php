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

Route::get('/', ['middleware' => 'auth','uses' => 'HomeController@index'])->name('home');

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Administração
Route::group(['prefix' => 'administracao', 'middleware' => 'auth'], function() {
    Route::resource('filiais', 'FiliaisController');
    Route::resource('precos', 'PrecosController');
    Route::resource('funcionarios', 'FuncionariosController');
    Route::resource('cargos', 'CargosController');
    Route::resource('vendedores', 'VendedoresController');
});

// Comercial
Route::group(['prefix' => 'comercial', 'middleware' => 'auth'], function() {
    Route::resource('clientes', 'ClientesController');
    Route::resource('fichas', 'FichasController');
});

// Operacional
Route::group(['prefix' => 'operacional', 'middleware' => 'auth'], function() {
    Route::resource('agenda', 'AgendaController');
    Route::resource('os', 'OsController');
    Route::resource('ambientes', 'AmbientesController');
    Route::get('relatorios', 'RelatoriosController@index');

    Route::get('processos', 'ProcessosController@create');
    Route::get('processos', 'ProcessosController@index');
    Route::get('processo/{os}', 'ProcessosController@principal');
    Route::get('processo/{os}/detalhe', 'ProcessosController@detalhe');
    Route::get('processo/{os}/duplicidades', 'ProcessosController@duplicidades');
    Route::get('processo/{os}/restantes', 'ProcessosController@restantes');
    Route::get('processo/{os}/auditoria', 'ProcessosController@auditoria');
    Route::get('processo/{os}/operadores', 'ProcessosController@operadores');
    Route::get('processo/{os}/divergencia', 'ProcessosController@divergencia');
    Route::get('processo/{os}/finalizar', 'ProcessosController@finalizar');
    Route::get('processo/{os}/parse', 'ProcessosController@parse');
    Route::post('processo/{os}/auditar', 'ProcessosController@auditar');
    Route::get('processo/{os}/excluir/{setor}', 'ProcessosController@destroy');
});


