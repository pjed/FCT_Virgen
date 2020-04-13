<?php

namespace App\Http\Controllers;

use App\Auxiliar\Conexion;
use Illuminate\Http\Request;
use App\Auxiliar\Documentos;

class controladorTutor extends Controller {

    /**
     * Perfil del tutor
     * @author Pedro (Todo lo demás) y Marina (contraseña)
     * @param Request $req
     * @return type
     */
    public function perfil(Request $req) {
        $usuario = session()->get('usu');
        $clave = null;
        $nombre = null;
        $apellidos = null;
        $email = null;
        $dni = null;
        foreach ($usuario as $value) {
            $dni = $value['dni'];
            $clave = $value['pass'];
            $nombre = $value['nombre'];
            $apellidos = $value['apellidos'];
            $email = $value['email'];
        }


        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');

        $domicilio = $req->get('domicilio');
        $telefono = $req->get('telefono');
        $movil = $req->get('movil');

        $pass = $req->get('pass');
        if ($pass != null) {
            $passHash = hash('sha256', $pass);
            Conexion::ModificarConstrasenia($dni, $passHash);
            $clave = $passHash;
        }
        Conexion::actualizarDatosAdminTutor($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $movil, $updated_at);

        $usu = Conexion::existeUsuario($email, $clave);

        session()->put('usu', $usu);

        return view('tutor/perfilTutor', ['usu' => $usu]);
    }

    /**
     * Metodo para recoger los datos que se necesitan mostrar en la vista consultar gastos
     * @author Pedro
     * @param Request $req
     * @return type
     */
    public static function enviarConsultarGastoAlumno() {
//            si ese usuario no tiene ningun gasto que salga algo
        $gtc = null;
        $gtp = null;
        $gc = null;

        $dniAlumno = session()->get('dniAlumno');
        $l2 = Conexion::listarAlumnoPorTutor();

        $gt = Conexion::listarGastosTransportes($dniAlumno);

        $colectivo = null;
        $propio = null;
        foreach ($gt as $key) {
            if ($key->tipoTransporte == 1) {
                $colectivo = 1;
            }
            if ($key->tipoTransporte == 0) {
                $propio = 0;
            }
        }
        if ($colectivo == 1) {
            $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
        }
        if ($propio == 0) {
            $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
        }

        $gc = Conexion::listarGastosComidasPagination($dniAlumno);
        $datos = [
            'l2' => $l2,
            'gc' => $gc,
            'gtp' => $gtp,
            'gtc' => $gtc
        ];
        return $datos;
    }

