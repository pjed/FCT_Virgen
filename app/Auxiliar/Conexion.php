<?php

namespace App\Auxiliar;

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
                    'foto' => $p->foto,
                    'rol' => $a->rol_id,
                ];
            }
        }
        return $v;
    }

    /**
     * Método para insertar usuarios
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $domicilio
     * @param type $email
     * @param type $tel
     * @param type $iban
     * @param type $movil
     */
    static function insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $iban, $movil) {
        $p = new usuario;
        $p->dni = $dni;
        $p->nombre = $nombre;
        $p->apellidos = $apellidos;
        $p->domicilio = $domicilio;
        $p->email = $email;
        $p->telefono = $tel;
        $p->movil = $movil;
        $p->iban = $iban;
        $p->foto = null;
        try {
            $p->save(); //aqui se hace la insercion   
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
     * Método para insertar el rol de los usuario en la tabla usarios_rol
     * @param type $dni
     * @param type $rol
     */
    static function insertarRol($dni, $rol) {
        $p = new usuarios_rol;
        $p->dni = $dni;
        $p->rol_id = $rol;
        try {
            $pp->save(); //aqui se hace la insercion   
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

        $v = \DB::table('usuarios_roles')
                ->where('usuarios_roles.rol_id', 3)
                ->join('usuarios', 'usuarios.dni', '=', 'usuarios_roles.usuario_dni')
                ->select(
                        'usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.iban AS iban'
                )
                ->paginate(4);
        return $v;
    }

    /**
     * Método para listar todos los usuarios que son tutores
     * @return type lista de tutores
     */
    static function listarTutores() {

        $v = \DB::table('tutores')
                ->join('usuarios', 'usuarios.dni', '=', 'tutores.usuarios_dni')
                ->select(
                        'tutores.idtutores AS idtutores', 'tutores.cursos_id_curso AS cursos_id_curso', 'tutores.usuarios_dni AS usuarios_dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono'
                )
                ->paginate(4);
        return $v;
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
//        $ur = usuarios_rol::all();
//        $v = [];
//        foreach ($ur as $a) {
//            $ur = usuario::where('dni', $a->usuario_dni)->get(); //aqui se cruzan
//            foreach ($ur as $p) {
//                $v[] = ['dni' => $p->dni,
//                    'nombre' => $p->nombre,
//                    'apellidos' => $p->apellidos,
//                    'email' => $p->email,
//                    'tel' => $p->telefono,
//                    'movil' => $p->movil,
//                    'domicilio' => $p->domicilio,
//                    'iban' => $p->iban,
//                    'rol_id' => $a->rol_id,
//                    'curso' => $a->curso_id,
//                ];
//            }
//        }
//        return $v;
        
        $v = \DB::table('usuarios')
                ->join('usuarios_roles', 'usuarios.dni', '=', 'usuarios_roles.usuario_dni')
                ->select(
                        'usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.iban AS iban', 'usuarios_roles.rol_id AS rol_id'
                )
                ->paginate(4);
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

    /**
     * Método para listar alumnos de un tutor determinado
     * @return type lista de alumnos
     */
    static function listarAlumnoPorTutor() {
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
        }
        $v = [];
        $v = \DB::table('tutores')
                ->where('tutores.usuarios_dni', $dni)
                ->join('matriculados', 'matriculados.cursos_id_curso', '=', 'tutores.cursos_id_curso')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->join('usuarios_roles', 'usuarios.dni', '=', 'usuarios_roles.usuario_dni')
                ->where('usuarios_roles.rol_id', 3)
                ->select(
                        'usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellido'
                )
                ->get();
        return $v;
    }

    /**
     * Método para recoger los requisitos necesarios para la vista extraerDocT
     * @return type 
     */
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

    /**
     * Método para obtener todas las practicas con paginacion
     * @return type
     */
    static function listarPracticasPagination() {
        $v = [];
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
        }
        $v = \DB::table('tutores')
                ->where('tutores.usuarios_dni', $dni)
                ->join('matriculados', 'matriculados.cursos_id_curso', '=', 'tutores.cursos_id_curso')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->join('practicas', 'practicas.usuarios_dni', '=', 'usuarios.dni')
                ->select(
                        'practicas.id AS id', 'practicas.empresas_id AS idEmpresa', 'practicas.usuarios_dni AS dniAlumno', 'practicas.cod_proyecto AS codProyecto', 'practicas.responsables_id AS idResponsable', 'practicas.gastos AS gasto', 'practicas.fecha_inicio AS fechaInicio', 'practicas.fecha_fin AS fechaFin', 'practicas.apto AS apto'
                )
                ->paginate(4);
        return $v;
    }

    

    /**
     * Método para obtener todas las practicas sin paginacion
     * @return type
     */
    static function listarPracticas() {
        $v = [];
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
        }
        $v = \DB::table('tutores')
                ->where('tutores.usuarios_dni', $dni)
                ->join('matriculados', 'matriculados.cursos_id_curso', '=', 'tutores.cursos_id_curso')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->join('practicas', 'practicas.usuarios_dni', '=', 'usuarios.dni')
                ->select(
                        'practicas.id AS id', 'practicas.empresas_id AS idEmpresa', 'practicas.usuarios_dni AS dniAlumno', 'practicas.cod_proyecto AS codProyecto', 'practicas.responsables_id AS idResponsable', 'practicas.gastos AS gasto', 'practicas.fecha_inicio AS fechaInicio', 'practicas.fecha_fin AS fechaFin', 'practicas.apto AS apto'
                )
                ->get();
        return $v;
    }

    /**
     * Método para insertar practicas
     * @param type $CIF
     * @param type $dniAlumno
     * @param type $codProyecto
     * @param type $dniResponsable
     * @param type $gasto
     * @param type $fechaInicio
     * @param type $fechaFin
     */
    static function insertarPractica($CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $fechaInicio, $fechaFin) {
        $p = new practica;
        $p->cod_proyecto = $codProyecto;
        $p->fecha_inicio = $fechaInicio;
        $p->fecha_fin = $fechaFin;
        $p->gastos = $gasto;
        $p->apto = 0;
        $p->usuarios_dni = $dniAlumno;
        $p->empresas_id = $CIF;
        $p->responsables_id = $dniResponsable;
        try {
            $p->save(); //aqui se hace la insercion   
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
     * Método para borrar practicas
     * @param type $id
     */
    static function borrarPractica($id) {
        try {
            practica::where('id', $id)->delete();
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
     * Método para modificar practicas
     * @param type $ID
     * @param type $CIF
     * @param type $dniAlumno
     * @param type $codProyecto
     * @param type $dniResponsable
     * @param type $gasto
     * @param type $apto
     * @param type $fechaInicio
     * @param type $fechaFin
     */
    static function ModificarPractica($ID, $CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $apto, $fechaInicio, $fechaFin) {
        try {
            $p = practica::where('id', $ID)
                    ->update([
                'cod_proyecto' => $codProyecto,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'gastos' => $gasto,
                'apto' => $apto,
                'usuarios_dni' => $dniAlumno,
                'empresas_id' => $CIF,
                'responsables_id' => $dniResponsable
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

    /**
     * Método para obtener los responsables con paginacion
     * @return type
     */
    static function listarResponsablesPagination() {
        $r = responsable::paginate(4);
        return $r;
    }

    /**
     * Método para obtener los reponsables sin paginacion
     * @return type
     */
    static function listarResponsables() {
        $r = responsable::all();
        return $r;
    }

    /**
     * Método para comprobar que la responsable existe para no deje añadirla
     * @param type $dni
     * @return boolean
     */
    static function existeResponsable($dni) {
        $val = true;
        $e = responsable::where('dni', $dni)->first();
        if ($e) {
            $val = false;
        }
        return $val;
    }

    /**
     * Método para insertar responsables
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $email
     * @param type $tel
     */
    static function insertarResponsable($dni, $nombre, $apellidos, $email, $tel) {
        try {
            $p = new responsable;
            $p->id = null;
            $p->dni = $dni;
            $p->nombre = $nombre;
            $p->apellidos = $apellidos;
            $p->email = $email;
            $p->telefono = $tel;

            $p->save(); //aqui se hace la insercion   
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
     * Método para insertar responsables
     * @param type $id
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $email
     * @param type $tel
     */
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

    /**
     * Método para borrar responsable
     * @param type $id
     */
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

    /**
     * Método para obtener las empresas con paginacion
     * @return type
     */
    static function listarEmpresasPagination() {
        $e = empresa::paginate(4);
        return $e;
    }

    /**
     * Método para obtener las empresas sin paginacion
     * @return type
     */
    static function listarEmpresas() {
        $e = empresa::all();
        return $e;
    }

    /**
     * Método para comprobar que la empresa existe para no deje añadirla
     * @param type $cif
     * @return boolean
     */
    static function existeEmpresa($cif) {
        $val = true;
        $e = empresa::where('cif', $cif)->first();
        if ($e) {
            $val = false;
        }
        return $val;
    }

    /**
     * Método para insertar empresas
     * @param type $CIF
     * @param type $nombreEmpresa
     * @param type $dniRepresentante
     * @param type $nombreRepresentante
     * @param type $direccion
     * @param type $localidad
     * @param type $horario
     * @param type $nueva
     */
    static function insertarEmpresa($CIF, $nombreEmpresa, $dniRepresentante, $nombreRepresentante, $direccion, $localidad, $horario) {
        $p = new empresa;
        $p->cif = $CIF;
        $p->nombre = $nombreEmpresa;
        $p->dni_representante = $dniRepresentante;
        $p->nombre_Representante = $nombreRepresentante;
        $p->direccion = $direccion;
        $p->localidad = $localidad;
        $p->horario = $horario;
        $p->nueva = 1;
        try {
            $p->save(); //aqui se hace la insercion   
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
     * Método para modificar empresa
     * @param type $id
     * @param type $CIF
     * @param type $nombreEmpresa
     * @param type $dniRepresentante
     * @param type $nombreRepresentante
     * @param type $direccion
     * @param type $localidad
     * @param type $horario
     * @param type $nueva
     */
    static function ModificarEmpresa($id, $CIF, $nombreEmpresa, $dniRepresentante, $nombreRepresentante, $direccion, $localidad, $horario, $nueva) {
        try {
            $p = empresa::where('id', $id)
                    ->update([
                'cif' => $CIF,
                'nombre' => $nombreEmpresa,
                'dni_representante' => $dniRepresentante,
                'nombre_representante' => $nombreRepresentante,
                'direccion' => $direccion,
                'localidad' => $localidad,
                'horario' => $horario,
                'nueva' => $nueva
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

    /**
     * Método para borrar la empresa
     * @param type $id
     */
    static function borrarEmpresa($id) {
        try {
            empresa::where('id', $id)->delete();
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
     * Método para obtener los gastos de comida de un alumno determinado con paginacion de 4
     * @param type $dni
     * @return type
     */
    static function listarGastosComidasPagination($dni) {
        $v = [];
        $v = \DB::table('usuarios')
                ->where('usuarios.dni', $dni)
                ->where('gastos.tipo', 0)
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('comidas', 'comidas.id', '=', 'gastos.comidas_id')
                ->select(
                        'comidas.id AS id', 'comidas.importe AS importe', 'comidas.fecha AS fecha', 'comidas.foto AS foto'
                )
                ->paginate(4);
        return $v;
    }
    /**
     * Método para obtener los datos de transporte de un alumno determinado con paginacion de 4
     * @param type $dni
     * @return type
     */
    static function listarGastosTransportes($dni) {
        $v = [];
        $v = \DB::table('usuarios')
                ->where('usuarios.dni', $dni)
                ->where('gastos.tipo', 1)
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('transportes', 'transportes.id', '=', 'gastos.transportes_id')     
                ->select(
                        'gastos.desplazamiento AS desplazamiento','transportes.tipo AS tipo','transportes.donde AS donde'
                )
                ->paginate(4);
        return $v;
    }
    /**
     * Método para obtener los gastos de transporte colectivo de un alumno determinado con paginacion de 4
     * @param type $dni
     * @return type
     */
    static function listarGastosTransportesColectivosPagination($dni) {
        $v = [];
        $v = \DB::table('usuarios')
                ->where('usuarios.dni', $dni)
                ->where('gastos.tipo', 1)
                ->where('gastos.desplazamiento', 1)
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('transportes', 'transportes.id', '=', 'gastos.transportes_id')                
                ->join('colectivos', 'transportes.id', '=', 'colectivos.transportes_id')
                ->select(
                        'transportes.donde AS donde','colectivos.id AS idColectivos',
                        'colectivos.n_dias AS n_diasC', 'colectivos.foto AS foto', 'colectivos.importe AS precio'
                )
                ->paginate(4);
        return $v;
    }
    /**
     * Método para obtener los gastos de transporte de un alumno determinado con paginacion de 4
     * @param type $dni
     * @return type
     */
    static function listarGastosTransportesPropiosPagination($dni) {
        $v = [];
        $sql = 'SELECT transportes.donde AS donde,propios.id AS idPropios, propios.n_dias AS n_diasP, propios.kms AS kms, propios.precio AS precio FROM `usuarios` join gastos on gastos.usuarios_dni=usuarios.dni join transportes on transportes.id=gastos.transportes_id join propios On transportes.id=propios.transportes_id WHERE usuarios.dni="05931616P" and gastos.tipo=1 and gastos.desplazamiento=1 ';
        $v = \DB::table('usuarios')
                ->where('usuarios.dni', $dni)
                ->where('gastos.tipo', 1)
                ->where('gastos.desplazamiento', 1)
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('transportes', 'transportes.id', '=', 'gastos.transportes_id')  
                ->join('propios', 'transportes.id', '=', 'propios.transportes_id')
                ->select(
                        'transportes.donde AS donde','propios.id AS idPropios',
                        'propios.n_dias AS n_diasP', 'propios.kms AS kms', 'propios.precio AS precio'
                )
                ->paginate(4);
        return $v;
    }

}
