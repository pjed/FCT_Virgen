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

class controladorTutor extends Controller
{
    public function perfil(Request $req) {
        
    }
    
    public function consultarGastoAlumno(Request $req) {
        
    }
    public function consultarGastoCurso(Request $req) {
        
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
    }
    public function gestionarEmpresa(Request $req) {
        
    }
    public function gestionarResponsable(Request $req) {
        
    }
    
    public function gestionarPracticas(Request $req) {
        
    }
    
}
