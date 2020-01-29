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
//Route::get('/', 'controladorGeneral@comprobarExisteBD');
//comunes
//Route::group(['middleware' => ['general']], function() {
Route::post('inicioSesion', 'controladorGeneral@inicioSesion');
Route::post('cerrarSesion', 'controladorGeneral@cerrarSesion');
Route::post('olvidarPwd', 'controladorGeneral@olvidarPwd');
Route::post('perfil', 'controladorGeneral@perfil');
Route::get('inicioSesion', function () {
    return view('inicioSesion');
});
Route::get('perfil', function () {
    return view('perfil');
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
    return view('tutor/bienvenidaT');
});
Route::get('consultarAlumno', function () {
    return view('tutor/consultarGastosAlumno');
});
Route::get('consultarCurso', function () {
    return view('tutor/consultarGastosCurso');
});
Route::get('ModificarDoc', function () {
    return view('tutor/modificarDoc');
});
Route::get('ExtraerDocT', function () {
    return view('tutor/extraerDocT');
});
Route::get('importarAlumnos', function () {
    return view('tutor/importarAlumnos');
});
//});
//admin
//Route::group(['middleware' => ['admin']], function() {
Route::get('bienvenidaAd', function () {
    return view('admin/bienvenidaAd');
});
Route::get('extraerDocA', function () {
    return view('admin/extraerDocA');
});
Route::get('gestionarUsuarios', function () {
    return view('admin/gestionarUsuarios');
});
Route::get('gestionarAlumnos', function () {
    return view('admin/gestionarAlumnos');
});
Route::get('gestionarUsuarios', function () {
    return view('admin/gestionarUsuarios');
});
Route::get('gestionarTutores', function () {
    return view('admin/gestionarTutores');
});
Route::get('importarTutores', function () {
    return view('admin/importarTutores');
});

Route::post('gestionarTablaUsuarios', 'controladorAdmin@gestionarUsuarios');

Route::post('gestionarTablaAlumnos', 'controladorAdmin@gestionarAlumnos');

Route::post('gestionarTablaTutores', 'controladorAdmin@gestionarTutores');

Route::post('exportarDocumentos', 'controladorAdmin@exportarDocumentos');
//});
//alumno
//Route::group(['middleware' => ['alumno']], function() {
Route::get('bienvenidaAl', function () {
    return view('alumno/bienvenidaAl');
});
Route::get('crearGasto', function () {
    return view('alumno/crearGasto');
});
Route::get('gestionarGastos', function () {
    return view('alumno/gestionarGastos');
});

Route::post('crearGasto', 'controladorAlumno@crearGasto');

Route::post('gestionarGastos', 'controladorAlumno@gestionarGasto');

//});
//admin y tutor
//Route::group(['middleware' => ['admin','tutor']], function() {
Route::get('cambiarRol', function () {
    return view('cambiarRol');
});
Route::post('cambiarRol', 'controladorGeneral@cambiarRol');
//});
