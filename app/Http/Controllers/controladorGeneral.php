<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class controladorGeneral extends Controller {

    public function cerrarSesion(Request $req) {
        session()->invalidate();
        session()->regenerate();
        return view('inicioSesion');
    }

//    public function comprobarExisteBD(Request $req) {
//        
//        return view('errorBD');//si no existe BD
//        
//        return view('inicioSesion'); //si existe BD
//    }

    public function inicioSesion(Request $req) {
        $correo = $req->get('usuario');
        $pass = $req->get('pwd');
//        $passHash = md5($pass);
        $w = [];
//        $w = Conexion::existeUsuario($correo, $passHash);        
        $n = Conexion::existeUsuario($correo, $pass);
        if ($n != 0) { //si existe usuario
            session()->put('usu', $n);
            if ($n['rol'] == 1) {//admin
                session()->put('rol', 1);
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('admin.bienvenidaAd');
            } else if ($n['rol'] == 2) { //tutor                
                session()->put('rol', 2);
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('tutor.bienvenidaT');
            } else if ($n['rol'] == 3) {//alumno                
                session()->put('rol', 3);
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como alumno
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('alumno.bienvenidaAl');
            } else if ($n['rol'] == 4) {//tutor-admin
                return view('cambiarRol');
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al introducir los datos vuelve a intentarlo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            return view('inicioSesion');
        }
    }

    public function olvidarPwd(Request $req) {
        $email = $req->get('email');
    }

    public function cambiarRol(Request $req) {
        if (isset($_REQUEST['tutor'])) {
            session()->put('rol', 2);
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            return view('tutor.bienvenidaT');
        }
        if (isset($_REQUEST['administrador'])) {
            session()->put('rol', 1);
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            return view('admin.bienvenidaAd');
        }
    }

}
