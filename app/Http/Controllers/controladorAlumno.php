<?php

namespace App\Http\Controllers;

use App\Auxiliar\Conexion;
use Illuminate\Http\Request;

class controladorAlumno extends Controller {

    public function crearGastoComida(Request $req) {
        //ingresar el gasto de comida en la tabla comidas
        //$foto = $req->get('fotoTicket');
        $idComida = Conexion::obtenerIdUltimaComidaIngresada() + 1;
        $req->file('fotoTicket')->move('imagenes_gastos/comida', $idComida);
        $foto = 'imagenes_gastos/comida/'. $idComida;
        $fecha = $req->get('fechaT');
        $importe = $req->get('importeT');

        Conexion::insertarGastoComida($importe, $fecha, $foto);

        //ingresar el gasto de comida en la tabla de gastos
        $usuario = session()->get('usu');
        foreach ($usuario as $u) {
            $usuarios_dni = $u['dni'];
        }

        $comidas_id = Conexion::obtenerIdComidaIngresada();
        $transporte_id = 0;
        $desplazamiento = $req->get('desplazado');
        $tipo = 0;

        $gastosAntiguos = Conexion::obtenerTotalGastosAlumno($usuarios_dni);
        $totalGastoAlumno = $gastosAntiguos['total_gasto_alumno'] + $importe;
        //dd($totalGastoAlumno);

        $totalGastoCicloAntiguo = Conexion::obtenerGastosCicloAlumno($usuarios_dni);
        $totalGastoCiclo = 0;
        foreach ($totalGastoCicloAntiguo as $a) {
            $totalGastoCiclo = $totalGastoCiclo + $a->total_gasto_alumno;
        }

        $totalGastoCicloNuevo = $totalGastoCiclo + $importe;

        Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $totalGastoAlumno, $totalGastoCicloNuevo, $usuarios_dni, $comidas_id, $transporte_id);

        Conexion::actualizarTotalGastosAlumno($usuarios_dni, $totalGastoAlumno);

        Conexion::actualizarTotalGastosCiclo($usuarios_dni, $totalGastoCicloNuevo);

