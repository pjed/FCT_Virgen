<?php

namespace App\Auxiliar;

use Illuminate\Http\Request;

use App\Modals\matricula;
use App\Modals\centro;
use App\Modals\comida;
use App\Modals\curso;
use App\Modals\empresa;
use App\Modals\gasto;
use App\Modals\practica;
use App\Modals\propio;
use App\Modals\responsable;
use App\Modals\transporte;
use App\Modals\usuario;
use App\Modals\usuarios_rol;
use App\Modals\colectivo;
use App\Modals\tutor;
use Response;

/**
 * Description of Documentos
 *
 * @author daw207
 */
class Documentos {

    static function GenerarRecibi($dniAlumno, $periodo) {
        
            $centro = Conexion::listarCentro();
            $al = Conexion::listarAlumnoMatriculado($dniAlumno);
            $prac = Conexion::listarPracticasAlumno($dniAlumno);
            $gas = Conexion::listarGastosAlumno($dniAlumno);

            $nombre = "";
            $apellidos = "";
            $domicilio = "";

            $tutor = session()->get('usu');

            foreach ($centro as $value) {
                $cod_centro = $value->cod;
                $nombre_centro = $value->nombre;
                $localidad_centro = $value->localidad;
            }

            foreach ($tutor as $value) {
                $nombre_tutor = $value["nombre"];
                $apellidos_tutor = $value["apellidos"];
            }

            foreach ($prac as $value) {
                $nombre_empresa = $value->nombre;
                $localidad_empresa = $value->localidad;
            }

            foreach ($al as $value) {
                $nombre = $value->nombre;
                $apellidos = $value->apellidos;
                $domicilio = $value->domicilio;
                $descripcion = $value->descripcion;
                $familia = $value->familia;
                $horas = $value->horas;
            }

            foreach ($gas as $value) {
                $total_gasto_alumno = $value->total_gasto_alumno;
            }

            $codigo = $cod_centro;
            $nombreAlumno = $nombre . " " . $apellidos;
            $tutor = $nombre_tutor . ' ' . $apellidos_tutor;
            $empresa = $nombre_empresa;
            $familia = $familia;
            $ciclo = $descripcion;
            if ($horas !== null) {
                $hora = $horas;
            } else {
                $hora = "0";
            }
            $dom = $domicilio;
            $cantidad = $total_gasto_alumno;
            $director = "Ana Belén Santos Cabañas";

            $dia = date("d");
            $mes = Documentos::getMes(date("m"));
            $ano = date("Y");

            $data = [
                'centro' => $nombre_centro,
                'localidad_empresa' => $localidad_empresa,
                'codigo' => $codigo,
                'alumno' => $nombreAlumno,
                'tutor' => $tutor,
                'familia' => $familia,
                'ciclo' => $ciclo,
                'periodo' => $periodo,
                'horas' => $hora,
                'domicilio' => $dom,
                'cantidad' => $cantidad,
                'director' => $director,
                'dia' => $dia,
                'mes' => $mes,
                'ano' => $ano,
                'empresa' => $empresa,
                'localidad_centro' => $localidad_centro
            ];

            // New Word document
            setlocale(LC_TIME, 'es');
            //return $id;

            echo date('H:i:s'), " Create new PhpWord object", PHP_EOL;
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $path = '../documentacion/plantillas/recibi/anexo5_recib_FCT.docx';
            $document = $phpWord->loadTemplate($path);

            //Mapeo de Variables 
            $document->setValue('CENTRO', ($data['centro']));
            $document->setValue('LOCALIDAD_CENTRO', ($data['localidad_centro']));
            $document->setValue('CODIGO', ($data['codigo']));
            $document->setValue('ALUMNO', ($data['alumno']));
            $document->setValue('TUTOR', ($data['tutor']));
            $document->setValue('FAMILIA', ($data['familia']));
            $document->setValue('CICLO', ($data['ciclo']));
            $document->setValue('PERIODO', ($data['periodo']));
            $document->setValue('HORAS', ($data['horas']));
            $document->setValue('DOM_EMPRESA', ($data['domicilio']));
            $document->setValue('CANTIDAD', ($data['cantidad']));
            $document->setValue('DIRECTOR', ($data['director']));
            $document->setValue('DIA', ($data['dia']));
            $document->setValue('MES', ($data['mes']));
            $document->setValue('ANO', ($data['ano']));
            $document->setValue('EMPRESA', ($data['empresa']));
            $document->setValue('LOCALIDAD_EMPRESA', ($data['localidad_empresa']));

            $name = 'Recibi_' . "$dniAlumno" ."_". $dia."-".$mes."-".$ano . '.docx';
            $document->saveAs($name);
            rename($name, storage_path() . "/documentos/recibi/{$name}");
            $file = storage_path() . "/documentos/recibi/{$name}";

            //$file= storage_path(). "/word/{$name}";

            $headers = array(
                //'Content-Type: application/msword',
                'Content-Type: vnd.openxmlformats-officedocument.wordprocessingml.document'
            );

            $response = Response::download($file, $name, $headers);
            ob_end_clean();
            
            
            return $response;
    }
    
