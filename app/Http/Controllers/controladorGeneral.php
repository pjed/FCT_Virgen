<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorGeneral extends Controller
{
    public function cerrarSesion(Request $req) {
        session()->invalidate();
        session()->regenerate();
        return view('inicioSesion');
    }

    public function inicioSesion(Request $req) {
        $correo = $req->get('usuario');
        $pass = $req->get('pwd');
//        $passHash = md5($pass);
        $n = [];
        $n = Conexion::existeUsuario($correo, $passHash);        
//        $n = Conexion::existeUsuario($correo, $pass);

        if ($n != null) {
            
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
