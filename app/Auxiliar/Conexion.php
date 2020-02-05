<?php

namespace App\Auxiliar;

use App\Modal\tutor;
use App\Modal\matricula;
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

    static function listarAlumnos() {

        $ur = usuarios_rol::where('rol_id', 3)->get();
        $listaAlumnos = [];

        foreach ($ur as $a) {
            $w = usuario::where('dni', $a->usuarios_dni)->get(); //aqui se cruzan
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

    static function listarTutores() {

        $ur = usuarios_rol::where('roles_id', 2)->get();
        $listaTutores = [];

        foreach ($ur as $a) {
            $w = usuario::where('dni', $a->usuarios_dni)->get(); //aqui se cruzan
            foreach ($w as $p) {
                $listaTutores [] = ['dni' => $p->dni,
                    'nombre' => $p->nombre,
                    'apellidos' => $p->apellidos,
                    'email' => $p->email,
                    'telefono' => $p->telefono,
                    'cursos_id' => $p->cursos_id];
            }
        }

        return $listaTutores;
    }

    static function listarCiclos() {

        $ur = curso::all();
        $listaCiclos = [];

        foreach ($ur as $a) {
            $listaCiclos [] = ['id' => $a->id,
                'descripcion' => $a->descripcion,
                'centro_cod' => $a->centro_cod,
                'ano_academico' => $a->ano_academico,
                'familia' => $a->familia,
                'horas' => $a->horas,
                'tutor' => $a->tutor];
        }

        return $listaCiclos;
    }

    static function listarUsuarios() {

        $ur = usuario::all();
        $listaUsuarios = [];

        foreach ($ur as $a) {
            $listaUsuarios [] = ['dni' => $a->dni,
                'nombre' => $a->nombre,
                'apellidos' => $a->apellidos,
                'email' => $a->email,
                'telefono' => $a->telefono,
                'iban' => $a->iban,
                'rol' => $a->rol];
        }

        return $listaUsuarios;
    }

    static function obtenerRolesUsuarios() {

        $ur = usuarios_rol::all();
        $listaRolesUsuarios = [];

        foreach ($ur as $a) {
            $listaRolesUsuarios [] = ['id' => $a->id,
                'usuarios_dni' => $a->usuarios_dni,
                'roles_id' => $a->roles_id];
        }

        return $listaRolesUsuarios;
    }

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

    static function actualizarDatosTutor($dni, $nombre, $apellidos, $email, $telefono, $ciclo) {
        try {
            usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'telefono' => $telefono, 'cursos_id' => $ciclo]);

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

    static function generarDocTutor() {
        $v = [];
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
            $nombre = $t['nombre'];
            $apellido = $t['apellidos'];
        }
        $q = tutor::where('usuarios_dni', $dni)->get();

        foreach ($q as $a) {
            $v [] = ['id_tutores' => $a->idTutores,
                'id_curso' => $a->cursos_id_curso,
                'dni_tutor' => $dni,
                'nombre_tutor' => $nombre,
                'apellido_tutor' => $apellido];
        }
        return $v;
    }

    static function listarPracticas() {
        $v = [];
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
        }
        $tu = tutor::where('usuarios_dni', $dni)->get();
        foreach ($tu as $t) {
            $w = matricula::where('cursos_id_curso', $t->cursos_id_curso)->get();
            foreach ($w as $m) {
                $x = usuario::where('dni', $m->usuarios_dni)->get();
                foreach ($x as $uu) {
                    $q = practica::where('usuarios_dni', $uu->dni)->get();
                    dd($q);
                    foreach ($q as $p) {
                        $v [] = ['id' => $p->id,
                            'idEmpresa' => $p->empresa_id,
                            'dniAlumno' => $p->usuarios_dni,
                            'codProyecto' => $p->cod_proyecto,
                            'idResponsable' => $p->responsables_id,
                            'gasto' => $p->gastos,
                            'apto' => $p->apto,
                            'fechaInicio' => $p->fecha_inicio,
                            'fechaFin' => $p->fecha_fin];
                    }
                }
            }
        }
        return $v;
    }

    static function borrarPractica($id) {
        try {
            usuario::where('id', $id)->delete();
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

    static function ModificarPractica($ID, $CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $apto, $fechaInicio, $fechaFin) {
        try {
            $p = practica::where('id', $ID)
                    ->update([
                'empresa_id' => $CIF,
                'usuarios_dni' => $dniAlumno,
                'cod_proyecto' => $codProyecto,
                'responsables_id' => $dniResponsable,
                'gastos' => $gasto,
                'apto' => $apto,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin
            ]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    static function listarResponsables() {
        $r = responsable::all();
        return $r;
    }

    static function ModificarResponsable($id, $dni, $nombre, $apellidos, $email, $tel) {
        try {
            $p = responsable::where('id', $id)
                    ->update([
                'dni' => $dni,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $tel
            ]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    static function borrarResponsable($id) {
        try {
            usuario::where('id', $id)->delete();
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

    static function listarEmpresas() {
        $e = empresa::all();
        return $e;
    }

    static function ModificarEmpresa($id, $dni, $nombre, $apellidos, $email, $tel) {
        try {
            $p = responsable::where('id', $id)
                    ->update([
                'dni' => $dni,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $tel
            ]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Modificado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    static function borrarEmpresa($id) {
        try {
            usuario::where('id', $id)->delete();
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
