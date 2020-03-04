<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar\Conexion;
use App\Auxiliar\Documentos;

class controladorAdmin extends Controller {

    public function gestionarCursos(Request $req) {
        $id = $req->get('id');
        $descripcion = $req->get('descripcion');
        $anioAcademico = $req->get('anioAcademico');
        $familia = $req->get('familia');
        $horas = $req->get('horas');
        if (isset($_REQUEST['aniadir'])) {
            if ($id != null && $descripcion != null && $anioAcademico != null && $familia != null && $horas != null) {
                $val = Conexion::existePractica($id);
                if ($val) {
                    Conexion::insertarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
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
        if (isset($_REQUEST['editar'])) {
            Conexion::ModificarCurso($id, $descripcion, $anioAcademico, $familia, $horas);
        }

        $l = Conexion::listaCursosPagination();
        return view('admin/gestionarCursos', ['l1' => $l]);
    }

    public static function paginacionConsultarGastoAlumno() {
        $gc = null;
        $gtp = null;
        $gtc = null;

        $l1 = Conexion::listaCursos();

        $ciclo = session()->get('ciclo');
        $l2 = Conexion::listarAlumnosCurso($ciclo);

        $dniAlumno = session()->get('dniAlumno');
        $gt = Conexion::listarGastosTransportes($dniAlumno);

        foreach ($gt as $key) {
            if ($key->tipoTransporte == 1) {
                $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
            }
            if ($key->tipoTransporte == 0) {
                $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
            }
        }
        $gc = Conexion::listarGastosComidasPagination($dniAlumno);
        $datos = [
            'l1' => $l1,
            'l2' => $l2,
            'gc' => $gc,
            'gtp' => $gtp,
            'gtc' => $gtc,
        ];
        return $datos;
    }

    public function consultarGastoAlumno(Request $req) {
        //saca los alumnos de un curso
        if (isset($_REQUEST['buscar'])) {
            $l1 = Conexion::listaCursos();
            $ciclo = $req->get('ciclo');
            session()->put('ciclo', $ciclo);

            $l2 = Conexion::listarAlumnosCurso($ciclo);
            $datos = [
                'l1' => $l1,
                'l2' => $l2,
                'gc' => null,
                'gtp' => null,
                'gtc' => null,
            ];
            return view('admin/consultarGastos', $datos);
        }
        //saca los gastos de un alumno
        if (isset($_REQUEST['buscar1'])) {
            $dniAlumno = $req->get('dniAlumno');
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
        $datos = controladorAdmin::paginacionConsultarGastoAlumno();
        return view('admin/consultarGastos', $datos);
    }

    public function tablaConsultarGastosAjax(Request $req) {
        $v = null;

        if (isset($_SESSION['dniAlumno'])) {
            $dniAlumno1 = session()->get('dniAlumno');
        }
        if (isset($_REQUEST['dniAlumno'])) {
            $dniAlumno = $req->get('dniAlumno');
        }
        $gt = Conexion::listarGastosTransportes($dniAlumno);

        foreach ($gt as $key) {
            if ($key->desplazamiento == 1) {
                if ($key->tipoTransporte == 1) {
                    $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
                    if ($gtc != null) {
                        $v = $v . '<!-- Gestionar Gastos Transporte  Colectivo-->
                    <div id="colectivo" class="row justify-content-center">
                        <div class="col-sm col-md">
                            <h2 class="text-center">Consultar Gastos Transporte Colectivo</h2>
                            <div class="table-responsive ">
                                <table class="table table-striped  table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr> 
                                            <th>Donde es</th>
                                            <th>Nº dias</th>                        
                                            <th>Foto</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        foreach ($gtc as $key) {
                            $v = $v . '<form action="consultarGastoAjax" method="POST">
                                            {{ csrf_field() }}
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value="' . $key->idTransporte . '" readonly>
                                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="' . $key->donde . '"/>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="' . $key->idColectivos . '" readonly/>
                                                </td>
                                                <td><input type="number" class="form-control form-control-sm" name="n_diasC" value="' . $key->n_diasC . '"/></td>
                                                <td><input type="text" class="form-control form-control-sm" name="precio" value="' . $key->precio . '"/></td>
                                                <td>
                                                    <a  href="' . $key->foto . '" target="_blank"> <img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/></a>
                                                </td>
                                                <td><button type="submit" id="editar" class="btn-sm" name="editarC"></button></td>
                                                <td><button type="submit" id="eliminar" class="btn-sm" name="eliminarC"></button></td>
                                            </tr>
                                        </form>';
                        }
                        $v = $v . '</tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="row justify-content-center">
                        <div class="col-sm col-md col-lg">
                                {{ $gtc->links()}}
                        </div>
                    </div>';
                    }
                }
                if ($key->tipoTransporte == 0) {
                    $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
                    if ($gtp != null) {
                        $v = $v . 'Gestionar Gastos Transporte  Propio-->
                    <div id="propio" class="row justify-content-center">
                        <div class="col-sm col-md">
                            <h2 class="text-center">Consultar Gastos Transporte Propio</h2>
                            <div class="table-responsive ">
                                <table class="table  table-sm  table-striped  table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>   
                                            <th>Donde es</th>
                                            <th>Nº dias</th>                        
                                            <th>KMS</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        foreach ($gtp as $key) {
                            $v = $v . ' <form action="consultarGastoAjax" method="POST">
                                            {{ csrf_field() }}
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value="' . $key->idTransporte . '" readonly>
                                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="' . $key->donde . '"/>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="' . $key->idPropios . '" readonly/>
                                                </td>
                                                <td><input type="number" class="form-control form-control-sm" name="n_diasP" value="' . $key->n_diasP . '"/></td>
                                                <td><input type="number" class="form-control form-control-sm" name="kms" value="' . $key->kms . '"/></td>
                                                <td><input type="text" class="form-control form-control-sm" name="precio" value=""' . $key->precio . '>"/></td>
                                                <td><button type="submit" id="editar" class="btn-sm" name="editarP"></button></td>
                                                <td><button type="submit" id="eliminar" class="btn-sm" name="eliminarP"></button></td>
                                            </tr>
                                        </form>';
                        }
                        $v = $v . '</tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="row justify-content-center">
                        <div class="col-sm col-md col-lg">
                            {{ $gtp->links()}}
                        </div>
                            </div>';
                    }
                }
            }
        }
        $gc = Conexion::listarGastosComidasPagination($dniAlumno);
        if ($gc != null) {
            $v = $v . '<!-- Gestionar Gastos Comida -->
                <div id="comida" class="row justify-content-center">
                    <div class="col-sm-8 col-md-8">
                        <h2 class="text-center">Consultar Gastos Comida</h2>
                        <div class="table-responsive ">
                            <table class="table table-striped  table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>         
                                        <th>Fecha</th>
                                        <th>Importe</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($gc as $key) {
                $v = $v . '<form action="consultarGastoAjax" method="POST">
                                        {{ csrf_field() }}
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control form-control-sm form-control-md" name ="idGasto" value="' . $key->idGasto . '" readonly>
                                                <input type="text" class="form-control form-control-sm form-control-md" name="fecha" value="' . $key->fecha . '"/>
                                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="' . $key->id . '" readonly/>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm" name="importe" value="' . $key->importe . '"/></td>
                                            <td>
                                                <img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/>
                                            </td>
                                            <td><button type="submit" id="editar" class="btn-sm" name="editar"></button></td>
                                            <td><button type="submit" id="eliminar" class="btn-sm" name="eliminar"></button></td> 
                                        </tr>
                                    </form>';
            }
            $v = $v . '</tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="row justify-content-center">
                    <div class="col-sm col-md col-lg">
                        {{ $gc->links()}}
                    </div>
                </div>';
        }
        echo $v;
    }

    public function consultarGastoAlumnoAjax(Request $req) {
        //saca los gastos de un alumno
        if (isset($_REQUEST['buscar1'])) {
            $dniAlumno = $req->get('dniAlumno');
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
        $datos = controladorAdmin::paginacionConsultarGastoAlumno();
        return view('admin/consultarGastosAjax', $datos);
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

            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');
            $rol_id = $req->get('selectRol');

            if ($rol_id == 1) {

                Conexion::borrarUsuario($dni);
            } else if ($rol_id == 2) {

                $cursoTutor = Conexion::obtenerCicloTutor($dni);

                Conexion::borrarTutor($dni);
//                    Conexion::borrarCurso($cursoTutor);
                Conexion::borrarUsuario($dni);
            } else if ($rol_id == 4) {

                $cursoTutor = Conexion::obtenerCicloTutor($dni);

                Conexion::borrarTutor($dni);
//                        Conexion::borrarCurso($cursoTutor);
                Conexion::borrarUsuario($dni);
            }
        }

        return redirect()->route('gestionarUsuarios');

//        $listaUsuarios = Conexion::listarUsuarios();
//        $listaCiclos = Conexion::listarCiclos();
//        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
//        $datos = [
//            'listaUsuarios' => $listaUsuarios,
//            'listaCiclos' => $listaCiclos,
//            'listaCiclosSinTutor' => $listaCiclosSinTutor
//        ];
//
//        return view('admin/gestionarUsuarios', $datos);
    }

    public function gestionarAlumnos(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $iban = $req->get('iban');

            $now = new \DateTime();
            $updated_at = $now->format('Y-m-d H:i:s');

            Conexion::actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban, $updated_at);

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

            $cursoTutor = Conexion::obtenerCicloTutor($dni);

            Conexion::borrarTutor($dni);
//                        Conexion::borrarCurso($cursoTutor);
            Conexion::borrarUsuario($dni);

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

            $curso = $req->get("ciclo");
            $anio = Conexion::obtenerAnioAcademico();
            $alumnos_memoria = Conexion::obtenerAlumnosTutorMemoria($curso);
            Documentos::GenerarMemoriaAlumnos($alumnos_memoria, $curso, $anio);
        }
        if (isset($_REQUEST['gastosFCT'])) {
            $curso = $req->get("ciclo");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $datos_director = Conexion::obtenerDatosDirector();
            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);

            Documentos::GenerarGastosAlumnos($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            $curso = $req->get("ciclo");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $datos_director = Conexion::obtenerDatosDirector();
            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);

            Documentos::GenerarGastosAlumnosDUAL($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
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

        session()->put('usu', $usu);

        return view('admin/perfilAdmin');
    }

    public function aniadirUsuario(Request $req) {

        $tipoUsuario = $req->get('tipoU');
        $dni = $req->get("dni");
        $nombre = $req->get("nombre");
        $apellidos = $req->get("apellidos");
        $domicilio = $req->get("domicilio");
        $email = $req->get("email");
        $telefono = $req->get("telefono");
        $movil = $req->get("movil");

        if ($tipoUsuario == "Administrador") {
            $iban = "";
            $rol = 1;
            if ($dni != null && $nombre != null && $apellidos != null && $domicilio != null && $email != null && $movil != null) {
                $val = Conexion::existeUsuario_Dni($dni);
                if ($val) {
                    Conexion::insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $iban, $movil, $rol);
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
                    Debes rellenar los campos obligatorios como mínimo (*)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        if ($tipoUsuario == "Tutor") {
            $iban = "";
            $ciclo = $req->get("selectCiclo");
            $rol = 2;

            if ($dni != null && $nombre != null && $apellidos != null && $domicilio != null && $email != null && $movil != null) {
                $val = Conexion::existeUsuario_Dni($dni);
                if ($val) {
                    Conexion::insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $iban, $movil, $rol);
                    Conexion::insertarTutor($ciclo, $dni);
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
                    Debes rellenar los campos obligatorios como mínimo (*)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        if ($tipoUsuario == "Alumno") {
            $iban = $req->get("iban");
            $ciclo = $req->get("selectCiclo");
            $rol = 3;

            if ($dni != null && $nombre != null && $apellidos != null && $domicilio != null && $email != null && $movil != null) {
                $val = Conexion::existeUsuario_Dni($dni);
                if ($val) {
                    Conexion::insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $iban, $movil, $rol);
                    Conexion::insertarAlumnoTablaMatriculados($dni, $ciclo);
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
                    Debes rellenar los campos obligatorios como mínimo (*)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        if ($tipoUsuario == "TutorAdministrador") {
            $iban = "";
            $ciclo = $req->get("selectCiclo");
            $rol = 4;

            if ($dni != null && $nombre != null && $apellidos != null && $domicilio != null && $email != null && $movil != null) {
                $val = Conexion::existeUsuario_Dni($dni);
                if ($val) {
                    Conexion::insertarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $iban, $movil, $rol);
                    Conexion::insertarTutor($ciclo, $dni);
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
                    Debes rellenar los campos obligatorios como mínimo (*)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        return redirect()->route('gestionarUsuarios');

//        $listaUsuarios = Conexion::listarUsuarios();
//        $listaCiclos = Conexion::listarCiclos();
//        $listaCiclosSinTutor = Conexion::listarCiclosSinTutor();
//        $datos = [
//            'listaUsuarios' => $listaUsuarios,
//            'listaCiclos' => $listaCiclos,
//            'listaCiclosSinTutor' => $listaCiclosSinTutor
//        ];
//
//        return view('admin/gestionarUsuarios', $datos);
    }

    public function listarCursosAjax() {
        $v = Conexion::listaCursos();
        $w = '';
        if (isset($_SESSION['ciclo'])) {
            $ciclo = session()->get('ciclo');
        } else {
            $ciclo = null;
        }

        foreach ($v as $value) {
            if ($value->id == $ciclo) {
                $w = $w . '<option value="' . $value->id . '" selected>' . $value->id . '</option>';
            } else {
                $w = $w . '<option value="' . $value->id . '">' . $value->id . '</option>';
            }
        }

        echo $w;
    }

    public function listarAlumnosCursoAjax() {
        $ciclo = $_POST['ciclo'];
        session()->put('ciclo', $ciclo);
        $w = '';
        $v = Conexion:: listarAlumnosCurso($ciclo);

        if (isset($_SESSION['dniAlumno'])) {
            $dniAlumno = session()->get('dniAlumno');
        } else {
            $dniAlumno = null;
        }

        foreach ($v as $value) {
            if ($value->dni == $dniAlumno) {
                $w = $w . '<option value="' . $value->dni . '" selected>' . $value->nombre . ', ' . $value->apellidos . '</option>';
            } else {
                $w = $w . '<option value="' . $value->dni . '">' . $value->nombre . ', ' . $value->apellidos . '</option>';
            }
        }
        echo $w;
    }

}
