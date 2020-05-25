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
                'buscarGTC' => null,
                'gtc' => null,
                'gtp' => null,
                'gc' => null
            ];
        }
        return view('tutor/consultarGastosAlumno', $datos);
    });
    Route::get('gestionarEmpresa', function () {
        $lu = Conexion::listarEmpresasPagination();
        $datos = ['buscarE' => null,
            'lu' => $lu];
        return view('tutor/gestionarEmpresa', $datos);
    });
    Route::get('gestionarResponsable', function () {
        $lu = Conexion::listarResponsablesPagination();
        $l1 = Conexion::listarEmpresas();
        $datos = ['buscarR' => null,
            'lu' => $lu,
            'l1' => $l1];
        return view('tutor/gestionarResponsable', $datos);
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

    //Ajax para poder modificar practicas    
    Route::any('modalModificarPracticaAjax', ['uses' => 'controladorTutor@buscarPracticaPorIdAjax', 'as' => 'modalModificarPracticaAjax']);
    Route::any('idEmpresaModificarPracticaAjax', ['uses' => 'controladorTutor@idResponsableDeUnaEmpresaPracticaAjax', 'as' => 'idEmpresaModificarPracticaAjax']);

    //Ajax listas para cargar la ventana modal modificar practica
    Route::any('listarEmpresasAjax', ['uses' => 'controladorTutor@listarEmpresasAjax', 'as' => 'listarEmpresasAjax']);
    Route::any('listarAlumnoPorTutorAjax', ['uses' => 'controladorTutor@listarAlumnoPorTutorAjax', 'as' => 'listarAlumnoPorTutorAjax']);
    Route::any('listarResponsablesAjax', ['uses' => 'controladorTutor@idResponsableDeUnaEmpresaPracticaAjax', 'as' => 'listarResponsablesAjax']);

    //Ajax para poder mostrar la modal para añadir practicas
    Route::any('idEmpresaAniadirPracticasAjax', ['uses' => 'controladorTutor@idResponsableDeUnaEmpresaPracticaAjax', 'as' => 'idEmpresaAniadirPracticasAjax']);

    Route::post('buscarPracticas', 'controladorTutor@buscarPracticas');
    Route::post('buscarResponsables', 'controladorTutor@buscarResponsables');
    Route::post('buscarEmpresas', 'controladorTutor@buscarEmpresas');

    Route::post('consultarGastosAlumno', 'controladorTutor@consultarGastoAlumno');
    Route::post('extraerDocT', 'controladorTutor@extraerDocT');
    Route::post('gestionarEmpresa', 'controladorTutor@gestionarEmpresa');
    Route::post('gestionarResponsable', 'controladorTutor@gestionarResponsable');
    Route::post('gestionarPracticas', 'controladorTutor@gestionarPracticas');
    Route::post('perfilT', 'controladorTutor@perfil');
    Route::post('perfilT1', 'controladorGeneral@perfilT'); //redirige al perfil
    Route::post('buscarGastoTutorComida', 'controladorTutor@buscarGastoTutorComida');
});


