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
//Route::group(['middleware' => ['general']], function() {
Route::post('inicioSesion', 'controladorGeneral@inicioSesion');
Route::post('cerrarSesion', 'controladorGeneral@cerrarSesion');
Route::post('olvidarPwd', 'controladorGeneral@olvidarPwd');
Route::get('inicioSesion', function () {
    return view('inicioSesion');
});
Route::get('cerrarSesion', function () {
    return view('518'); //Error 404 NOT FOUND
});
Route::get('olvidarPwd', function () {
    return view('olvidarPwd');
});

//});

//tutor
//Route::group(['middleware' => ['tutor']], function() {
Route::get('bienvenidaT', function () {
    return view('bienvenidaT');
});
Route::get('consultarAlumno', function () {
    return view('consultarGastosAlumno');
});
Route::get('consultarCurso', function () {
    return view('consultarGastosCurso');
});
Route::get('ModificarDoc', function () {
    return view('modificarDoc');
});
Route::get('ExtraerDocT', function () {
    return view('extraerDocT');
});
Route::get('importarAlumnos', function () {
    return view('importarAlumnos');
});
//});

//admin
//Route::group(['middleware' => ['admin']], function() {
    Route::get('bienvenidaAd', function () {
    return view('bienvenidaAd');
});
Route::get('extraerDocA', function () {
    return view('extraerDocA');
});
Route::get('gestionarUsuarios', function () {
    return view('gestionarUsuarios');
});
Route::get('gestionarAlumnos', function () {
    return view('gestionarAlumnos');
});
Route::get('gestionarUsuarios', function () {
    return view('gestionarUsuarios');
});
Route::get('gestionarTutores', function () {
    return view('gestionarTutores');
});
Route::get('importarTutores', function () {
    return view('importarTutores');
});

//});

//alumno
//Route::group(['middleware' => ['alumno']], function() {
  Route::get('bienvenidaAl', function () {
    return view('bienvenidaAl');
});
Route::get('crearGasto', function () {
    return view('crearGasto');
});
Route::get('gestionarGastos', function () {
    return view('gestionarGastos');
});

Route::post('crearGasto', 'controladorAlumno@crearGasto');

Route::post('gestionarGastos', 'controladorAlumno@gestionarGasto');

//});


//admin y tutor
//Route::group(['middleware' => ['admin','tutor']], function() {
Route::get('cambiarRol', function () {
    return view('cambiarRol');
});
//});
