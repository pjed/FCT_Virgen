<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar\Conexion;

class controladorAdmin extends Controller {

    public function gestionarCursos(Request $req) {
        $id = $req->get('id');
        if (isset($_REQUEST['aniadir'])) {
            $descripcion = $req->get('descripcion');
            $anioAcademico = $req->get('anioAcademico');
            $familia = $req->get('familia');
            $horas = $req->get('horas');
            Conexion::insertarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
        }
        if (isset($_REQUEST['editar'])) {
            $descripcion = $req->get('descripcion');
            $anioAcademico = $req->get('anioAcademico');
            $familia = $req->get('familia');
            $horas = $req->get('horas');

            Conexion::ModificarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
        }

        $l = Conexion::listaCursosPagination();
        return view('admin/gestionarCursos', ['l1' => $l]);
    }

    /**
     * metodo para recoger los datos que se necesitan mostrar en la vista consultar gastos
     * @return type
     */
    public function enviarConsultarGastoAlumno() {
        $dniAlumno = session()->get('dniAlumno');
        $desplazamiento = session()->get('desplazamiento');
        $tipo = session()->get('tipo');
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
            'l1' => null,
            'l2' => null,
            'gc' => $gc,
            'gtp' => $gtp,
            'gtc' => $gtc,
        ];
        return $datos;
    }

    public function consultarGastoAlumno(Request $req) {
        //saca los alumnos de un curso
        if (isset($_REQUEST['buscar'])) {

//            si ese usuario no tiene ningun gasto que salga algo

            $ciclo = $req->get('ciclo');
            $l2 = Conexion::listarAlumnosCurso($ciclo);
            $datos = [
                'l1' => null,
                'l2' => $l2,
                'gc' => null,
                'gtp' => null,
                'gtc' => null,
            ];
            return view('admin/consultarGastos', $datos);
        }
        //saca los gastos de un alumno
        if (isset($_REQUEST['buscar1'])) {

//            si ese usuario no tiene ningun gasto que salga algo

            $dniAlumno = $req->get('dniAlumno');
            $gt = Conexion::listarGastosTransportes($dniAlumno);

            foreach ($gt as $key) {
                $desplazamiento = $key->desplazamiento;
                $tipo = $key->tipo;
            }

            session()->put('desplazamiento', $desplazamiento);
            session()->put('tipo', $tipo);
            session()->put('dniAlumno', $dniAlumno);
        }
//            editar y borrar comida
        if (isset($_REQUEST['editar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $fecha = $req->get('fecha');
            $importe = $req->get('importe');
            $foto = $req->get('foto');
            Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
        }
        if (isset($_REQUEST['eliminar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            Conexion::borrarGastoComida($id, $idGasto); //hay que mirarlo
        }
//            editar y borrar transporte propio
        if (isset($_REQUEST['editarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $n_diasP = $req->get('n_diasP');
            $kms = $req->get('kms');
            $precio = $req->get('precio');
            Conexion::ModificarGastoTransportePropio($id, $n_diasP, $precio, $kms);
        }
        if (isset($_REQUEST['eliminarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            Conexion::borrarGastoTransportePropio($id, $idTransporte); //hay que mirarlo
        }
//            editar y borrar transporte colectivo
        if (isset($_REQUEST['editarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $n_diasC = $req->get('n_diasC');
            $precio = $req->get('precio');
            $foto = $req->get('foto');
            Conexion::ModificarGastoTransporteColectivo($id, $n_diasP, $precio, $foto);
        }
        if (isset($_REQUEST['eliminarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte); //hay que mirarlo
        }
        $datos = $this->enviarConsultarGastoAlumno();
        return view('admin/consultarGastos', $datos);
    }

    public function gestionarUsuarios(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $tel = $req->get('telefono');
            $movil = $req->get('movil');
            $domicilio = $req->get('domicilio');

            $rol_id = $req->get('selectRol');

            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil);
            Conexion::ModificarRol($dni, $rol_id);

            return view('admin/gestionarUsuarios');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarAlumnos');
        }
    }

    public function gestionarAlumnos(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $iban = $req->get('iban');

            Conexion::actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban);

            return view('admin/gestionarAlumnos');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarAlumnos');
        }
    }

    public function gestionarTutores(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $ciclo = $req->get('selectCiclo');

            Conexion::actualizarDatosTutor($dni, $nombre, $apellidos, $email, $telefono, $ciclo);

            return view('admin/gestionarTutores');
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');

            Conexion::borrarUsuario($dni);
            Conexion::borrarTutor($dni);
            Conexion::borrarUsuarioTablaRoles($dni);

            return view('admin/gestionarTutores');
        }
    }

    public function exportarDocumentos(Request $req) {
        $familia = $req->get('familiaProfesional');
        $idCurso = $req->get('ciclo');
        if (isset($_REQUEST['recibiFPdual'])) {
            
        }

        if (isset($_REQUEST['recibiFCT'])) {
            
        }

        if (isset($_REQUEST['memoriaAlumnos'])) {
            
        }
        if (isset($_REQUEST['gastosFCT'])) {
            
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            
        }
    }

    public function perfil(Request $req) {
        $domicilio = $req->get('domicilio');
        $pass = $req->get('pass');
        $telefono = $req->get('telefono');
        $movil = $req->get('movil');

        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');
        $usuario = session()->get('usu');
        $nombre = null;
        $apellidos = null;
        $email = null;
        $dni = null;

        foreach ($usuario as $value) {
            $dni = $value['dni'];
            $nombre = $value['nombre'];
            $apellidos = $value['apellidos'];
            $email = $value['email'];
        }

        Conexion::actualizarDatosAdminTutor($dni, $nombre, $apellidos, $domicilio, $email, $pass, $telefono, $movil, $updated_at);

        $usu = Conexion::existeUsuario($email, $pass);

        session()->put('usu',$usu);

        return view('admin/perfilAdmin');
    }
}
