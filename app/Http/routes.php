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

Route::get('/', function () {
    return view('auth/login');
});

// Route::resource('menu/incidente','IncidenteController');
Route::resource('menu/sucursal','SucursalController');
Route::resource('menu/usuario','UsuarioController');
Route::resource('menu/recaudacion','TotalController');
Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('reportotales/{id}', 'TotalController@reportec');
Route::get('reportes', 'TotalController@vistatotales');
Route::get('reportelocal/{nego}/{fecha}', 'TotalController@reportlo');
