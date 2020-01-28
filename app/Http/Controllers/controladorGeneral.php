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
        $w = Conexion::existeUsuario($correo, $pass);
        foreach ($w as $q) {
            $n = $q['usuario'];
            $cont = $q['cont'];
        }
        if ($cont != 0) { //si existe usuario
            session()->put('usu', $n);
            if ($cont == 1) { //si tiene un rol
                foreach ($n as $u) {
                    $usu = $u['rol'];
                }
                
                if ($rol == 1) {//admin
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    return view('bienvenidaAd');
                } else if ($rol == 2) { //tutor
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    return view('bienvenidaT');
                } else if ($rol == 3) {//alumno
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como alumno
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    return view('bienvenidaAl');
                }
            } else if ($cont != 1) { //si tiene un rol
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

}
