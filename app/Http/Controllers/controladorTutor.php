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

        return view('tutor/consultarGastosAlumno');
    }

    public function consultarGastoCurso(Request $req) {

        return view('tutor/consultarGastosCurso');
    }

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

    public function gestionarEmpresa(Request $req) {
        $dniResponsable = $req->get('dniResponsable');
        $horario = $req->get('horario');
        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarEmpresa();
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarEmpresa($ID);
        }
        return view('tutor/gestionarEmpresa');
    }

    public function gestionarResponsable(Request $req) {
        $id = $req->get('dniResponsable');
        $dniResponsable = $req->get('dniResponsable');
        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarResponsable($id, $dni, $nombre, $apellidos, $email, $tel);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarResponsable($ID);
        }
        return view('tutor/gestionarResponsable');
    }

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
//dd($ID, $CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $apto, $fechaInicio, $fechaFin);
        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarPractica($ID, $CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $apto, $fechaInicio, $fechaFin);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarPractica($ID);
        }
        if (isset($_REQUEST['recibiFCT'])) {
            
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
            
        }

        return view('tutor/gestionarPracticas');
    }

}
