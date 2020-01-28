<?php

namespace App\Auxiliar;

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

/**
 * Description of Conexion
 *
 * @author daw207
 */
class Conexion {

    /**
     * 
     * @param type $correo
     * @param type $pwd
     * @return type
     */
    static function existeUsuario($correo, $pwd) {
        
    }

    /**
     * 
     * @return type
     */
    static function obtenerUsuarios() {
        $ar = Asignarrol::all();
        $v = [];
        foreach ($ar as $a) {
            $w = Persona::where('DNI', $a->dni)->get(); //aqui se cruzan
            foreach ($w as $p) {
                $v [] = ['DNI' => $p->DNI,
                    'correo' => $p->correo,
                    'Nombre' => $p->Nombre,
                    'Tfno' => $p->Tfno,
                    'idRol' => $a->idRol,
                    'edad' => $p->edad,
                    'activo' => $p->activo];
            }
        }
        return $v;
    }

    /**
     * insertar usuario
     * @param type $correo
     * @param type $dni
     * @param type $pwd
     * @param type $nombre
     * @param type $tf
     * @param type $edad
     * @return string
     */
    static function insertarUsuarios($correo, $dni, $pwd, $nombre, $tf, $edad,$activo) {
        $pe = new Persona;
        $pe->correo = $correo;
        $pe->DNI = $dni;
        $pe->pwd = $pwd;
        $pe->Nombre = $nombre;
        $pe->Tfno = $tf;
        $pe->edad = $edad;
        $pe->activo = $activo;
        try {
            $pe->save(); //aqui se hace la insercion   
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Insertado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Clave duplicada.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * MODIFICAR USUARIO
     * @param type $correo
     * @param type $nombre
     * @param type $tf
     * @param type $edad
     * @param type $activo
     */
    static function ModificarUsuarios($dni, $correo, $nombre, $tf, $edad, $activo) {
        try {
            $p = Persona::where('correo', $correo)
                ->where('DNI', $dni)
                ->update(['Nombre' => $nombre,
            'Tfno' => $tf,
            'edad' => $edad,
            'activo' => $activo]);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado con exito usuario.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar usuario.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * BORRAR USUARIO   
     * @param type $dni
     */
    static function borrarUsuario($dni) {
//        dd($correo);    
        try {
            Persona::where('correo', $dni)->delete();
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Borrado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al borrar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }


}
