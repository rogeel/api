<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::resource('registration', 'RegistrationController', ['only' => ['store']]);
Route::resource('authentication', 'AuthenticateController', ['only' => ['store']]);
Route::resource('posiciones', 'PosicionesController', ['only' => ['index']]);
Route::resource('zonas', 'ZonasController', ['only' => ['index']]);
Route::resource('ciudades', 'CiudadesController', ['only' => ['index']]);
Route::group([
    'middleware' => [
      //'jwt.refresh',
      'jwt.auth'
      //'permissions'
    ]], function(){

    Route::resource('jugadores', 'JugadorController', ['only' => ['show','update','index']]);
    Route::resource('equipos', 'EquiposController');
    Route::resource('canchas', 'CanchasController', ['only' => ['show','index']]);
    Route::resource('retos', 'RetosController', ['only' => ['show','index','store']]);
    Route::post('canchas/buscar','CanchasController@buscar');
    Route::post('jugadores/buscar','JugadorController@buscar');
    Route::post('equipos/buscar','EquiposController@buscar');
    Route::resource('equipos/{id}/jugadoresEquipos', 'JugadoresEquiposController', ['only' => ['update','destroy','store']]);
    Route::resource('alertas', 'AlertasController', ['only' => ['show','update','index']]);
   
    

  });

