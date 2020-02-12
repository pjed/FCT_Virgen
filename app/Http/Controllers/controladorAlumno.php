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

class controladorAlumno extends Controller {

    public function crearGastoComida(Request $req) {
        //ingresar el gasto de comida en la tabla comidas
        $foto = $req->get('fotoTicket');
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
        $totalGastoAlumno = $gastosAntiguos + $importe;

        $totalGastoCicloAntiguo = Conexion::obtenerGastosCicloAlumno($usuarios_dni);
        foreach ($totalGastoCicloAntiguo as $a) {
            $totalGastoCiclo = $a->gasto + $importe;
        }
        //dd($totalGastoCiclo);
        //$totalGastoCiclo = $totalGastoCicloAntiguo + $importe;

        Conexion::ingresarGastoTablaGastos($desplazamiento, $tipo, $totalGastoAlumno, $totalGastoCiclo, $usuarios_dni, $comidas_id, $transporte_id);

        return view('alumno/crearGastoComida');
    }

    public function crearGastoTransporte(Request $req) {

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
        return view('alumno/gestionarGastosComida', ['gastosAlumno'=> $gastosAlumno]);
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
        $datos = ['tipo'=> $tipo,
            'dniAlumno'=> $dniAlumno];
        return view('alumno/gestionarGastosTransporte', $datos);
    }

    public function perfil(Request $req) {

        return view('alumno/perfilAlumno');
    }

}
