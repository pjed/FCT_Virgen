<?php

namespace App\Http\Controllers;

use App\Auxiliar\Conexion;
use Illuminate\Http\Request;
use App\Auxiliar\Documentos;

class controladorTutor extends Controller {

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

        session()->put('usu', $usu);
        return view('tutor/perfilTutor');
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
            'gc' => $gc,
            'gtp' => $gtp,
            'gtc' => $gtc,
        ];
        return $datos;
    }

    public function consultarGastoAlumno(Request $req) {
        if (isset($_REQUEST['buscar'])) {
            $desplazamiento = null;
            $tipo = null;

//            si ese usuario no tiene ningun gasto que salga algo

            $dniAlumno = $req->get('dniAlumno');
            session()->put('dniAlumno', $dniAlumno);
            $gt = Conexion::listarGastosTransportes($dniAlumno);

            foreach ($gt as $key) {
                $desplazamiento = $key->desplazamiento;
                $tipo = $key->tipo;
            }

            session()->put('desplazamiento', $desplazamiento);
            session()->put('tipo', $tipo);
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
//            dd($id, $idGasto);
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
            if ($dni != null && $nombre != null && $apellidos != null && $email != null && $tel != null) {
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
                Conexion::insertarPractica($CIF, $dniAlumno, $codProyecto, $dniResponsable, $gasto, $fechaInicio, $fechaFin);
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
            
            return Documentos::GenerarRecibi($dniAlumno);
        }
        if (isset($_REQUEST['recibiFPDUAL'])) {
//            $datos = [
//                'titulo' => 'Styde.net'
//            ];
//            $pdf = \PDF::loadView('documentos.recibi.recibi_dual', $datos)
//                    ->setPaper('a4', 'landscape')
//                    ->save(storage_path('app/public/') . 'archivo.pdf');
//            return $pdf->download('recibi_dual.pdf');
            return view('documentos/recibi/recibi_dual');
        }

        return view('tutor/gestionarPracticas');
    }

    static function getMes($mes) {
        $mesNombre = "";
        switch ($mes) {
            case "01":
                $mesNombre = "Enero";
                break;
            case "02":
                $mesNombre = "Febrero";
                break;
            case "03":
                $mesNombre = "Marzo";
                break;
            case "04":
                $mesNombre = "Abril";
                break;
            case "05":
                $mesNombre = "Mayo";
                break;
            case "06":
                $mesNombre = "Junio";
                break;
            case "07":
                $mesNombre = "Julio";
                break;
            case "08":
                $mesNombre = "Agosto";
                break;
            case "09":
                $mesNombre = "Septiembre";
                break;
            case "10":
                $mesNombre = "Octubre";
                break;
            case "11":
                $mesNombre = "Noviembre";
                break;
            case "12":
                $mesNombre = "Diciembre";
                break;
        }
        return $mesNombre;
    }

}
