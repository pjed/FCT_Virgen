<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

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
        if ($n != null) { //si existe usuario
            session()->put('usu', $n);
            foreach ($n as $u) {
                $rol = $u['rol'];
            }
            if ($rol == 1) {//admin
                session()->put('rol', 1);
                echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('admin.bienvenidaAd');
            } else if ($rol == 2) { //tutor                
                session()->put('rol', 2);
                echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>  ';
                return view('tutor.bienvenidaT');
            } else if ($rol == 3) {//alumno                
                session()->put('rol', 3);
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como alumno
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('alumno.bienvenidaAl');
            } else if ($rol == 4) {//tutor-admin                              
                session()->put('rol1', 4);
                echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                return view('admin.bienvenidaAd');
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
        $email_usuario = $req->get('email');
        $n = Conexion::existeUsuario_Correo($email_usuario);

        $nombre = null;
        $apellidos = null;
        $dni = null;

        foreach ($n as $value) {
            $nombre = $value['nombre'];
            $apellidos = $value['apellidos'];
            $dni = $value['dni'];
        }

        if ($n != null) { //si existe usuario
            //genera la contraseña
            $pass = $this->generateRandomString(5);
            //cifrar contraseña
            Conexion::RecuperarConstrasenia($dni, $pass);


            $objDemo = new \stdClass();
            $objDemo->demo_one = $email_usuario;
            $objDemo->demo_two = $pass;
            $objDemo->sender = 'Servicio de recuperación de contraseñas';
            $objDemo->receiver = $nombre . ', ' . $apellidos;

            Mail::to($email_usuario)->send(new DemoEmail($objDemo));

            return view('inicioSesion');
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error el usuario no existe o es incorrecto.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';

            return view('olvidarPwd');
        }
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

    /**
     * Genera la contraseña
     * @param type $length
     * @return type
     */
    public static function generateRandomString($length) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

}