//admin
Route::group(['middleware' => ['admin']], function() {
    Route::get('bienvenidaAd', function () {
        return view('admin/bienvenidaAd');
    });
    Route::get('importarDatos', function () {
        return view('admin/importarDatos');
    });
    Route::post('DeleteDB', 'controladorAdmin@DeleteDB');
    Route::post('ImportarDatos', 'controladorAdmin@ImportarDatos');
    Route::post('ImportarDatosCSV', 'controladorAdmin@ImportarDatosCSV');
    Route::post('BorrarArchivosCSV', 'controladorAdmin@BorrarArchivosCSV');
    Route::get('dropzone', 'DropzoneController@index')->name('dropzone.store');
    Route::post('dropzone-image-upload', 'DropzoneController@store');
    Route::post('dropzone-image-delete', 'DropzoneController@destroy');

    Route::get('consultarGastosAnteriores', function () {
        $lista_cursos = Conexion::listarCursosAnteriores();

        if (count($lista_cursos) == 0) {
            return view('admin/bienvenidaAd');
        } else {

            $datos = [
                'lista_cursos' => $lista_cursos
            ];
            return view('admin/consultarGastosAnteriores', $datos);
        }
    });


    Route::post('consultarGastosAnteriores', 'controladorAdmin@consultarGastosAnteriores');
    Route::get('extraerDocA', function () {
        $l1 = Conexion::listaCursos();
        return view('admin/extraerDocA', ['l1' => $l1]);
    });
    Route::get('consultarGastos', function () {
        if (isset($_SESSION['dniAlumno'])) {
            $l1 = Conexion::listaCursos();
            $datos = [
                'l1' => $l1,
                'gc' => null,
                'gtp' => null,
                'gtc' => null,
            ];
        } else {
            $datos = controladorAdmin::paginacionConsultarGastoAlumno();
        }
        return view('admin/consultarGastos', $datos);
    });
    Route::get('gestionarCursos', function () {
        $l = Conexion::listaCursosPagination();
        $datos = [
            'buscarC' => null,
            'l1' => $l
        ];
        return view('admin/gestionarCursos', $datos);
    });
    Route::get('gestionarUsuarios', function () {
        $listaUsuarios = Conexion::listarUsuarios();
        $listaCiclos = Conexion::listaCursos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'buscarU' => null,
            'listaUsuarios' => $listaUsuarios,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];
        return view('admin/gestionarUsuarios', $datos);
    })->name('gestionarUsuarios');
    Route::get('gestionarAlumnos', function () {
        $listaAlumnos = Conexion::listarAlumnos();
        $listaCiclos = Conexion::listaCursos();
        $datos = [
            'buscarA' => null,
            'listaAlumnos' => $listaAlumnos,
            'listaCiclos' => $listaCiclos
        ];
        return view('admin/gestionarAlumnos', $datos);
    })->name('gestionarAlumnos');
    Route::get('gestionarTutores', function () {
        $listaTutores = Conexion::listarTutores();
        $listaCiclos = Conexion::listaCursos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'buscarT' => null,
            'listaTutores' => $listaTutores,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];
        return view('admin/gestionarTutores', $datos);
    })->name('gestionarTutores');
    Route::get('buscargestionarTutores', function () {
        $keywords = session()->get('keywords');
        $l = Conexion::buscarTutores($keywords);
        $listaCiclos = Conexion::listaCursos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'buscarT' => $l,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];
        return view('admin/gestionarTutores', $datos);
    })->name('buscargestionarTutores');
    Route::get('buscargestionarUsuarios', function () {
        $keywords = session()->get('keywords');
        $l = Conexion::buscarUsuarios($keywords);
        $listaCiclos = Conexion::listaCursos();
        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
        $datos = [
            'buscarU' => $l,
            'listaCiclos' => $listaCiclos,
            'listaCiclosSinTutor' => $listaCiclosSinTutor
        ];
        return view('admin/gestionarUsuarios', $datos);
    })->name('buscargestionarUsuarios');
    Route::get('buscargestionarAlumnos', function () {
        $keywords = session()->get('keywords');
        $l = Conexion::buscarAlumnos($keywords);
        $listaCiclos = Conexion::listaCursos();
        $datos = [
            'buscarA' => $l,
            'listaCiclos' => $listaCiclos
        ];
        return view('admin/gestionarAlumnos', $datos);
    })->name('buscargestionarAlumnos');
    Route::get('buscargestionarCursos', function () {
        $keywords = session()->get('keywords');
        $l = Conexion::buscarCursos($keywords);
        return view('admin/gestionarCursos', ['buscarC' => $l]);
    })->name('buscargestionarCursos');
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

    Route::post('buscarUsuarios', 'controladorAdmin@buscarUsuarios');
    Route::post('buscarAlumnos', 'controladorAdmin@buscarAlumnos');
    Route::post('buscarTutores', 'controladorAdmin@buscarTutores');
    Route::post('buscarCursos', 'controladorAdmin@buscarCursos');

    Route::post('gestionarCursos', 'controladorAdmin@gestionarCursos');
    Route::post('gestionarUsuarios', 'controladorAdmin@gestionarUsuarios');
    Route::post('gestionarAlumnos', 'controladorAdmin@gestionarAlumnos');
    Route::post('gestionarTutores', 'controladorAdmin@gestionarTutores');
    Route::post('exportarDocumentos', 'controladorAdmin@exportarDocumentos');
    Route::post('aniadirUsuario', 'controladorAdmin@aniadirUsuario');
    Route::post('buscarGastoAdminComida', 'controladorAdmin@buscarGastoAdminComida');
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
        $datos = ['buscarGAC' => null,
            'gastosAlumno' => $gastosAlumno];
        return view('alumno/gestionarGastosComida', $datos);
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
    Route::post('buscarGastoAlumnoComida', 'controladorAlumno@buscarGastoAlumnoComida');
});


//tutor-admin
Route::group(['middleware' => ['tutorAdmin']], function() {
    Route::post('cambiarRol', 'controladorGeneral@cambiarRol');
});

