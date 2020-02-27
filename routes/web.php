<?php

use App\Auxiliar\Conexion;
use App\Http\Controllers\controladorAdmin;
use App\Http\Controllers\controladorTutor;

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
//Route::group(['middleware' => ['tutor', 'tutorAdmin']], function() {
Route::get('bienvenidaT', function () {
    return view('tutor/bienvenidaT');
});
Route::get('consultarGastosAlumno', function () {
    if (isset($_GET['page'])) {
        $datos = controladorTutor::enviarConsultarGastoAlumno();
    } else {
        $datos = [
        'l2' => Conexion::listarAlumnoPorTutor(),
        'gtc' => null,
        'gtp' => null,
        'gc' => null
        ];
    }
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
Route::get('perfilT', function () {
    return view('tutor/perfilTutor');
});
Route::post('consultarGastosAlumno', 'controladorTutor@consultarGastoAlumno');
Route::post('extraerDocT', 'controladorTutor@extraerDocT');
Route::post('gestionarEmpresa', 'controladorTutor@gestionarEmpresa');
Route::post('gestionarResponsable', 'controladorTutor@gestionarResponsable');
Route::post('gestionarPracticas', 'controladorTutor@gestionarPracticas');
Route::post('perfilT', 'controladorTutor@perfil');
Route::post('perfilT1', 'controladorGeneral@perfilT'); //redirige al perfil
//});
//admin
//Route::group(['middleware' => ['admin','tutorAdmin']], function() {
Route::get('bienvenidaAd', function () {
    return view('admin/bienvenidaAd');
});
Route::get('extraerDocA', function () {
    $l1 = Conexion::listaCursos();
    $datos = [
        'l1' => $l1
    ];
    return view('admin/extraerDocA', $datos);
});
Route::get('consultarGastos', function () {
    if (isset($_GET['page'])) {
        $datos = controladorAdmin::paginacionConsultarGastoAlumno();
    } else {
        $l1 = Conexion::listaCursos();
        $datos = [
            'l1' => $l1,
            'l2' => null,
            'gc' => null,
            'gtp' => null,
            'gtc' => null,
        ];
    }
    return view('admin/consultarGastos', $datos);
});
Route::get('gestionarCursos', function () {
    $l = Conexion::listaCursosPagination();
    return view('admin/gestionarCursos', ['l1' => $l]);
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
Route::get('perfilAd', function () {
    return view('admin/perfilAdmin');
});
Route::post('perfilAd', 'controladorAdmin@perfil');
Route::post('perfilAd1', 'controladorGeneral@perfilAd'); //redirige al perfil
Route::post('consultarGastos', 'controladorAdmin@consultarGastoAlumno');

//ajax
Route::get('consultarGastosAjax', function () {
    return view('admin/consultarGastosAjax');
});
Route::get('consultarGastosAjaxCiclo', ['uses' => 'Conexion@listaCursosAjax', 'as' => 'consultarGastosAjaxCiclo']);
Route::get('consultarGastosAjaxDniAlumno', ['uses' => 'Conexion@listarAlumnosCursoAjax', 'as' => 'consultarGastosAjaxDniAlumno']);
Route::post('consultarGastosAjaxCiclo', ['uses' => 'Conexion@listaCursosAjax', 'as' => 'consultarGastosAjaxCiclo']);
Route::post('consultarGastosAjaxDniAlumno', ['uses' => 'Conexion@listarAlumnosCursoAjax', 'as' => 'consultarGastosAjaxDniAlumno']);
Route::post('consultarGastosAyax', 'Conexion@listarAlumnoPorTutor');

Route::post('gestionarCursos', 'controladorAdmin@gestionarCursos');
Route::post('gestionarTablaUsuarios', 'controladorAdmin@gestionarUsuarios');
Route::post('gestionarTablaAlumnos', 'controladorAdmin@gestionarAlumnos');
Route::post('gestionarTablaTutores', 'controladorAdmin@gestionarTutores');
Route::post('exportarDocumentos', 'controladorAdmin@exportarDocumentos');
Route::post('aniadirUsuario', 'controladorAdmin@aniadirUsuario');
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
Route::get('perfilAl', function () {
    return view('alumno/perfilAlumno');
});
Route::post('perfilAl1', 'controladorGeneral@perfilAl'); //redirige al perfil
Route::post('perfilAl', 'controladorAlumno@perfil');
Route::post('actualizarFoto', 'controladorGeneral@actualizarFoto');
Route::post('crearGastoComida', 'controladorAlumno@crearGastoComida');
Route::post('crearGastoTransporte', 'controladorAlumno@crearGastoTransporte');
Route::post('gestionarGastosComida', 'controladorAlumno@gestionarGastoComida');
Route::post('gestionarGastosTransporte', 'controladorAlumno@gestionarGastoTransporte');

//});
//tutor-admin
//Route::group(['middleware' => ['tutorAdmin']], function() {
Route::post('cambiarRol', 'controladorGeneral@cambiarRol');
//});

