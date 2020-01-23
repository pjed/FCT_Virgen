<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicioSesion');
});

//comunes
Route::post('inicioSesion', 'controladorGeneral@inicioSesion');
Route::post('cerrarSesion', 'controladorGeneral@cerrarSesion');
//Route::group(['middleware' => ['general']], function() {
    Route::get('inicioSesion', 'controladorGeneral@inicioSesion');
    Route::get('cerrarSesion', 'controladorGeneral@cerrarSesion');
//});

//tutor
//Route::group(['middleware' => ['tutor']], function() {
    
//});

//admin
//Route::group(['middleware' => ['admin']], function() {
    
//});

//alumno
//Route::group(['middleware' => ['alumno']], function() {
  
//});