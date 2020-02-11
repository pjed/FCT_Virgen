<?php
use App\Auxiliar\Conexion;
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
//Route::group(['middleware' => ['tutor', 'tutorAdmin']], function() {
Route::get('bienvenidaT', function () {
    return view('tutor/bienvenidaT');
});
Route::get('consultarGastosAlumno', function () {
    $datos = [
        'gc' => null,
        'gtp' => null,
        'gtc' => null,
    ];
    return view('tutor/consultarGastosAlumno', $datos);
});
Route::get('gestionarEmpresa', function () {
    return view('tutor/gestionarEmpresa');
});
Route::get('gestionarResponsable', function () {
    return view('tutor/gestionarResponsable');
});
Route::get('gestionarPracticas', function () {
    return view('tutor/gestionarPracticas');
});
Route::get('ExtraerDocT', function () {
    return view('tutor/extraerDocT');
});
Route::get('perfilTutor', function () {
    return view('tutor/perfilTutor');
});

Route::post('consultarGastosAlumno', 'controladorTutor@consultarGastoAlumno');
Route::post('extraerDocT', 'controladorTutor@extraerDocT');
Route::post('gestionarEmpresa', 'controladorTutor@gestionarEmpresa');
Route::post('gestionarResponsable', 'controladorTutor@gestionarResponsable');
Route::post('gestionarPracticas', 'controladorTutor@gestionarPracticas');
Route::post('perfilT', 'controladorTutor@perfil');
//});
//admin
//Route::group(['middleware' => ['admin','tutorAdmin']], function() {
Route::get('bienvenidaAd', function () {
    return view('admin/bienvenidaAd');
});
Route::get('extraerDocA', function () {
    return view('admin/extraerDocA');
});
Route::get('gestionarCursos', function () {
    $l = Conexion::listaCursosPagination();
    return view('admin/gestionarCursos',['l1' => $l]);
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
Route::get('perfilAdmin', function () {
    return view('perfilAdmin');
});
Route::post('perfilAd', 'controladorAdmin@perfil');

Route::post('gestionarCursos', 'controladorAdmin@gestionarCursos');

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
Route::get('crearGastoComida', function () {

    return view('alumno/crearGastoComida');
});
Route::get('crearGastoTransporte', function () {
    return view('alumno/crearGastoTransporte');
});
Route::get('gestionarGastosComida', function () {
    $n = session()->get('usu');
    foreach ($n as $u) {
        $dniAlumno = $u['dni'];
    }
    $gastosAlumno = Conexion::listarGastosComidasPagination($dniAlumno);
    return view('alumno/gestionarGastosComida', ['gastosAlumno' => $gastosAlumno]);
});
Route::get('gestionarGastosTransporte', function () {
    $n = session()->get('usu');
    foreach ($n as $u) {
        $dniAlumno = $u['dni'];
    }
    $gt = Conexion::listarGastosTransportes($dniAlumno);

    foreach ($gt as $key1) {
        $tipo = $key1->tipo;
    }
    $datos = ['tipo' => $tipo,
        'dniAlumno' => $dniAlumno];
    return view('alumno/gestionarGastosTransporte', $datos);
});
Route::get('perfilAlumno', function () {
    return view('perfilAlumno');
});
Route::post('perfilAl', 'controladorAlumno@perfil');

Route::post('crearGastoComida', 'controladorAlumno@crearGastoComida');

Route::post('crearGastoTransporte', 'controladorAlumno@crearGastoTransporte');

Route::post('gestionarGastosComida', 'controladorAlumno@gestionarGastoComida');

Route::post('gestionarGastosTransporte', 'controladorAlumno@gestionarGastoTransporte');

//});
//admin y tutor
//Route::group(['middleware' => ['tutorAdmin']], function() {
Route::get('cambiarRol', function () {
    return view('cambiarRol');
});
Route::post('cambiarRol', 'controladorGeneral@cambiarRol');
//});