    /**
     * Consultar Gasto
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function consultarGastoAlumno(Request $req) {
        if (isset($_REQUEST['buscar'])) {
            $dniAlumno = $req->get('dniAlumno');
            session()->put('dniAlumno', $dniAlumno);
        }
//            editar y borrar comida
        if (isset($_REQUEST['editar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $fecha = $req->get('fecha');
            $importe = $req->get('importe');
            $fot = $req->file('foto');

            if ($fot == null) {
                Conexion::ModificarGastoComidaSinFoto($id, $fecha, $importe);
            } else {
                $foto = $fot->move('imagenes_gastos/comida', $id);
                Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
            }
        }
        if (isset($_REQUEST['eliminar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoComida($id);
        }
//            editar y borrar transporte propio
        if (isset($_REQUEST['editarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $kms = $req->get('kms');
            $precio = $kms * 0.12;
            Conexion::ModificarGastoTransportePropio($id, $precio, $kms);
        }
        if (isset($_REQUEST['eliminarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $importe = $req->get('precio');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoTransportePropio($id, $idTransporte);
        }
//            editar y borrar transporte colectivo
        if (isset($_REQUEST['editarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $precio = $req->get('precio');
            $fot = $req->file('foto');

            if ($fot == null) {
                Conexion::ModificarGastoTransporteColectivoSinFoto($id, $precio);
            } else {
                $foto = $fot->move('imagenes_gastos/transporte', $idTransporte);
                Conexion::ModificarGastoTransporteColectivo($id, $precio, $foto);
            }
        }
        if (isset($_REQUEST['eliminarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $file = $req->get('fotoUrl');
            $importe = $req->get('precio');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte);
        }
        $datos = controladorTutor::enviarConsultarGastoAlumno();
        return view('tutor/consultarGastosAlumno', $datos);
    }

    /**
     * Vista extraerDocT
     * acciones que puedes realizar
     *      gastosFCT
     *      gastosFPDUAL
     *      memoriaAlumnos
     *      recibiFCT
     *      recibiFPDUAL
     * @author Pedro
     * @param Request $req
     * @return type
     */
    public function extraerDocT(Request $req) {
        $id_curso = $req->get('id_curso');
        $dni_tutor = $req->get('dni_tutor');

        if (isset($_REQUEST['recibiFCT'])) {
            $curso = $req->get("id_curso");
            $alumnos_curso = Conexion::obtenerAlumnosTutor($curso);
            $cuantos_alumnos = count($alumnos_curso);

            if ($cuantos_alumnos != 0) {
                foreach ($alumnos_curso as $alumno) {
                    $lista_documentos[] = Documentos::GenerarRecibiTodosAlumnos($alumno->dni);
                }
            } else {
                $lista_documentos = null;
            }

            if ($lista_documentos != null) {
                Documentos::generarArchivoZIP($lista_documentos, $curso);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos de este ciclo con FP DUAL
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
            $curso = $req->get("id_curso");
            $alumnos_curso = Conexion::obtenerAlumnosTutor($curso);

            $alumnos_curso = Conexion::obtenerAlumnosTutor($curso);
            $cuantos_alumnos = count($alumnos_curso);

            if ($cuantos_alumnos != 0) {
                foreach ($alumnos_curso as $alumno) {
                    $lista_documentos[] = Documentos::GenerarRecibiTodosAlumnosDUAL($alumno->dni);
                }
            } else {
                $lista_documentos = null;
            }

            if ($lista_documentos != null) {
                Documentos::generarArchivoZIPDUAL($lista_documentos, $curso);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos de este ciclo con FP DUAL
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['memoriaAlumnos'])) {
            $curso = $req->get("id_curso");
            $anio = Conexion::obtenerAnioAcademico();

            $alumnos_memoria = Conexion::obtenerAlumnosTutorMemoria($curso);
            $cuantos_alumnos_memoria = count($alumnos_memoria);

            if ($cuantos_alumnos_memoria != 0) {
                $alumnos_memoria = Conexion::obtenerAlumnosTutorMemoria($curso);
            } else {
                $alumnos_memoria = null;
            }

            if ($alumnos_memoria != null) {
                Documentos::GenerarMemoriaAlumnos($alumnos_memoria, $curso, $anio);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos en este ciclo
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['gastosFCT'])) {
            $curso = $req->get("id_curso");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $datos_director = Conexion::obtenerDatosDirector();

            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            $cuantos_alumnos_gastos = count($alumnos_gastos);

            if ($cuantos_alumnos_gastos != 0) {
                $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            } else {
                $alumnos_gastos = null;
            }

            if ($alumnos_gastos != null) {
                Documentos::GenerarGastosAlumnos($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No hay alumnos con gastos de FCT en este curso
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            $curso = $req->get("id_curso");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $datos_director = Conexion::obtenerDatosDirector();

            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            $cuantos_alumnos_gastos = count($alumnos_gastos);

            if ($cuantos_alumnos_gastos != 0) {
                $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            } else {
                $alumnos_gastos = null;
            }

            if ($alumnos_gastos != null) {
                Documentos::GenerarGastosAlumnosDUAL($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No hay alumnos con gastos de FCT DUAL en este curso
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        return view('tutor/extraerDocT');
    }

    /**
     * Vista gestionarEmpresa
     * acciones que puedes realizar
     *      añadir responsable
     *      modificar responsable
     *      eliminar responsable
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarEmpresa(Request $req) {
        $id = $req->get('id');
        $CIF = $req->get('CIF');
        $nombreEmpresa = $req->get('nombreEmpresa');
        $dniRepresentante = $req->get('dniRepresentante');
        $nombreRepresentante = $req->get('nombreRepresentante');
        $direccion = $req->get('direccion');
        $localidad = $req->get('localidad');
        $horario = $req->get('horario');
        if ($req->get('nueva') == 'on') {
            $nueva = 1;
        } else {
            $nueva = 0;
        }
        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarEmpresa($id, $CIF, $nombreEmpresa, $dniRepresentante, $nombreRepresentante, $direccion, $localidad, $horario, $nueva);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::ModificarPracticaEmpresa($id);
            Conexion::ModificarResponsableEmpresa($CIF);
            Conexion::borrarEmpresa($id);
        }
        if (isset($_REQUEST['aniadir'])) {
            $nueva = 1;
            if ($CIF != null && $nombreEmpresa != null && $dniRepresentante != null && $nombreRepresentante != null && $direccion != null && $localidad != null && $horario != null) {
                $val = Conexion::existeEmpresa($CIF);
                if ($val) {
                    Conexion::insertarEmpresa($CIF, $nombreEmpresa, $dniRepresentante, $nombreRepresentante, $direccion, $localidad, $horario);
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Ya existe.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Algún campo está vacio.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        return view('tutor/gestionarEmpresa');
    }

    /**
     * Vista gestionarResponsable
     * acciones que puedes realizar
     *      añadir responsable
     *      modificar responsable
     *      eliminar responsable
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarResponsable(Request $req) {
        $id = $req->get('id');
        $dni = $req->get('dni');
        $nombre = $req->get('nombre');
        $apellidos = $req->get('apellido');
        $email = $req->get('email');
        $tel = $req->get('tel');
        $CIF = $req->get('idEmpresa');

        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarResponsable($id, $dni, $nombre, $apellidos, $email, $tel, $CIF);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::ModificarPracticaResponsable($id);
            Conexion::borrarResponsable($id);
        }
        if (isset($_REQUEST['aniadir'])) {
            if ($dni != null && $nombre != null && $apellidos != null && $email != null && $tel != null && $CIF != null) {
                $val = Conexion::existeResponsable($dni);
                if ($val) {
                    Conexion::insertarResponsable($dni, $nombre, $apellidos, $email, $tel, $CIF);
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Ya existe.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Algún campo está vacio.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        return view('tutor/gestionarResponsable');
    }

    /**
     * Vista gestionarPracticas
     * acciones que puedes realizar
     *      añadir responsable
     *      modificar responsable
     *      eliminar responsable
     *      recibiFCT
     *      recibiFPDUAL
     * @author Marina (Todo lo demas) y Pedro (los recibis)
     * @param Request $req
     * @return type
     */
    public function gestionarPracticas(Request $req) {
        $ID = $req->get('idPractica');
        $CIF = $req->get('idEmpresa');
        $dniAlumno = $req->get('dniAlumno');
        $codProyecto = $req->get('codProyecto');
        $dniResponsable = $req->get('idResponsable');
        $gasto = $req->get('gasto');
        if ($req->get('apto') == 'on') {
            $apto = 1;
        } else {
            $apto = 0;
        }
        $fechaInicio = $req->get('fechaInicio');
        $fechaFin = $req->get('fechaFin');

        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarPractica($ID, $CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $apto, $fechaInicio, $fechaFin);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarPractica($ID);
        }
        if (isset($_REQUEST['aniadir'])) {
            if ($CIF != null && $dniAlumno != null && $codProyecto != null && $dniResponsable != null && $gasto != null) {
                $val = Conexion::existePractica($dniAlumno);
                if ($val) {
                    Conexion::insertarPractica($CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $fechaInicio, $fechaFin);
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Ya existe.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Algún campo está vacio.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['recibiFCT'])) {
            $dniAlumno = $req->get('dniAlumno');
            $periodo = $req->get('periodo');

            return Documentos::GenerarRecibi($dniAlumno, $periodo);
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
            $dniAlumno = $req->get('dniAlumno');
            $modalidad = $req->get('modalidad');
            $duracion = $req->get('duracion');
            $cod = $req->get('codigo');
            $inicio = $req->get('inicio');
            $final = $req->get('final');


            $inicioF = date("d-m-Y", strtotime($inicio));
            $finalF = date("d-m-Y", strtotime($final));

            return Documentos::GenerarRecibiDUAL($dniAlumno, $modalidad, $duracion, $cod, $inicioF, $finalF);
        }
        $datos = controladorTutor::datosGestionarPracticas();
        return view('tutor/gestionarPracticas', $datos);
    }

    /**
     * Devuelve las listas necesarias para que funcione gestionar practicas
     * @author Marina
     * @return type
     */
    public static function DatosGestionarPracticas() {
        $lu = Conexion::listarPracticasPagination();
        $l1 = Conexion::listarEmpresas();
        $l2 = Conexion::listarAlumnoPorTutor();
        $l3 = Conexion::listarResponsables();
        $l4 = Conexion::listarAlumnoPorTutorSinPracticas();

        $datos = [
            'lu' => $lu,
            'l1' => $l1,
            'l2' => $l2,
            'l3' => $l3,
            'l4' => $l4
        ];
        return $datos;
    }

    /**
     * Muestra la una practica, metodo hecho para la modal de modificar practicas con ayax
     * @author Marina
     * @param Request $req
     */
    public function buscarPracticaPorIdAjax(Request $req) {
        $idPractica = $req->get('idPractica');
        $v = Conexion::buscarPracticaPorId($idPractica);
        $res = json_encode($v, true);
        echo $res;
    }

    /**
     * Muestra la informacion del empresa necesaria para el modificar practicas con ayax
     * @author Marina
     * @param Request $req
     */
    public function listarEmpresasAjax(Request $req) {
        $v = Conexion::listarEmpresas();
        $res = json_encode($v, true);
        echo $res;
    }

    /**
     * Muestra la informacion del alumno necesaria para el modificar practicas con ayax
     * @author Marina
     */
    public function listarAlumnoPorTutorAjax(Request $req) {
        $v = Conexion::listarAlumnoPorTutor();
        $res = json_encode($v, true);
        echo $res;
    }

    /**
     * Crea los option del select responsable según que empresa se haya seleccionado con anterioridad
     * @author Marina
     * @param Request $req
     */
    public function idResponsableDeUnaEmpresaPracticaAjax(Request $req) {
        $idEmpresa = $req->get('idEmpresa');
        $v = Conexion::listarResponsablesEmpresa($idEmpresa);
        $res = json_encode($v, true);
        echo $res;
    }

}
