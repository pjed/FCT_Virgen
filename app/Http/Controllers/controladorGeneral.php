<?php

namespace App\Http\Controllers;

use App\Auxiliar\Conexion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class controladorGeneral extends Controller {

    /**
     * Cerrar sesion
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function cerrarSesion(Request $req) {
        session()->invalidate();
        session()->regenerate();
        return view('inicioSesion');
    }

    /**
     * Inicio Sesion
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function inicioSesion(Request $req) {
        $correo = $req->get('usuario');
        $pass = $req->get('pwd');
        if ($correo != null && $pass != null) {
            $passHash = hash('sha256', $pass);
            $n = Conexion::existeUsuario($correo, $passHash);
//            $n = Conexion::existeUsuario($correo, $pass);
            if ($n != null) { //si existe usuario
                session()->put('usu', $n);
                foreach ($n as $u) {
                    $rol = $u['rol'];
                }
                if ($rol == 0) {
                    $rol = 4;
                }

                if ($rol == 1) {//admin
                    session()->put('rol', 1);
                    echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has iniciado sesión como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    if (hash('sha256', 1) == $passHash) {
                        echo '
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Su contraseña no es segura, debe cambiarla desde su perfil.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    }
                    return view('admin.bienvenidaAd');
                } else if ($rol == 2) { //tutor                
                    session()->put('rol', 2);
                    echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has iniciado sesión como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>  ';
                    if (hash('sha256', 1) == $passHash) {
                        echo '
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Su contraseña no es segura, debe cambiarla desde su perfil.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    }
                    return view('tutor.bienvenidaT');
                } else if ($rol == 3) {//alumno                
                    session()->put('rol', 3);
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has iniciado sesión como alumno
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    if (hash('sha256', 1) == $passHash) {
                        echo '
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Su contraseña no es segura, debe cambiarla desde su perfil.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    }
                    return view('alumno.bienvenidaAl');
                } else if ($rol == 4) {//tutor-admin                              
                    session()->put('rol', 4);
                    echo '
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has iniciado sesión como administrador
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    if (hash('sha256', 1) == $passHash) {
                        echo '
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Su contraseña no es segura, debe cambiarla desde su perfil.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                    }
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
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Algún campo está vacio.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            return view('inicioSesion');
        }
    }

    /**
     * Olvidar Contraseña
     * @author Pedro
     * @param Request $req
     * @return type
     */
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
            $passHash = hash('sha256', $pass);
            //cifrar contraseña
            Conexion::RecuperarConstrasenia($dni, $passHash);


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

    /**
     * Cambiar perfil
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function cambiarRol(Request $req) {
        if (isset($_REQUEST['tutor'])) {
            session()->put('rol1', 2);
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Has inicado sesion como tutor
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            return view('tutor.bienvenidaT');
        }
        if (isset($_REQUEST['administrador'])) {
            session()->put('rol1', 1);
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
     * Redirige al perfil Alumno
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function perfilAl(Request $req) {
        return view('alumno/perfilAlumno');
    }

    /**
     * Redirige al perfil Tutor
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function perfilT(Request $req) {
        return view('tutor/perfilTutor');
    }

    /**
     * Redirige al perfil Administrador
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function perfilAd(Request $req) {
        return view('admin/perfilAdmin');
    }

    /**
     * Genera la contraseña
     * @author Manu
     * @param type $length
     * @return type
     */
    public static function generateRandomString($length) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * Actualizar foto
     * @author Pedro
     * @param Request $req
     * @return type
     */
    public function actualizarFoto(Request $req) {
        $rolUsuario = $req->get('usuario');
        $usuario = session()->get('usu');

        foreach ($usuario as $value) {
            $dni = $value['dni'];
            $email = $value['email'];
            $pass = $value['pass'];
            $now = new \DateTime();
            $updated_at = $now->format('Y-m-d H:i:s');
        }

        $foto = $req->file('subir')->move('imagenes_perfil', $dni);
        Conexion::actualizarFotoAlumno($dni, $email, $pass, $foto, $updated_at);

        $usu = Conexion::existeUsuario($email, $pass);

        session()->put('usu', $usu);
        switch ($rolUsuario) {
            case 'tutor':
                return view('tutor/perfilTutor');
                break;
            case 'admin':
                return view('admin/perfilAdmin');
                break;
            case 'alumno':
                return view('alumno/perfilAlumno');
                break;
        }
    }

    /**
     * Volver a Inicio sesion
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function VolverIndex(Request $req) {
        return view('inicioSesion');
    }

}
