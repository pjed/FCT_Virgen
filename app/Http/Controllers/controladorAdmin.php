<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar\Conexion;

class controladorAdmin extends Controller {

    public function gestionarUsuarios(Request $req) {

        if (isset($_REQUEST['editar'])) {
            
        }

        if (isset($_REQUEST['eliminar'])) {
            
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

            return view('admin/gestionarTutores');
        }
    }

    public function exportarDocumentos(Request $req) {

        if (isset($_REQUEST['recibiFPdual'])) {
            
        }

        if (isset($_REQUEST['recibiFCT'])) {
            
        }

        if (isset($_REQUEST['memoriaAlumnos'])) {
            
        }
    }

    public function perfil(Request $req) {
        
    }

}