    static function GenerarRecibiDUAL($dniAlumno, $modalidad, $duracion, $cod_proyecto) {
        
            $centro = Conexion::listarCentro();
            $al = Conexion::listarAlumnoMatriculado($dniAlumno);
            $prac = Conexion::listarPracticasAlumno($dniAlumno);
            $gas = Conexion::listarGastosAlumno($dniAlumno);

            $nombre = "";
            $apellidos = "";
            $domicilio = "";

            $tutor = session()->get('usu');

            foreach ($centro as $value) {
                $cod_centro = $value->cod;
                $nombre_centro = $value->nombre;
                $localidad_centro = $value->localidad;
            }

            foreach ($tutor as $value) {
                $nombre_tutor = $value["nombre"];
                $apellidos_tutor = $value["apellidos"];
            }

            foreach ($prac as $value) {
                $nombre_empresa = $value->nombre;
                $localidad_empresa = $value->localidad;
            }

            foreach ($al as $value) {
                $nombre = $value->nombre;
                $apellidos = $value->apellidos;
                $domicilio = $value->domicilio;
                $descripcion = $value->descripcion;
                $familia = $value->familia;
                $horas = $value->horas;
            }

            foreach ($gas as $value) {
                $total_gasto_alumno = $value->total_gasto_alumno;
            }

            $codigo = $cod_centro;
            $nombreAlumno = $nombre . " " . $apellidos;
            $tutor = $nombre_tutor . ' ' . $apellidos_tutor;
            $empresa = $nombre_empresa;
            $familia = $familia;
            $ciclo = $descripcion;
            if ($horas !== null) {
                $hora = $horas;
            } else {
                $hora = "0";
            }
            $dom = $domicilio;
            $cantidad = $total_gasto_alumno;
            $director = "Ana Belén Santos Cabañas";

            $dia = date("d");
            $mes = Documentos::getMes(date("m"));
            $ano = date("Y");

            $data = [
                'centro' => $nombre_centro,
                'cod_proyecto' => $cod_proyecto,
                'localidad_empresa' => $localidad_empresa,
                'codigo' => $codigo,
                'alumno' => $nombreAlumno,
                'tutor' => $tutor,
                'familia' => $familia,
                'ciclo' => $ciclo,
                'horas' => $hora,
                'domicilio' => $dom,
                'cantidad' => $cantidad,
                'director' => $director,
                'modalidad' => $modalidad,
                'duracion' => $duracion,
                'dia' => $dia,
                'mes' => $mes,
                'ano' => $ano,
                'empresa' => $empresa,
                'localidad_centro' => $localidad_centro
            ];

            // New Word document
            setlocale(LC_TIME, 'es');
            //return $id;

            echo date('H:i:s'), " Create new PhpWord object", PHP_EOL;
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $path = '../documentacion/plantillas/recibi/Anexo XV Recibí del alumnadoDUAL.docx';
            $document = $phpWord->loadTemplate($path);

            //Mapeo de Variables 
            $document->setValue('CENTRO', ($data['centro']));
            $document->setValue('LOC_CENTRO', ($data['localidad_centro']));
            $document->setValue('COD', ($data['cod_proyecto']));
            $document->setValue('CODIGO', ($data['codigo']));
            $document->setValue('ALUMNO', ($data['alumno']));
            $document->setValue('TUTOR', ($data['tutor']));
            $document->setValue('FAMILIA', ($data['familia']));
            $document->setValue('CICLO', ($data['ciclo']));
            $document->setValue('HORAS', ($data['horas']));
            $document->setValue('DOMICILIO', ($data['domicilio']));
            $document->setValue('CANTIDAD', ($data['cantidad']));
            $document->setValue('DIRECTOR', ($data['director']));
            $document->setValue('DIA', ($data['dia']));
            $document->setValue('MES', ($data['mes']));
            $document->setValue('ANO', ($data['ano']));
            $document->setValue('EMPRESA', ($data['empresa']));
            $document->setValue('LOC_EMPRESA', ($data['localidad_empresa']));
            $document->setValue('MODALIDAD', ($data['modalidad']));
            $document->setValue('DURACION', ($data['duracion']));

            $name = 'Recibi_' . "$dniAlumno" ."_". $dia."-".$mes."-".$ano . '.docx';
            $document->saveAs($name);
            rename($name, storage_path() . "/documentos/recibi/{$name}");
            $file = storage_path() . "/documentos/recibi/{$name}";

            //$file= storage_path(). "/word/{$name}";

            $headers = array(
                //'Content-Type: application/msword',
                'Content-Type: vnd.openxmlformats-officedocument.wordprocessingml.document'
            );

            $response = Response::download($file, $name, $headers);
            ob_end_clean();
            
            
            return $response;
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
