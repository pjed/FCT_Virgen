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

class controladorTutor extends Controller {

    public function perfil(Request $req) {

        return view('tutor/perfilTutor');
    }

    public function consultarGastoAlumno(Request $req) {
        if (isset($_REQUEST['buscar'])) {
            $dniAlumno = $req->get('dniAlumno');
            $gt = Conexion::listarGastosTransportes($dniAlumno);
            
            foreach ($gt as $key) {
                $desplazamiento = $key->desplazamiento;
                $tipo = $key->tipo;
            }
            
            if ($desplazamiento == 1) {
                if ($tipo == 1) {
                    $gtp = null;
                    $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
                } else {
                    $gtc = null;
                    $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
                }
            } else {
                $gtc = null;
                $gtp = null;
            }
            $gc = Conexion::listarGastosComidasPagination($dniAlumno);
            $datos = [
                'gc' => $gc,
                'gtp' => $gtp,
                'gtc' => $gtc,
            ];
        }
        return view('tutor/consultarGastosAlumno', $datos);
    }

    public function consultarGastoCurso(Request $req) {

        return view('tutor/consultarGastosCurso');
    }

    /**
     * Vista extraerDocT
     * acciones que puedes realizar
     *      gastosFCT
     *      gastosFPDUAL
     *      memoriaAlumnos
     *      recibiFCT
     *      recibiFPDUAL
     * @param Request $req
     * @return type
     */
    public function extraerDocT(Request $req) {
        $id_curso = $req->get('id_curso');
        $dni_tutor = $req->get('dni_tutor');
        if (isset($_REQUEST['recibiFCT'])) {
            
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
            
        }
        if (isset($_REQUEST['memoriaAlumnos'])) {
            
        }
        if (isset($_REQUEST['gastosFCT'])) {
            
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            
        }
        return view('tutor/extraerDocT');
    }

    /**
     * Vista gestionarEmpresa
     * acciones que puedes realizar
     *      añadir responsable
     *      modificar responsable
     *      eliminar responsable
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


            return view('tutor/gestionarEmpresa');
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarEmpresa($id);
        }
        if (isset($_REQUEST['aniadir'])) {
            $nueva = 1;
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
        }
        return view('tutor/gestionarEmpresa');
    }

    /**
     * Vista gestionarResponsable
     * acciones que puedes realizar
     *      añadir responsable
     *      modificar responsable
     *      eliminar responsable
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

        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarResponsable($id, $dni, $nombre, $apellidos, $email, $tel);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarResponsable($id);
        }
        if (isset($_REQUEST['aniadir'])) {
            $val = Conexion::existeResponsable($dni);
            if ($val) {
                Conexion::insertarResponsable($dni, $nombre, $apellidos, $email, $tel);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Ya existe.
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
     * @param Request $req
     * @return type
     */
    public function gestionarPracticas(Request $req) {
        $ID = $req->get('ID');
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
            Conexion::insertarPractica($CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $fechaInicio, $fechaFin);
        }
        if (isset($_REQUEST['recibiFCT'])) {
            
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
            
        }

        return view('tutor/gestionarPracticas');
    }

}
