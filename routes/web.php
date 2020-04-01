<?php

use App\Auxiliar\Conexion;
use App\Http\Controllers\controladorAdmin;
use App\Http\Controllers\controladorTutor;
use App\Http\Controllers\controladorAlumno;

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

Route::post('inicioSesion', 'controladorGeneral@inicioSesion');
Route::get('inicioSesion', function () {
    return view('inicioSesion');
});
Route::post('VolverIndex', 'controladorGeneral@VolverIndex');
Route::get('VolverIndex', function () {
    return view(404); //Error 404 NOT FOUND
});

Route::get('olvidarPwd', function () {
    return view('olvidarPwd');
});
Route::post('olvidarPwd', 'controladorGeneral@olvidarPwd');

//comunes
Route::group(['middleware' => ['general']], function() {
    Route::post('cerrarSesion', 'controladorGeneral@cerrarSesion');

    Route::get('cerrarSesion', function () {
        return view('518'); //Error 404 NOT FOUND
    });

    Route::post('actualizarFoto', 'controladorGeneral@actualizarFoto');
});


//tutor
Route::group(['middleware' => ['tutor']], function() {
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
        $datos = controladorTutor::datosGestionarPracticas();
        return view('tutor/gestionarPracticas', $datos);
    });
    Route::get('ExtraerDocT', function () {
        return view('tutor/extraerDocT');
    });
    Route::get('perfilT', function () {
        return view('tutor/perfilTutor');
    });
    //ayax
    Route::get('gestionarPracticasAyax', function () {
        return view('tutor/gestionarPracticasAyax');
    });
    Route::post('gestionarPracticasAyax', 'controladorTutor@gestionarPracticasAyax');
    Route::any('listarResponsablesAyax', 'controladorTutor@listarResponsablesAyax'); //ayax para poder responsables de una empresa
    //ayax para poder mostrar la modal para modificar practicas
    Route::any('modalModificarPracticaAyax', 'controladorTutor@modalModificarPracticaAyax'); 


    Route::post('consultarGastosAlumno', 'controladorTutor@consultarGastoAlumno');
    Route::post('extraerDocT', 'controladorTutor@extraerDocT');
    Route::post('gestionarEmpresa', 'controladorTutor@gestionarEmpresa');
    Route::post('gestionarResponsable', 'controladorTutor@gestionarResponsable');
    Route::post('gestionarPracticas', 'controladorTutor@gestionarPracticas');
    Route::post('perfilT', 'controladorTutor@perfil');
    Route::post('perfilT1', 'controladorGeneral@perfilT'); //redirige al perfil
});


//admin
Route::group(['middleware' => ['admin']], function() {
    Route::get('bienvenidaAd', function () {
        return view('admin/bienvenidaAd');
    });
    Route::get('importarDatos', function () {
        return view('admin/importarDatos');
    });
    Route::post('DeleteDB', 'ControladorAdmin@DeleteDB');
    Route::get('dropzone', 'DropzoneController@index')->name('dropzone.store');
    Route::post('dropzone-image-upload', 'DropzoneController@store');
    Route::post('dropzone-image-delete', 'DropzoneController@destroy');
//    Route::get('dropzone', 'DropzoneController@dropzone');
//    Route::post('dropzone/store', 'DropzoneController@dropzoneStore')->name('dropzone.store');
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
        $listaUsuarios = Conexion::listarUsuarios();
        $listaCiclos = Conexion::listarCiclos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'listaUsuarios' => $listaUsuarios,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];

        return view('admin/gestionarUsuarios', $datos);
    })->name('gestionarUsuarios');
    Route::get('gestionarAlumnos', function () {
        $listaAlumnos = Conexion::listarAlumnos();
        $listaCiclos = Conexion::listarCiclos();
        $datos = [
            'listaAlumnos' => $listaAlumnos,
            'listaCiclos' => $listaCiclos
        ];

        return view('admin/gestionarAlumnos', $datos);
    })->name('gestionarAlumnos');
    Route::get('gestionarTutores', function () {
        $listaTutores = Conexion::listarTutores();
        $listaCiclos = Conexion::listarCiclos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'listaTutores' => $listaTutores,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];

        return view('admin/gestionarTutores', $datos);
    })->name('gestionarTutores');
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
    Route::any('consultarGastosAjax', function () {
        return view('admin/consultarGastosAjax');
    });
    Route::any('consultarGastosAjaxCiclo', ['uses' => 'controladorAdmin@listarCursosAjax', 'as' => 'consultarGastosAjaxCiclo']);
    Route::any('consultarGastosAjaxDniAlumno', ['uses' => 'controladorAdmin@listarAlumnosCursoAjax', 'as' => 'consultarGastosAjaxDniAlumno']);
    Route::any('consultarGastosAjaxTabla', ['uses' => 'controladorAdmin@consultarGastoAlumnoAjax', 'as' => 'consultarGastosAjaxTabla']);
    Route::any('muestraConsultarGastosAjax', ['uses' => 'controladorAdmin@muestraConsultarGastosAjax', 'as' => 'muestraConsultarGastosAjax']);
    Route::any('gestionarGastosAjax', ['uses' => 'controladorAdmin@gestionarGastosAjax', 'as' => 'gestionarGastosAjax']);

    Route::post('gestionarCursos', 'controladorAdmin@gestionarCursos');
    Route::post('gestionarTablaUsuarios', 'controladorAdmin@gestionarUsuarios');
    Route::post('gestionarTablaAlumnos', 'controladorAdmin@gestionarAlumnos');
    Route::post('gestionarTablaTutores', 'controladorAdmin@gestionarTutores');
    Route::post('exportarDocumentos', 'controladorAdmin@exportarDocumentos');
    Route::post('aniadirUsuario', 'controladorAdmin@aniadirUsuario');
});


//alumno
Route::group(['middleware' => ['alumno']], function() {
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
        $gastosAlumno = null;
        $gastosAlumno1 = null;

        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $gt = Conexion::listarGastosTransportes($dniAlumno);
        $colectivo = null;
        $propio = null;
        foreach ($gt as $key) {
            if ($key->tipoTransporte == 1) {
                $colectivo = 1;
            }
            if ($key->tipoTransporte == 0) {
                $propio = 0;
            }
        }
        if ($colectivo == 1) {
            $gastosAlumno = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
        }
        if ($propio == 0) {
            $gastosAlumno1 = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
        }
        $datos1 = ['gastosAlumno' => $gastosAlumno,
            'gastosAlumno1' => $gastosAlumno1];
        return view('alumno/gestionarGastosTransporte', $datos1);
    });

    Route::get('perfilAl', function () {
        return view('alumno/perfilAlumno');
    });
    Route::post('perfilAl1', 'controladorGeneral@perfilAl'); //redirige al perfil
    Route::post('perfilAl', 'controladorAlumno@perfil');
    Route::post('crearGastoComida', 'controladorAlumno@crearGastoComida');
    Route::post('crearGastoTransporte', 'controladorAlumno@crearGastoTransporte');
    Route::post('gestionarGastosComida', 'controladorAlumno@gestionarGastoComida');
    Route::post('gestionarGastosTransporte', 'controladorAlumno@gestionarGastosTransporte');
});


//tutor-admin
Route::group(['middleware' => ['tutorAdmin']], function() {
    Route::post('cambiarRol', 'controladorGeneral@cambiarRol');
});

