<?php

namespace App\Auxiliar;

use App\Modals\matricula;
use App\Modals\centro;
use App\Modals\comida;
use App\Modals\curso;
use App\Modals\empresa;
use App\Modals\gasto;
use App\Modals\practica;
use App\Modals\propio;
use App\Modals\responsable;
use App\Modals\transporte;
use App\Modals\usuario;
use App\Modals\usuarios_rol;
use App\Modals\colectivo;
use App\Modals\tutor;

/**
 * Description of Conexion
 *
 * @author 
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
                    'domicilio' => $p->domicilio,
                    'email' => $p->email,
                    'pass' => $p->pass,
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
     * Método para comprobar si el correo del usuario que quiere recuperar la contraseña existe
     * @param type $correo email del usuario
     * @return type usuario
     */
    static function existeUsuario_Dni($dni) {
        $sal = true;
        $p = usuario::where('dni', $dni)->first(); //aqui se cruzan
        if ($p) {
            $sal = false;
        }
        return $sal;
    }

    /**
     * Método para comprobar si el correo del usuario que quiere recuperar la contraseña existe
     * @param type $correo email del usuario
     * @return type usuario
     */
    static function existeUsuario_Correo($correo) {
        $v = [];
        $p = usuario::where('email', $correo)->first(); //aqui se cruzan
        if ($p) {
            $v[] = ['dni' => $p->dni,
                'nombre' => $p->nombre,
                'apellidos' => $p->apellidos,
                'email' => $p->email,
                'tel' => $p->telefono,
                'movil' => $p->movil,
                'iban' => $p->iban,
                'foto' => $p->foto,
                'rol' => null,
            ];
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
     * @param type $rol
     */
    static function insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $iban, $movil, $rol) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
//        usuario
        $p = new usuario;
        $p->dni = $dni;
        $p->nombre = $nombre;
        $p->apellidos = $apellidos;
        $p->domicilio = $domicilio;
        $p->email = $email;
        $p->telefono = $tel;
        $p->movil = $movil;
        $p->iban = $iban;
        $p->foto = 'images/defecto.jpeg';
        $p->created_at = $updated_at;
        $p->updated_at = $updated_at;
        //rol
        $c = new usuarios_rol;
        $c->usuario_dni = $dni;
        $c->rol_id = $rol;
        $c->created_at = $updated_at;
        $c->updated_at = $updated_at;
        try {
            $p->save();
            $c->save();
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Insertado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al insertar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * MODIFICAR USUARIO
     * @param type $dni
     * @param type $nombre
     * @param type $apellidos
     * @param type $domicilio
     * @param type $email
     * @param type $tel
     * @param type $movil
     * @param type $rol_id
     */
    static function ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre,
                'apellidos' => $apellidos,
                'domicilio' => $domicilio,
                'email' => $email,
                'telefono' => $tel,
                'movil' => $movil,
                'updated_at' => $updated_at]);

            $r = usuarios_rol::where('usuario_dni', $dni)
                    ->update(['rol_id' => $rol_id,
                'updated_at' => $updated_at]);
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
     * Método para modificar la contraseña de un usuario
     * @param type $dni dni del usuario
     * @param type $pass nueva contraseña
     */
    static function RecuperarConstrasenia($dni, $pass) {
        try {
            $p = usuario::where('dni', $dni)
                    ->update(['pass' => $pass]);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Contraseña restablecida correctamente y enviada al correo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al restablecer la contraseña.
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
            usuarios_rol::where('usuario_dni', $dni)->delete();
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

    static function obtenerRolUsuario($dni) {
        $p = usuarios_rol::where('usuario_dni', $dni)->first();

        return $p;
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
     * Método para borrar un alumno de la BD
     * @param type $dni dni del alumno a borrar
     */
    static function borrarAlumno($dni) {
        try {
            matricula::where('usuarios_dni', $dni)->delete();
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
     * Método para borrar un alumno de la BD en la tabla practicas
     * @param type $dni dni del alumno a borrar
     */
    static function borrarAlumnoTablaPracticas($dni) {
        try {
            practica::where('usuarios_dni', $dni)->delete();
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
     * Método para borrar un alumno de la BD en la tabla gastos
     * @param type $dni dni del alumno a borrar
     */
    static function borrarAlumnoTablaGastos($dni) {
        try {
            gasto::where('usuarios_dni', $dni)->delete();
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

    static function obtenerIdsComidaAlumno($dni) {
        $v = \DB::table('gastos')
                ->where('usuarios_dni', $dni)
                ->select(
                        'comidas_id'
                )
                ->get();
        return $v;
    }

    static function obtenerIdsTransporteAlumno($dni) {
        $v = \DB::table('gastos')
                ->where('usuarios_dni', $dni)
                ->select(
                        'transportes_id'
                )
                ->get();
        return $v;
    }

    /**
     * Método para borrar un alumno de la BD en la tabla gastos
     * @param type $dni dni del alumno a borrar
     */
    static function borrarGastoComidaAlumno($comidas_id) {
        try {
            gasto::where('comidas_id', $comidas_id)->delete();
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
     * Método para borrar un alumno de la BD en la tabla gastos
     * @param type $dni dni del alumno a borrar
     */
    static function borrarGastoTransporteAlumno($transportes_id) {
        try {
            gasto::where('$transportes_id', $transportes_id)->delete();
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
     * buscar Gasto de Transporte Colectivo por $idTransporte y devuleve todo lo relacionado con el gasto
     * @author Marina
     * @param type $idTransporte
     * @return type
     */
    static function buscarGastoTransporteColectivo($idTransporte) {
        $t = \DB::table('transportes')
                ->where('transportes.id', $idTransporte)
                ->join('colectivos', 'transportes.id', '=', 'colectivos.transportes_id')
                ->select('transportes.id AS idTransporte', 'transportes.donde AS donde', 'colectivos.id AS idColectivos', 'colectivos.foto AS foto', 'colectivos.importe AS precio')
                ->first();

        return $t;
    }

    /**
     * buscar Gasto de Transporte Propio por $idTransporte y devuleve todo lo relacionado con el gasto
     * @author Marina
     * @param type $idTransporte
     * @return type
     */
    static function buscarGastoTransportePropio($idTransporte) {
        $t = \DB::table('transportes')
                ->where('transportes.id', $idTransporte)
                ->join('propios', 'transportes.id', '=', 'propios.transportes_id')
                ->select('transportes.id AS idTransporte', 'transportes.donde AS donde', 'propios.id AS idPropios', 'propios.kms AS kms', 'propios.precio AS precio')
                ->first();

        return $t;
    }

    /**
     * buscar Gasto de Comida por $idGasto y devuleve todo lo relacionado con el gasto
     * @author Marina
     * @param type $idGasto
     * @return type
     */
    static function buscarGastoComida($idGasto) {
        $t = \DB::table('gastos')
                ->where('id', $idGasto)
                ->join('comidas', 'comidas.id', '=', 'gastos.comidas_id')
                ->select('gastos.id AS idGasto', 'comidas.id AS id', 'comidas.importe AS importe', 'comidas.fecha AS fecha', 'comidas.foto AS foto')
                ->first();
        return $t;
    }

    /**
     * Método para listar todos los usuarios que son alumnos
     * @return type lista de alumnos
     */
    static function listarAlumnos() {
        $v = \DB::table('matriculados')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.iban AS iban', 'usuarios.foto AS foto', 'matriculados.cursos_id_curso as curso')
                ->paginate(8);
        return $v;
    }

    /**
     * Método para listar todos los usuarios que son tutores
     * @return type lista de tutores
     */
    static function listarTutores() {
        $v = \DB::table('tutores')
                ->join('usuarios', 'usuarios.dni', '=', 'tutores.usuarios_dni')
                ->select('tutores.idtutores AS idtutores', 'tutores.cursos_id_curso AS cursos_id_curso', 'tutores.usuarios_dni AS usuarios_dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.foto AS foto')
                ->paginate(8);
        return $v;
    }

    /**
     * Método para listar todos los ciclos que no tienen tutor
     * @return type lista de ciclos sin tutor
     */
    static function listarCiclosSinTutor() {
        $sql = "SELECT * FROM cursos WHERE id_curso NOT IN (SELECT cursos_id_curso FROM tutores)";
        $listaTutores = \DB::select($sql);
        return $listaTutores;
    }

    /**
     * Método para listar todos los usuarios registrados
     * @return type lista de usuarios
     */
    static function listarUsuarios() {
        $v = \DB::table('usuarios')
                ->join('usuarios_roles', 'usuarios.dni', '=', 'usuarios_roles.usuario_dni')
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.iban AS iban', 'usuarios_roles.rol_id AS rol_id', 'usuarios.foto AS foto')
                ->paginate(8);
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
    static function actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban, $ciclo, $updated_at) {
        try {
            usuario::where('dni', $dni)
                    ->update([
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'email' => $email,
                        'telefono' => $telefono,
                        'iban' => $iban,
                        'updated_at' => $updated_at
            ]);

            matricula::where('usuarios_dni', $dni)
                    ->update([
                        'cursos_id_curso' => $ciclo,
                        'updated_at' => $updated_at
            ]);

            session()->put('dniAlumnoModificado', $dni);

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
     * Método para actualiar la foto del alumno
     * @param type $dni dni del alumno
     * @param type $password la password del alumno
     * @param type $foto foto del alumno
     * @param type $updated_at la fecha en la que se actualizo el perfil
     */
    static function actualizarFotoAlumno($dni, $email, $password, $foto, $updated_at) {
        try {
            usuario::where('dni', $dni)
                    ->update([
                        'email' => $email,
                        'pass' => $password,
                        'foto' => $foto,
                        'updated_at' => $updated_at
            ]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Actualizada foto de perfil correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al actualizar foto de perfil.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
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
    static function actualizarDatosAdminTutor($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $movil, $updated_at) {
        try {
            usuario::where('dni', $dni)
                    ->update([
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'domicilio' => $domicilio,
                        'email' => $email,
                        'telefono' => $telefono,
                        'movil' => $movil,
                        'updated_at' => $updated_at
            ]);

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
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            usuario::where('dni', $dni)
                    ->update(['nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'telefono' => $telefono,
                        'updated_at' => $updated_at]);

            tutor::where('usuarios_dni', $dni)
                    ->update(['cursos_id_curso' => $ciclo,
                        'updated_at' => $updated_at]);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Datos del usuario modificados con éxito.
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
     * Método para listar todos los alumnos de un curso
     * @param type $ciclo
     */
    static function listarAlumnosCurso($ciclo) {
        $v = \DB::table('matriculados')
                ->where('matriculados.cursos_id_curso', $ciclo)
                ->join('cursos', 'matriculados.cursos_id_curso', '=', 'cursos.id_curso')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.iban AS iban')
                ->get();
        return $v;
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
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos')
                ->get();
        return $v;
    }

    /**
     * Método para listar alumnos de un tutor determinado
     * @return type lista de alumnos
     */
    static function listarAlumnoPorTutorSinPracticas() {
        $tutor = session()->get('usu');
        foreach ($tutor as $t) {
            $dni = $t['dni'];
        }
        $v = [];

        $sql = 'SELECT usuarios.dni AS dni, usuarios.nombre AS nombre, usuarios.apellidos AS apellidos FROM tutores, matriculados, usuarios, usuarios_roles'
                . ' WHERE matriculados.cursos_id_curso = tutores.cursos_id_curso'
                . ' AND usuarios.dni = matriculados.usuarios_dni'
                . ' AND usuarios.dni = usuarios_roles.usuario_dni'
                . ' AND tutores.usuarios_dni = "' . $dni . '"'
                . ' AND usuarios.dni NOT IN (SELECT practicas.usuarios_dni FROM practicas WHERE practicas.usuarios_dni = usuarios.dni);';
        $v = \DB::select($sql);
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
     * Muestra la una practica, metodo hecho para la modal de modificar practicas
     * @author Marina
     * @param type $idPractica
     * @return type
     */
    static function buscarPracticaPorId($idPractica) {
        $v = \DB::table('practicas')
                ->where('id', $idPractica)
                ->select('id AS idPractica', 'empresas_id AS idEmpresa', 'usuarios_dni AS dniAlumno', 'cod_proyecto AS codProyecto', 'responsables_id AS idResponsable', 'gastos AS gasto', 'fecha_inicio AS fechaInicio', 'fecha_fin AS fechaFin', 'apto')
                ->first();
        return $v;
    }

    /**
     * Método para obtener todas las practicas con paginacion
     * @return type
     * @author Marina
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
                ->select('practicas.id AS idPractica', 'practicas.empresas_id AS idEmpresa', 'practicas.usuarios_dni AS dniAlumno', 'practicas.cod_proyecto AS codProyecto', 'practicas.responsables_id AS idResponsable', 'practicas.gastos AS gasto', 'practicas.fecha_inicio AS fechaInicio', 'practicas.fecha_fin AS fechaFin', 'practicas.apto AS apto')
                ->paginate(8);
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
                ->select('practicas.id AS id', 'practicas.empresas_id AS idEmpresa', 'practicas.usuarios_dni AS dniAlumno', 'practicas.cod_proyecto AS codProyecto', 'practicas.responsables_id AS idResponsable', 'practicas.gastos AS gasto', 'practicas.fecha_inicio AS fechaInicio', 'practicas.fecha_fin AS fechaFin', 'practicas.apto AS apto')
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
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');

        $p = new practica;
        $p->cod_proyecto = $codProyecto;
        $p->fecha_inicio = $fechaInicio;
        $p->fecha_fin = $fechaFin;
        $p->gastos = $gasto;
        $p->apto = 0;
        $p->usuarios_dni = $dniAlumno;
        $p->empresas_id = $CIF;
        $p->responsables_id = $dniResponsable;
        $p->created_at = $updated_at;
        $p->updated_at = $updated_at;

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
     * Metodo para poder borrar el empresa
     * @param type $dni
     */
    static function ModificarPracticaEmpresa($id) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = practica::where('empresas_id', $id)
                    ->update([
                'empresas_id' => 0,
                'updated_at' => $updated_at
            ]);
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * Metodo para poder borrar el empresa
     * @param type $id
     */
    static function borrarResponsableEmpresa($id) {
        try {
            $p = responsable::where('empresa_id', $id)->delete();
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    /**
     * Metodo para poder borrar el responsable
     * @param type $dni
     */
    static function ModificarPracticaResponsable($id) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = practica::where('empresas_id', $id)
                    ->update([
                'responsables_id' => 0,
                'updated_at' => $updated_at
            ]);
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error.
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
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            \DB::table('practicas')
                    ->where('id', $ID)
                    ->update(['cod_proyecto' => $codProyecto,
                        'fecha_inicio' => $fechaInicio,
                        'fecha_fin' => $fechaFin,
                        'gastos' => $gasto,
                        'apto' => $apto,
                        'usuarios_dni' => $dniAlumno,
                        'empresas_id' => $CIF,
                        'responsables_id' => $dniResponsable,
                        'updated_at' => $updated_at]);

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
        $r = responsable::paginate(8);
        return $r;
    }

    /**
     * Método para obtener los reponsables de una empresa
     * @return type
     * @author Marina
     */
    static function listarResponsablesEmpresa($idEmpresa) {
        $r = responsable::where('empresa_id', $idEmpresa)->get();
        return $r;
    }

    /**
     * Método para obtener los reponsables sin paginacion
     * @return type
     * @author Marina
     */
    static function listarResponsables() {
        $r = responsable::all();
        return $r;
    }

    /**
     * Método para comprobar que el curso existe para no deje añadirla
     * @param type $dni
     * @return boolean
     */
    static function existeCurso($cilo) {
        $val = true;
        $e = curso::where('id_curso', $cilo)->first();
        if ($e) {
            $val = false;
        }
        return $val;
    }

    /**
     * Método para comprobar que la practica existe para no deje añadirla
     * @param type $dni
     * @return boolean
     */
    static function existePractica($dni) {
        $val = true;
        $e = practica::where('usuarios_dni', $dni)->first();
        if ($e) {
            $val = false;
        }
        return $val;
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
     * @param type $CIF
     */
    static function insertarResponsable($dni, $nombre, $apellidos, $email, $tel, $CIF) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = new responsable;
            $p->id = null;
            $p->dni = $dni;
            $p->nombre = $nombre;
            $p->apellidos = $apellidos;
            $p->email = $email;
            $p->telefono = $tel;
            $p->empresa_id = $CIF;
            $p->created_at = $updated_at;
            $p->updated_at = $updated_at;
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
     * @param type $CIF
     */
    static function ModificarResponsable($id, $dni, $nombre, $apellidos, $email, $tel, $CIF) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = responsable::where('id', $id)
                    ->update([
                'dni' => $dni,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $tel,
                'empresa_id' => $CIF,
                'updated_at' => $updated_at
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
            responsable::where('id', $id)->delete();
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
        $e = empresa::paginate(8);
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
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        $p = new empresa;
        $p->cif = $CIF;
        $p->nombre = $nombreEmpresa;
        $p->dni_representante = $dniRepresentante;
        $p->nombre_Representante = $nombreRepresentante;
        $p->direccion = $direccion;
        $p->localidad = $localidad;
        $p->horario = $horario;
        $p->nueva = 1;
        $p->created_at = $updated_at;
        $p->updated_at = $updated_at;
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
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
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
                'nueva' => $nueva,
                'updated_at' => $updated_at
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
     * buscarCursos y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarCursos($keywords) {
        $v = \DB::table('cursos')
                ->where('id_curso', 'like', '%' . $keywords . '%')
                ->orWhere('descripcion', 'like', '%' . $keywords . '%')
                ->orWhere('familia', 'like', '%' . $keywords . '%')
                ->select('id_curso AS id', 'descripcion', 'ano_academico AS anioAcademico', 'familia', 'horas')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarPracticas y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarPracticas($keywords) {
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
                ->join('empresas', 'empresas.id', '=', 'practicas.empresas_id')
                ->where('usuarios.nombre', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.apellidos', 'like', '%' . $keywords . '%')
                ->orWhere('empresas.nombre', 'like', '%' . $keywords . '%')
                ->select('practicas.id AS idPractica', 'practicas.empresas_id AS idEmpresa', 'practicas.usuarios_dni AS dniAlumno', 'practicas.cod_proyecto AS codProyecto', 'practicas.responsables_id AS idResponsable', 'practicas.gastos AS gasto', 'practicas.fecha_inicio AS fechaInicio', 'practicas.fecha_fin AS fechaFin', 'practicas.apto AS apto')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarResponsables y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarResponsables($keywords) {
        $v = [];
        $v = responsable::where('empresa_id', 'like', '%' . $keywords . '%')
                ->orWhere('nombre', 'like', '%' . $keywords . '%')
                ->orWhere('apellidos', 'like', '%' . $keywords . '%')
                ->orWhere('email', 'like', '%' . $keywords . '%')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarEmpresas y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarEmpresas($keywords) {
        $v = [];
        $v = empresa::where('cif', 'like', '%' . $keywords . '%')
                ->orWhere('nombre', 'like', '%' . $keywords . '%')
                ->orWhere('localidad', 'like', '%' . $keywords . '%')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarUsuarios y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarUsuarios($keywords) {
        $v = [];
        $v = \DB::table('usuarios')
                ->join('usuarios_roles', 'usuarios.dni', '=', 'usuarios_roles.usuario_dni')
                ->where('usuarios.nombre', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.apellidos', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.email', 'like', '%' . $keywords . '%')
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.iban AS iban', 'usuarios_roles.rol_id AS rol_id', 'usuarios.foto AS foto')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarAlumnos y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarAlumnos($keywords) {
        $v = [];
        $v = \DB::table('matriculados')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->where('usuarios.nombre', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.apellidos', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.email', 'like', '%' . $keywords . '%')
                ->select('usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.iban AS iban', 'usuarios.foto AS foto', 'matriculados.cursos_id_curso as curso')
                ->paginate(8);
        return $v;
    }

    /**
     * buscarTutores y mostrarlas en la tabla 
     * @author Marina
     * @param type $keywords
     * @return type
     */
    static function buscarTutores($keywords) {
        $v = [];
        $v = \DB::table('tutores')
                ->join('usuarios', 'usuarios.dni', '=', 'tutores.usuarios_dni')
                ->where('usuarios.nombre', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.apellidos', 'like', '%' . $keywords . '%')
                ->orWhere('usuarios.email', 'like', '%' . $keywords . '%')
                ->select('tutores.idtutores AS idtutores', 'tutores.cursos_id_curso AS cursos_id_curso', 'tutores.usuarios_dni AS usuarios_dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.movil AS movil', 'usuarios.domicilio AS domicilio', 'usuarios.foto AS foto')
                ->paginate(8);
        return $v;
    }

    static function insertarGastoComida($importe, $fecha, $foto) {
        try {
            $now = new \DateTime();
            $fechaHoy = $now->format('Y-m-d H:i:s');

            $c = new comida;
            $c->importe = $importe;
            $c->fecha = $fecha;
            $c->foto = $foto;
            $c->created_at = $fecha;
            $c->updated_at = $fechaHoy;

            $c->save(); //aqui se hace la insercion   
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

    static function obtenerIdComidaIngresada() {
        $comida = comida::all()->last();
        $id = $comida->id;
        return $id;
    }

    static function ingresarGastoTablaGastos($desplazamiento, $tipo, $usuarios_dni, $comidas_id, $transporte_id) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $g = new gasto;
            $g->desplazamiento = $desplazamiento;
            $g->tipo = $tipo;
            $g->usuarios_dni = $usuarios_dni;
            $g->comidas_id = $comidas_id;
            $g->transportes_id = $transporte_id;
            $g->created_at = $updated_at;
            $g->updated_at = $updated_at;
            $g->save(); //aqui se hace la insercion   
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Gasto insertado en la tabla con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al insertar el gasto en la tabla.
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
                ->whereNotIn('gastos.comidas_id', [0])
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('comidas', 'comidas.id', '=', 'gastos.comidas_id')
                ->select('gastos.id AS idGasto', 'comidas.id AS id', 'comidas.importe AS importe', 'comidas.fecha AS fecha', 'comidas.foto AS foto')
                ->paginate(8);
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
                ->select('gastos.id AS idGasto', 'gastos.desplazamiento AS desplazamiento', 'transportes.id AS idTransporte', 'transportes.tipo AS tipoTransporte', 'transportes.donde AS donde')
                ->paginate(8);
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
                ->select('transportes.id AS idTransporte', 'transportes.donde AS donde', 'colectivos.id AS idColectivos', 'colectivos.foto AS foto', 'colectivos.importe AS precio')
                ->paginate(8);
        return $v;
    }

    /**
     * Método para obtener los gastos de transporte de un alumno determinado con paginacion de 4
     * @param type $dni
     * @return type
     */
    static function listarGastosTransportesPropiosPagination($dni) {
        $v = [];
//        $sql = 'SELECT transportes.donde AS donde,propios.id AS idPropios, propios.kms AS kms, propios.precio AS precio FROM `usuarios` join gastos on gastos.usuarios_dni=usuarios.dni join transportes on transportes.id=gastos.transportes_id join propios On transportes.id=propios.transportes_id WHERE usuarios.dni="05931616P" and gastos.tipo=1 and gastos.desplazamiento=1 ';
        $v = \DB::table('usuarios')
                ->where('usuarios.dni', $dni)
                ->where('gastos.tipo', 1)
                ->where('gastos.desplazamiento', 1)
                ->join('gastos', 'gastos.usuarios_dni', '=', 'usuarios.dni')
                ->join('transportes', 'transportes.id', '=', 'gastos.transportes_id')
                ->join('propios', 'transportes.id', '=', 'propios.transportes_id')
                ->select('transportes.id AS idTransporte', 'transportes.donde AS donde', 'propios.id AS idPropios', 'propios.kms AS kms', 'propios.precio AS precio')
                ->paginate(8);
        return $v;
    }

    /**
     * Método para los gastos de comida del alumnno
     * @param type $id
     * @param type $fecha
     * @param type $importe
     * @param type $foto
     */
    static function ModificarGastoComida($id, $fecha, $importe, $foto) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = comida::where('id', $id)
                    ->update([
                'fecha' => $fecha,
                'importe' => $importe,
                'foto' => $foto,
                'updated_at' => $updated_at
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

    static function ModificarGastoComidaSinFoto($id, $fecha, $importe) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = comida::where('id', $id)
                    ->update([
                'fecha' => $fecha,
                'importe' => $importe,
                'updated_at' => $updated_at
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
     * borrar gastos cuando se borrar a un alumno por dni
     * @author Marina
     * @param type $dni
     */
    static function borrarGastoComidaDNI($dni) {
        try {
            //mirar los id de la tabla comidas para borrarlos
            $r = gasto::where('usuarios_dni', $dni)->select('comidas_id as id')->get();
            foreach ($r as $key) {
                //eliminar tabla comida
                comida::where('id', $key->id)->delete();
            }
            //eliminar tabla gasto
            gasto::where('usuarios_dni', $dni)->delete();
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
     * borrar gastos cuando se borrar a un alumno por dni
     * @author Marina
     * @param type $dni
     */
    static function borrarGastoPropioDNI($dni) {
        try {
            //mirar los id de la tabla propio para borrarlos
            $r = gasto::where('usuarios_dni', $dni)->select('transportes_id as id')->get();
            foreach ($r as $key) {
                //eliminar tabla transporte
                transporte::where('id', $key->id)->delete();
                //eliminar tabla propio
                propio::where('transportes_id', $key->id)->delete();
            }
            //eliminar tabla gasto
            gasto::where('usuarios_dni', $dni)->delete();
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
     * borrar gastos cuando se borrar a un alumno por dni
     * @author Marina
     * @param type $dni
     */
    static function borrarGastoColectivoDNI($dni) {
        try {
            //mirar los id de la tabla colectivo para borrarlos
            $r = gasto::where('usuarios_dni', $dni)->select('transportes_id as id')->get();
            foreach ($r as $key) {
                //eliminar tabla transporte
                transporte::where('id', $key->id)->delete();
                //eliminar tabla colectivo
                colectivo::where('transportes_id', $key->id)->delete();
            }
            //eliminar tabla gasto
            gasto::where('usuarios_dni', $dni)->delete();
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
     * Método para borrar los gastos de comida del alumno
     * @param type $idGasto
     */
    static function borrarGastoComida($idGasto) {
        try {
            //obtenemos el comidas_id
            $v = gasto::where('id', $idGasto)->select('comidas_id')->first();
            //eliminar tabla comida
            comida::where('id', $v)->delete();
            //eliminar tabla gasto
            gasto::where('id', $idGasto)->delete();
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
     * Método para borrar los gastos de transporte colectivo del alumno
     * @param type $idTransporte
     */
    static function borrarGastoTransporteColectivo($idTransporte) {
        try {
            //eliminar tabla gasto
            gasto::where('transportes_id', $idTransporte)->delete();
            //eliminar tabla colectivo
            colectivo::where('transportes_id', $idTransporte)->delete();
            //eliminar tabla transporte
            transporte::where('id', $idTransporte)->delete();
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
     * Método para modificar los gastos de transporte colectivo del alumno
     * @param type $id
     * @param type $donde
     * @param type $precio
     * @param type $foto
     */
    static function ModificarGastoTransporteColectivo($id, $precio, $foto) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = colectivo::where('id', $id)
                    ->update([
                'foto' => $foto,
                'importe' => $precio,
                'updated_at' => $updated_at
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

    static function ModificarGastoTransporteColectivoSinFoto($id, $precio) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = colectivo::where('id', $id)
                    ->update([
                'importe' => $precio,
                'updated_at' => $updated_at
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
     * Método para borrar los gastos de transporte propio del alumno
     * @param type $id
     */
    static function borrarGastoTransportePropio($idTransporte) {
        try {
            //eliminar tabla gasto
            gasto::where('transportes_id', $idTransporte)->delete();
            //eliminar tabla propio
            propio::where('transportes_id', $idTransporte)->delete();
            //eliminar tabla transporte
            transporte::where('id', $idTransporte)->delete();
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
     * Método para modificar los gastos de transporte propio del alumno
     * @param type $id
     * @param type $donde
     * @param type $precio
     * @param type $kms
     */
    static function ModificarGastoTransportePropio($id, $precio, $kms) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = propio::where('id', $id)
                    ->update([
                'kms' => $kms,
                'precio' => $precio,
                'updated_at' => $updated_at
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
     * metodo obtener anio academico
     */
    static function obtenerAnioAcademico() {

        $sql = "SELECT cursos.ano_academico AS ano_academico from cursos group by cursos.ano_academico";

        $ano_academico = \DB::select($sql);

        return $ano_academico;
    }

    /**
     * metodo obtener datos centro
     */
    static function obtenerDatosCentro() {

        $sql = "SELECT centros.cod, centros.nombre, centros.localidad from centros";

        $datos_centro = \DB::select($sql);

        return $datos_centro;
    }

    /**
     * metodo obtener datos ciclo
     */
    static function obtenerDatosCiclo($curso) {

        $sql = "SELECT cursos.descripcion, cursos.horas from cursos where id_curso = '" . $curso . "';";

        $datos_ciclo = \DB::select($sql);

        return $datos_ciclo;
    }

    /**
     * metodo obtener datos tutor ciclo
     */
    static function obtenerDatosTutorCiclo($curso) {

        $sql = "SELECT cursos.id_curso, usuarios.dni, concat(usuarios.nombre,' ',usuarios.apellidos) as nombre_tutor, usuarios.email
                FROM cursos, tutores, usuarios
                where cursos.id_curso = tutores.cursos_id_curso
                and tutores.usuarios_dni = usuarios.dni
                and cursos.id_curso = '" . $curso . "';";

        $datos_ciclo = \DB::select($sql);

        return $datos_ciclo;
    }

    /**
     * metodo obtener gastos alumnos por curso
     */
    static function obtenerAlumnosGastos($curso) {

        $sql = "select concat(comidas.apellidos, ', ', comidas.nombre) as nombre_completo, comidas.otros_gastos_2, importe_billete_colectivo, n_dias, kms, 'INSERTAR DIAS' as numero_dias, '0,12' as importe_gastos_kilometraje
 from (select usuarios.dni as dni, usuarios.apellidos as apellidos, usuarios.nombre as nombre, sum(comidas.importe) as otros_gastos_2
                from usuarios, cursos, matriculados, gastos, comidas
                where usuarios.dni = matriculados.usuarios_dni
                and usuarios.dni = gastos.usuarios_dni
                and matriculados.cursos_id_curso = cursos.id_curso
                and gastos.comidas_id = comidas.id
                and usuarios.dni<> '0'
                and gastos.id <>'0'
                and cursos.id_curso='" . $curso . "' group by dni) as comidas LEFT JOIN (select usuarios.dni as dni, ROUND((sum(colectivos.importe)/count(colectivos.importe)), 2) as importe_billete_colectivo, count(colectivos.importe) as n_dias
                from usuarios, cursos, matriculados, gastos, transportes, colectivos
                where usuarios.dni = matriculados.usuarios_dni
                and usuarios.dni = gastos.usuarios_dni
                and gastos.transportes_id = transportes.id
                and transportes.id = colectivos.transportes_id
                and matriculados.cursos_id_curso = cursos.id_curso
                and usuarios.dni<> '0'
                and gastos.id <> '0'
                and transportes.id <>'0'
                and colectivos.id <>'0'
                and cursos.id_curso='" . $curso . "'
                group by usuarios.dni) as transporte_colectivo ON comidas.dni = transporte_colectivo.dni LEFT JOIN (select usuarios.dni AS dni, propios.kms as kms, propios.n_dias as numero_dias, (propios.kms*propios.n_dias* propios.precio) as importe_gastos_kilometraje
                from usuarios, cursos, matriculados, gastos, transportes, propios
                where usuarios.dni = matriculados.usuarios_dni
                and usuarios.dni = gastos.usuarios_dni
                and gastos.transportes_id = transportes.id
                and transportes.id = propios.transportes_id
                and matriculados.cursos_id_curso = cursos.id_curso
                and usuarios.dni<> '0'
                and gastos.id <> '0'
                and transportes.id <> '0'
                and propios.id <> '0'
                and cursos.id_curso='" . $curso . "'
                group by usuarios.dni, propios.kms, propios.n_dias, (propios.kms*propios.n_dias* propios.precio)) as transporte_propio ON transporte_colectivo.dni = transporte_propio.dni;";


        $gastos_alumnos = \DB::select($sql);

        return $gastos_alumnos;
    }

    /**
     * metodo obtener datos director
     */
    static function obtenerDatosDirector() {

        $sql = "SELECT concat(usuarios.nombre, ' ',usuarios.apellidos) as nombre_director
                FROM usuarios, usuarios_roles 
                WHERE usuarios_roles.usuario_dni = usuarios.dni
                and usuarios_roles.rol_id=0;";

        $datos_director = \DB::select($sql);

        return $datos_director;
    }

    /**
     * Método para obtener todos los cursos
     * @return type
     */
    static function listaCursos() {
        $v = [];
        $v = \DB::table('cursos')
                ->select('id_curso AS id', 'descripcion', 'ano_academico AS anioAcademico', 'familia', 'horas')
                ->get();
        return $v;
    }

    /**
     * Método para obtener todos los cursos con paginacion de 4
     * @return type
     */
    static function listaCursosPagination() {
        $v = [];
        $v = \DB::table('cursos')->select('id_curso AS id', 'descripcion', 'ano_academico AS anioAcademico', 'familia', 'horas')
                ->paginate(8);
        return $v;
    }

    static function insertarCurso($id, $descripcion, $anioAcademico, $familia, $horas) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = new curso;
            $p->id_curso = $id;
            $p->descripcion = $descripcion;
            $p->ano_academico = $anioAcademico;
            $p->familia = $familia;
            $p->horas = $horas;
            $p->centros_cod = '13002691';
            $p->created_at = $updated_at;
            $p->updated_at = $updated_at;
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

    static function ModificarCurso($id, $descripcion, $anioAcademico, $familia, $horas) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $p = curso::where('id_curso', $id)
                    ->update([
                'descripcion' => $descripcion,
                'ano_academico' => $anioAcademico,
                'familia' => $familia,
                'horas' => $horas,
                'updated_at' => $updated_at
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
     * metodo borra el curso de la tabla cursos y pone a null el curso de la tabla tutor y matriculados
     * @author Marina
     * @param type $id
     */
    static function borrarCurso($id) {
        try {
            //poner a null el curso en la tabla tutor
            tutor::where('cursos_id_curso', $id)->delete();
            //poner a null el curso en la tabla matricula
            matricula::where('cursos_id_curso', $id)->delete();
            //borrar curso
            curso::where('id_curso', $id)->delete();
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

    static function insertarTransporteColectivo($tipo, $donde, $foto, $importe) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {

            //insertar el gasto en la tabla transportes
            $t = new transporte;
            $t->tipo = $tipo;
            $t->donde = $donde;
            $t->created_at = $updated_at;
            $t->updated_at = $updated_at;
            $t->save();

            $transporte = transporte::all()->last();
            if ($transporte != null) {
                $idTransporte = $transporte->id;
            } else {
                $idTransporte = 0;
            }

            //insertar el gasto en la tabla colectivos
            $c = new colectivo;
            $c->foto = $foto;
            $c->importe = $importe;
            $c->transportes_id = $idTransporte;
            $c->created_at = $updated_at;
            $c->updated_at = $updated_at;
            $c->save(); //aqui se hace la insercion   
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Transporte colectivo insertado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al guardar el transporte colectivo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    static function insertarTransportePropio($tipo, $donde, $kms, $precio) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {

            //insertar el gasto en la tabla transportes
            $t = new transporte;
            $t->tipo = $tipo;
            $t->donde = $donde;
            $t->created_at = $updated_at;
            $t->updated_at = $updated_at;
            $t->save();

            $transporte = transporte::all()->last();
            if ($transporte != null) {
                $idTransporte = $transporte->id;
            } else {
                $idTransporte = 0;
            }

            //insertar el gasto en la tabla colectivos
            $c = new propio;
            $c->kms = $kms;
            $c->precio = $precio;
            $c->transportes_id = $idTransporte;
            $c->created_at = $updated_at;
            $c->updated_at = $updated_at;
            $c->save(); //aqui se hace la insercion   
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

    static function obtenerIdTransporteIngresado() {
        $transporte = transporte::all()->last();
        if ($transporte != null) {
            $idTransporte = $transporte->id;
        } else {
            $idTransporte = -1;
        }
        return $idTransporte;
    }

    static function obtenerIdUltimaComidaIngresada() {
        $comidas = comida::all()->last();
        if ($comidas != null) {
            $idUltimaComida = $comidas->id;
        } else {
            $idUltimaComida = -1;
        }
        return $idUltimaComida;
    }

    static function obtenerDatosAlumno($dni) {
        $p = usuario::where('dni', $dni)->first();
        if ($p) {
            $alumno[] = ['dni' => $p->dni,
                'nombre' => $p->nombre,
                'apellidos' => $p->apellidos,
                'domicilio' => $p->domicilio,
                'email' => $p->email,
                'pass' => $p->pass,
                'tel' => $p->telefono,
                'movil' => $p->movil,
                'iban' => $p->iban,
                'foto' => $p->foto,
            ];
        }
        return $alumno;
    }

    static function listarAlumnoMatriculado($dni) {
        $v = \DB::table('matriculados')
                ->where('usuarios.dni', $dni)
                ->join('cursos', 'matriculados.cursos_id_curso', '=', 'cursos.id_curso')
                ->join('usuarios', 'usuarios.dni', '=', 'matriculados.usuarios_dni')
                ->select(
                        'usuarios.dni AS dni', 'usuarios.nombre AS nombre', 'usuarios.apellidos AS apellidos', 'usuarios.domicilio AS domicilio', 'usuarios.email AS email', 'usuarios.telefono AS telefono', 'usuarios.iban AS iban', 'matriculados.cursos_id_curso AS curso', 'cursos.descripcion AS descripcion', 'cursos.descripcion AS descripcion', 'cursos.familia AS familia', 'cursos.horas AS horas'
                )
                ->get();
        return $v;
    }

    static function listarPracticasAlumno($dni) {
        $v = \DB::table('practicas')
                ->where('practicas.usuarios_dni', $dni)
                ->join('empresas', 'practicas.empresas_id', '=', 'empresas.id')
                ->select(
                        'empresas.nombre AS nombre', 'empresas.localidad AS localidad', 'empresas.direccion AS direccion'
                )
                ->get();
        return $v;
    }
    
    static function listarGastosAlumno($dni) {
        $v = \DB::table('practicas')
                ->where('practicas.usuarios_dni', $dni)
                ->select(
                        'practicas.gastos AS total_gasto_alumno'
                )
                ->get();
        return $v;
    }

    static function listarCentro() {
        $v = \DB::table('centros')
                ->select(
                        'centros.cod AS cod', 'centros.nombre AS nombre', 'centros.localidad AS localidad'
                )
                ->get();
        return $v;
    }

    static function obtenerAlumnosTutor($curso) {
        $v = \DB::table('matriculados')
                ->where('matriculados.cursos_id_curso', $curso)
                ->select(
                        'matriculados.usuarios_dni AS dni'
                )
                ->get();
        return $v;
    }

    static function obtenerAlumnosTutorMemoria($curso) {
        $sql = "select concat(usuarios.apellidos,', ',usuarios.nombre) as alumno, 
                usuarios.email as email,
                usuarios.movil as movil,
                empresas.nombre as nombre_empresa,
                case when empresas.nueva = 0 THEN 'NO' ELSE 'SI' END as nueva,
                responsables.nombre as nombre_responsable,
                empresas.direccion as direccion_empresa,
                empresas.localidad as localidad_empresa,
                practicas.fecha_inicio as fecha_inicio,
                practicas.fecha_fin as fecha_fin,
                empresas.horario as horario,
                'NO/SI/NO EMITE' as gastos,
                'SI/NO' as apto

                from matriculados, usuarios, practicas, empresas, responsables
                where  matriculados.usuarios_dni = usuarios.dni
                and usuarios.dni = practicas.usuarios_dni
                and practicas.empresas_id = empresas.id
                and practicas.responsables_id = responsables.id
                and matriculados.cursos_id_curso = '" . $curso . "';";

        $alumnos_memoria = \DB::select($sql);

        return $alumnos_memoria;
    }

    static function obtenerIdUltimoTransporteIngresado() {
        $colectivo = colectivo::all()->last();
        if ($colectivo != null) {
            $idUltimoColectivo = $colectivo->id;
        } else {
            $idUltimoColectivo = -1;
        }

        return $idUltimoColectivo;
    }

    static function insertarAlumnoTablaMatriculados($dni, $ciclo) {
//        $p = new matricula;
//        $p->idmatriculados = 0;
//        $p->usuarios_dni = $dni;
//        $p->cursos_id_curso = $ciclo;
        try {
            \DB::insert('insert into matriculados (usuarios_dni, cursos_id_curso) values (?,?)', [$dni, $ciclo]);
//            $p->save(); //aqui se hace la insercion   
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Insertado con exito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } catch (\Exception $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al inertar usuario.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        }
    }

    static function insertarTutor($cursos_id_cursos, $usuarios_dni) {
        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        try {
            $t = new tutor;
            $t->cursos_id_curso = $cursos_id_cursos;
            $t->usuarios_dni = $usuarios_dni;
            $t->created_at = $updated_at;
            $t->updated_at = $updated_at;
            $t->save(); //aqui se hace la insercion   
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

    static function obtenerCicloTutor($dni) {
        $ciclo = tutor::where('usuarios_dni', $dni)->select('cursos_id_curso')->first();

        return $ciclo;
    }

}
