<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modal\tutor;
use App\Modal\matricula;
use App\Auxiliar\Conexion;
use App\Modal\centro;
use App\Modal\comida;
use App\Modal\curso;
use App\Modal\empresa;
use App\Modal\gasto;
use App\Modal\practica;
use App\Modal\propio;
use App\Modal\responsable;
use App\Modal\transporte;
use App\Modal\usuario;
use App\Modal\usuarios_rol;
use App\Modal\colectivo;

class controladorAdmin extends Controller {

    public function gestionarCursos(Request $req) {
        $id = $req->get('id');
        if (isset($_REQUEST['aniadir'])) {
            $descripcion = $req->get('descripcion');
            $anioAcademico = $req->get('anioAcademico');
            $familia = $req->get('familia');
            $horas = $req->get('horas');
            Conexion::insertarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
        }
        if (isset($_REQUEST['editar'])) {
            $descripcion = $req->get('descripcion');
            $anioAcademico = $req->get('anioAcademico');
            $familia = $req->get('familia');
            $horas = $req->get('horas');

            Conexion::ModificarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarCurso($id);
        }

        $l = Conexion::listaCursosPagination();
        return view('admin/gestionarCursos', ['l1' => $l]);
    }

    public function gestionarUsuarios(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $tel = $req->get('telefono');
            $movil = $req->get('movil');
            $domicilio = $req->get('domicilio');

            $rol_id = $req->get('selectRol');

            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil);
            Conexion::ModificarRol($dni, $rol_id);

            return view('admin/gestionarUsuarios');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarAlumnos');
        }
    }

    public function gestionarAlumnos(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $iban = $req->get('iban');

            Conexion::actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban);

            return view('admin/gestionarAlumnos');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarAlumnos');
        }
    }

    public function gestionarTutores(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $ciclo = $req->get('selectCiclo');

            Conexion::actualizarDatosTutor($dni, $nombre, $apellidos, $email, $telefono, $ciclo);

            return view('admin/gestionarTutores');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarTutor($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarTutores');
        }
    }

    public function exportarDocumentos(Request $req) {
        $familia = $req->get('familiaProfesional');
        $idCurso = $req->get('ciclo');
        if (isset($_REQUEST['recibiFPdual'])) {
            
        }

        if (isset($_REQUEST['recibiFCT'])) {
            
        }

        if (isset($_REQUEST['memoriaAlumnos'])) {
            
        }
        if (isset($_REQUEST['gastosFCT'])) {
            
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            
        }
    }

    public function perfil(Request $req) {

        return view('admin/perfilAdmin');
    }

}
