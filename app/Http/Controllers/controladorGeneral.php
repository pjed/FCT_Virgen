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

class controladorGeneral extends Controller
{
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
        $n = [];
//        $n = Conexion::existeUsuario($correo, $passHash);        
        $n = Conexion::existeUsuario($correo, $pass);

        if ($n != null) {
            session()->put('usu', $n);
            foreach ($n as $u) {
                $rol = $u['rol'];
            }
//            if ($rol == 1) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    hecho bien.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
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
