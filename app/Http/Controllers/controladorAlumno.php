<?php

namespace App\Http\Controllers;

use App\Auxiliar\Conexion;
use Illuminate\Http\Request;

class controladorAlumno extends Controller {

    /**
     * buscarGastoAlumnoComida y mostrarlas en la tabla 
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function buscarGastoAlumnoComida(Request $req) {
        $keywords = $req->get('keywords');
        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $l = Conexion::buscarGastoAlumnoComida($keywords, $dniAlumno);
        if ($l == null) {
            $gastosAlumno = Conexion::listarGastosComidasPagination($dniAlumno);
            $datos = ['buscarGAC' => null,
                'gastosAlumno' => $gastosAlumno];
        } else {
            $datos = ['buscarGAC' => $l];
        }
        return view('alumno/gestionarGastosComida', $datos);
    }

    /**
     * Crear gasto de comida
     * @author Manu
     * @param Request $req
     * @return type
     */
    public function crearGastoComida(Request $req) {
        //ingresar el gasto de comida en la tabla comidas
        $idComida = Conexion::obtenerIdUltimaComidaIngresada() + 1;
        $fecha = $req->get('fechaT');
        $importe = $req->get('importeT');
        $desplazamiento = $req->get('desplazado');
        $fot = $req->file('fotoTicket');
        $foto = "";

        if ($desplazamiento == null) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Debes indicar si te has desplazado o no.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
        } else {
            if ($fot != null) {
                $foto = $fot->move('imagenes_gastos/comida', $idComida);
            } else {
                $foto = 'images/ticket.png';
            }

            Conexion::insertarGastoComida($importe, $fecha, $foto);

            //ingresar el gasto de comida en la tabla de gastos
            $usuario = session()->get('usu');
            foreach ($usuario as $u) {
                $usuarios_dni = $u['dni'];
            }

            $comidas_id = Conexion::obtenerIdComidaIngresada();
            $transporte_id = null;
            $tipo = 0;

            Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $usuarios_dni, $comidas_id, $transporte_id);
        }

        $usuario = session()->get('usu');
        foreach ($usuario as $u) {
            $usuarios_dni = $u['dni'];
        }
        $gastoTotal = Conexion::obtenerTotalGastosAlumnoParticular($usuarios_dni);
        Conexion::ModificarPracticaGastoTotal($usuarios_dni, $gastoTotal);

        return view('alumno/crearGastoComida');
    }

    /**
     * Crear gasto transpote
     * @author Manu
     * @param Request $req
     * @return type
     */
    public function crearGastoTransporte(Request $req) {
        //si el transporte es colectivo        
        if (isset($_REQUEST['guardarC'])) {
            $idColectivo = Conexion::obtenerIdUltimoTransporteIngresado() + 1;
            $importe = $req->get('importeT');
            $localidadC = $req->get('locC');
            $tipo = 1;
            $fot = $req->file('fotoTicket');
            $foto = "";

            if ($fot != null) {
                $foto = $fot->move('imagenes_gastos/transporte', $idColectivo);
            } else {
                $foto = 'images/ticket.png';
            }
            Conexion::insertarTransporteColectivo($tipo, $localidadC, $foto, $importe);

            //ingresar el gasto de transporte colectivo en la tabla de gastos
            $usuario = session()->get('usu');
            foreach ($usuario as $u) {
                $usuarios_dni = $u['dni'];
            }

            $transporte_id = Conexion::obtenerIdTransporteIngresado();

            $desplazamiento = 1;
            $comidas_id = null;

            Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $usuarios_dni, $comidas_id, $transporte_id);
        }

        //si el transporte es propio
        if (isset($_REQUEST['guardarP'])) {
            $kms = $req->get('kms');
            $precio = $req->get('precioP');
            $localidadP = $req->get('locP');
            $importeTotal = $precio * $kms;

            $tipo = 0;

            Conexion::insertarTransportePropio($tipo, $localidadP, $kms, $importeTotal);

            //ingresar el gasto de transporte propio en la tabla de gastos
            $usuario = session()->get('usu');
            foreach ($usuario as $u) {
                $usuarios_dni = $u['dni'];
            }

            $transporte_id = Conexion::obtenerIdTransporteIngresado();


            $desplazamiento = 1;
            $tipo = 1;
            $comidas_id = null;

            Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $usuarios_dni, $comidas_id, $transporte_id);
        }

        $usuario = session()->get('usu');
        foreach ($usuario as $u) {
            $usuarios_dni = $u['dni'];
        }
        $gastoTotal = Conexion::obtenerTotalGastosAlumnoParticular($usuarios_dni);
        Conexion::ModificarPracticaGastoTotal($usuarios_dni, $gastoTotal);

        return view('alumno/crearGastoTransporte');
    }

    /**
     * Gestionar gasto comida
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarGastoComida(Request $req) {
        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $id = $req->get('ID');
        $idGasto = $req->get('idGasto');
        $importe = $req->get('importe');
        if (isset($_REQUEST['editar'])) {
            $fecha = $req->get('fecha');
            $fot = $req->file('foto');

            if ($fot == null) {
                Conexion::ModificarGastoComidaSinFoto($id, $fecha, $importe);
            } else {
                $foto = $fot->move('imagenes_gastos/comida', $id);
                Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
            }
        }
        if (isset($_REQUEST['eliminar'])) {
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoComida($id);
        }

        $gastoTotal = Conexion::obtenerTotalGastosAlumnoParticular($dniAlumno);
        Conexion::ModificarPracticaGastoTotal($dniAlumno, $gastoTotal);

        $gastosAlumno = Conexion::listarGastosComidasPagination($dniAlumno);
        $datos = [
            'buscarGAC' => null,
            'gastosAlumno' => $gastosAlumno
        ];
        return view('alumno/gestionarGastosComida', $datos);
    }

    /**
     * Gestionar Gasto Transporte
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarGastosTransporte(Request $req) {
        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $id = $req->get('ID');
        $idTransporte = $req->get('idTransporte');

        if (isset($_REQUEST['editarP'])) {
            $kms = $req->get('kms');
            $precio = $kms * 0.12;
            Conexion::ModificarGastoTransportePropio($id, $precio, $kms);
        }

        if (isset($_REQUEST['eliminarP'])) {
            Conexion::borrarGastoTransportePropio($id, $idTransporte);
        }

        if (isset($_REQUEST['editarC'])) {
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
            $file = $req->get('fotoUrl');
            $importe = $req->get('precio');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte);
        }
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
            $gastosAlumno = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
        }
        if ($propio == 0) {
            $gastosAlumno1 = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
        }

        $gastoTotal = Conexion::obtenerTotalGastosAlumnoParticular($dniAlumno);
        Conexion::ModificarPracticaGastoTotal($dniAlumno, $gastoTotal);

        $datos = ['gastosAlumno' => $gastosAlumno,
            'gastosAlumno1' => $gastosAlumno1];
        return view('alumno/gestionarGastosTransporte', $datos);
    }

    /**
     * Perfil de alumno
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

        $domicilio = $req->get('domicilio');
        $telefono = $req->get('telefono');
        $movil = $req->get('movil');
        $iban = $req->get('iban');

        $pass = $req->get('pass');
        if ($pass != null) {
            $passHash = hash('sha256', $pass);
            Conexion::ModificarConstrasenia($dni, $passHash, 0); //0->cambiar contraseña al perfil 1-> restablecer contraseña
            $clave = $passHash;
        }
        Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $movil, $iban, 1, 3);

        $usu = Conexion::existeUsuario($email, $clave);

        session()->put('usu', $usu);

        return view('alumno/perfilAlumno', ['usu' => $usu]);
    }

}