        return view('alumno/crearGastoComida');
    }

    public function crearGastoTransporte(Request $req) {

        $tipoTransporte = $req->get('tipoT');

        //si el transporte es colectivo        
        if ($tipoTransporte == "Colectivo") {
            $foto = $req->get('fotoTicket');
            $importe = $req->get('importeT');
            $localidadC = $req->get('locC');
            $numDias = $req->get('diasC');
            $tipo = 1;

            Conexion::insertarTransporteColectivo($tipo, $localidadC, $foto, $numDias, $importe);

            //ingresar el gasto de transporte colectivo en la tabla de gastos
            $usuario = session()->get('usu');
            foreach ($usuario as $u) {
                $usuarios_dni = $u['dni'];
            }

            $transporte_id = Conexion::obtenerIdTransporteIngresado();

            $gastosAntiguos = Conexion::obtenerTotalGastosAlumno($usuarios_dni);
            $totalGastoAlumno = $gastosAntiguos['total_gasto_alumno'] + $importe;

            $totalGastoCicloAntiguo = Conexion::obtenerGastosCicloAlumno($usuarios_dni);
            $totalGastoCiclo = 0;
            foreach ($totalGastoCicloAntiguo as $a) {
                $totalGastoCiclo = $totalGastoCiclo + $a->total_gasto_alumno;
            }

            $totalGastoCicloNuevo = $totalGastoCiclo + $importe;

            $desplazamiento = 1;
            $comidas_id = 0;

            Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $totalGastoAlumno, $totalGastoCicloNuevo, $usuarios_dni, $comidas_id, $transporte_id);

            Conexion::actualizarTotalGastosAlumno($usuarios_dni, $totalGastoAlumno);

            Conexion::actualizarTotalGastosCiclo($usuarios_dni, $totalGastoCicloNuevo);
        }

        //si el transporte es propio
        if ($tipoTransporte == "Propio") {
            $kms = $req->get('kms');
            $n_dias = $req->get('diasP');
            $precio = $req->get('precioP');
            $localidadP = $req->get('locP');

            $tipo = 0;

            Conexion::insertarTransportePropio($tipo, $localidadP, $kms, $n_dias, $precio);

            //ingresar el gasto de transporte propio en la tabla de gastos
            $usuario = session()->get('usu');
            foreach ($usuario as $u) {
                $usuarios_dni = $u['dni'];
            }

            $transporte_id = Conexion::obtenerIdTransporteIngresado();

            $gastosAntiguos = Conexion::obtenerTotalGastosAlumno($usuarios_dni);
            $totalGastoAlumno = $gastosAntiguos['total_gasto_alumno'] + $precio;

            $totalGastoCicloAntiguo = Conexion::obtenerGastosCicloAlumno($usuarios_dni);
            $totalGastoCiclo = 0;
            foreach ($totalGastoCicloAntiguo as $a) {
                $totalGastoCiclo = $totalGastoCiclo + $a->total_gasto_alumno;
            }

            $totalGastoCicloNuevo = $totalGastoCiclo + $precio;

            $desplazamiento = 1;
            $comidas_id = 0;

            Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $totalGastoAlumno, $totalGastoCicloNuevo, $usuarios_dni, $comidas_id, $transporte_id);

            Conexion::actualizarTotalGastosAlumno($usuarios_dni, $totalGastoAlumno);

            Conexion::actualizarTotalGastosCiclo($usuarios_dni, $totalGastoCicloNuevo);
        }

        return view('alumno/crearGastoTransporte');
    }

    public function gestionarGastoComida(Request $req) {
        $id = $req->get('ID');
        $idGasto = $req->get('idGasto');
        if (isset($_REQUEST['editar'])) {
            $fecha = $req->get('fecha');
            $importe = $req->get('importe');
            $foto = $req->get('foto');
            Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
        }
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarGastoComida($id, $idGasto); //hay que mirarlo
        }
        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $gastosAlumno = Conexion::listarGastosComidasPagination($dniAlumno);
        return view('alumno/gestionarGastosComida', ['gastosAlumno' => $gastosAlumno]);
    }

    public function gestionarGastoTransporte(Request $req) {
        $id = $req->get('ID');
        $idTransporte = $req->get('idTransporte');
        if (isset($_REQUEST['editarP'])) {
            $n_diasP = $req->get('n_diasP');
            $kms = $req->get('kms');
            $precio = $req->get('precio');
            Conexion::ModificarGastoTransportePropio($id, $n_diasP, $precio, $kms);
        }
        if (isset($_REQUEST['eliminarP'])) {
            Conexion::borrarGastoTransportePropio($id, $idTransporte); //hay que mirarlo
        }
        if (isset($_REQUEST['editarC'])) {
            $n_diasC = $req->get('n_diasC');
            $precio = $req->get('precio');
            $foto = $req->get('foto');
            Conexion::ModificarGastoTransporteColectivo($id, $n_diasP, $precio, $foto);
        }
        if (isset($_REQUEST['eliminarC'])) {
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte); //hay que mirarlo
        }

        $n = session()->get('usu');
        foreach ($n as $u) {
            $dniAlumno = $u['dni'];
        }
        $gt = Conexion::listarGastosTransportes($dniAlumno);
        foreach ($gt as $key1) {
            $tipo = $key1->tipo;
        }
        $datos = ['tipo' => $tipo,
            'dniAlumno' => $dniAlumno];
        return view('alumno/gestionarGastosTransporte', $datos);
    }

    public function perfil(Request $req) {
        $domicilio = $req->get('domicilio');
        $pass = $req->get('pass');
        $telefono = $req->get('telefono');
        $movil = $req->get('movil');
        $iban = $req->get('iban');

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

        Conexion::actualizarDatosAlumno($dni, $nombre, $apellidos, $domicilio, $email, $pass, $telefono, $movil, $iban, $updated_at);

        $usu = Conexion::existeUsuario($email, $pass);

        session()->put('usu', $usu);

        return view('alumno/perfilAlumno');
    }
}
