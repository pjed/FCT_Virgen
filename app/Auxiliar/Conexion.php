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
use App\Modal\tutor;

/**
 * Description of Conexion
 *
 * @author daw207
 */
class Conexion {

    /**
     * Método para comprobar si un usuario existe en la BD para hacer login
     * @param type $correo email del usuario
     * @param type $pwd contraseña del usuario
     * @return type usuario
     */
    static function existeUsuario($correo, $pwd) {
        $ur = usuarios_rol::all();
        $v = [];
        foreach ($ur as $a) {
            $p = usuario::where('email', $correo)->where('pass', $pwd)->where('dni', $a->usuario_dni)->first(); //aqui se cruzan
            if ($p) {
                $v[] = ['dni' => $p->dni,
                    'nombre' => $p->nombre,
                    'apellidos' => $p->apellidos,
                    'email' => $p->email,
                    'tel' => $p->telefono,
                    'movil' => $p->movil,
                    'iban' => $p->iban,
                    'rol' => $a->rol_id,
                    'curso' => $a->curso_id,
                ];
            }
        }
        return $v;
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
    static function insertarUsuarios($correo, $dni, $pwd, $nombre, $tf, $edad, $activo) {
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
    static function ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil) {
        try {
            $p = usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre,
                'apellidos' => $apellidos,
                'domicilio' => $domicilio,
                'email' => $email,
                'telefono' => $tel,
                'movil' => $movil]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado usuario con exito.
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
     * Método para modificar la contraseña de un usuario
     * @param type $dni dni del usuario
     * @param type $pass nueva contraseña
     */
    static function ModificarConstrasenia($dni, $pass) {
        try {
            $p = usuario::where('dni', $dni)
                    ->update(['pass' => $pass]);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado contraseña con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar contraseña.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * Método para modificar el rol de un usuario
     * @param type $dni dni del usuario
     * @param type $rol_id nuevo rol del usuario
     */
    static function ModificarRol($dni, $rol_id) {
        try {
            $p = usuarios_rol::where('usuario_dni', $dni)
                    ->update(['rol_id' => $rol_id]);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado rol con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar rol.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * Método para eliminar un usuario de la BD
     * @param type $dni dni del usuario a borrar
     */
    static function borrarUsuario($dni) {

        try {
            usuario::where('dni', $dni)->delete();
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

    /**
     * Método para eliminar a un usuario de la tabla usuarios_roles
     * @param type $dni dni del usuario a eliminar de la tabla
     */
    static function borrarUsuarioTablaRoles($dni) {

        try {
            usuarios_rol::where('usuario_dni', $dni)->delete();
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
    
    /**
     * Método para borrar un tutor de la BD
     * @param type $dni dni del tutor a borrar
     */
    static function borrarTutor($dni) {

        try {
            tutor::where('usuarios_dni', $dni)->delete();
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

    /**
     * Método para listar todos los usuarios que son alumnos
     * @return type lista de alumnos
     */
    static function listarAlumnos() {

        $ur = usuarios_rol::where('rol_id', 3)->get();
        $listaAlumnos = [];

        foreach ($ur as $a) {
            $w = usuario::where('dni', $a->usuario_dni)->get(); //aqui se cruzan
            foreach ($w as $p) {
                $listaAlumnos [] = ['dni' => $p->dni,
                    'nombre' => $p->nombre,
                    'apellidos' => $p->apellidos,
                    'email' => $p->email,
                    'telefono' => $p->telefono,
                    'iban' => $p->iban];
            }
        }

        return $listaAlumnos;
    }

    /**
     * Método para listar todos los usuarios que son tutores
     * @return type lista de tutores
     */
    static function listarTutores() {

        $ur = tutor::all();
        $listaTutores = [];

        foreach ($ur as $a) {
            $w = usuario::where('dni', $a->usuarios_dni)->get(); //aqui se cruzan
            foreach ($w as $p) {
                $listaTutores [] = ['idtutores' => $a->idtutores,
                    'cursos_id_curso' => $a->cursos_id_curso,
                    'usuarios_dni' => $a->usuarios_dni,
                    'nombre' => $p->nombre,
                    'apellidos' => $p->apellidos,
                    'email' => $p->email,
                    'telefono' => $p->telefono];
            }
        }

        return $listaTutores;
    }

    /**
     * Método para listar todos los ciclos disponibles del centro
     * @return type lista de ciclos
     */
    static function listarCiclos() {

        $ur = curso::all();
        $listaCiclos = [];

        foreach ($ur as $a) {
            $listaCiclos [] = ['id' => $a->id,
                'id_curso' => $a->id_curso,
                'descripcion' => $a->descripcion,
                'centro_cod' => $a->centro_cod,
                'ano_academico' => $a->ano_academico,
                'familia' => $a->familia,
                'horas' => $a->horas,
                'tutor' => $a->tutor];
        }

        return $listaCiclos;
    }

    /**
     * Método para listar todos los usuarios registrados
     * @return type lista de usuarios
     */
    static function listarUsuarios() {
        $ur = usuarios_rol::all();
        $v = [];
        foreach ($ur as $a) {
            $ur = usuario::where('dni', $a->usuario_dni)->get(); //aqui se cruzan
            foreach ($ur as $p) {
                $v[] = ['dni' => $p->dni,
                    'nombre' => $p->nombre,
                    'apellidos' => $p->apellidos,
                    'email' => $p->email,
                    'tel' => $p->telefono,
                    'movil' => $p->movil,
                    'domicilio' => $p->domicilio,
                    'iban' => $p->iban,
                    'rol_id' => $a->rol_id,
                    'curso' => $a->curso_id,
                ];
            }
        }
        return $v;
    }

    /**
     * Método para actualiar los datos de un tutor
     * @param type $dni dni del alumno
     * @param type $nombre nombre del alumno
     * @param type $apellidos apellidos del alumno
     * @param type $email email del alumno
     * @param type $telefono número de teléfono del alumno
     * @param type $iban número iban del alumno
     */
    static function actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban) {
        try {
            usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'telefono' => $telefono, 'iban' => $iban]);

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
     * Método para actualiar los datos de un tutor
     * @param type $dni dni del tutor
     * @param type $nombre nombre del tutor
     * @param type $apellidos apellidos del tutor
     * @param type $email email del tutor
     * @param type $telefono número de teléfono del tutor
     * @param type $ciclo ciclo del que es tutor
     */
    static function actualizarDatosTutor($dni, $nombre, $apellidos, $email, $telefono, $ciclo) {
        try {
            usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'telefono' => $telefono, 'curso_id' => $ciclo]);

            curso::where('id', $ciclo)
                    ->update(['tutor' => $dni]);

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

}
