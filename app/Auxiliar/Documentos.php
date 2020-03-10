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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require "../vendor/autoload.php";

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
        $document->setValue('DOMICILIO', ($data['domicilio']));
        $document->setValue('CANTIDAD', ($data['cantidad']));
        $document->setValue('DIRECTOR', ($data['director']));
        $document->setValue('DIA', ($data['dia']));
        $document->setValue('MES', ($data['mes']));
        $document->setValue('ANO', ($data['ano']));
        $document->setValue('EMPRESA', ($data['empresa']));
        $document->setValue('LOCALIDAD_EMPRESA', ($data['localidad_empresa']));

        $name = 'Recibi_' . "$dniAlumno" . "_" . $dia . "-" . $mes . "-" . $ano . '.docx';
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

    static function GenerarRecibiTodosAlumnos($dniAlumno) {
        ob_start();

        $centro = Conexion::listarCentro();
        $al = Conexion::listarAlumnoMatriculado($dniAlumno);
        $prac = Conexion::listarPracticasAlumno($dniAlumno);
        $gas = Conexion::listarGastosAlumno($dniAlumno);

        $nombre = "";
        $apellidos = "";
        $domicilio = "";
        $nombre_empresa = "";
        $localidad_empresa = "";
        $total_gasto_alumno = "";

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
            'periodo' => "",
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
        $document->setValue('DOMICILIO', ($data['domicilio']));
        $document->setValue('CANTIDAD', ($data['cantidad']));
        $document->setValue('DIRECTOR', ($data['director']));
        $document->setValue('DIA', ($data['dia']));
        $document->setValue('MES', ($data['mes']));
        $document->setValue('ANO', ($data['ano']));
        $document->setValue('EMPRESA', ($data['empresa']));
        $document->setValue('LOCALIDAD_EMPRESA', ($data['localidad_empresa']));

        $name = '/Recibi_' . "$dniAlumno" . "_" . $dia . "-" . $mes . "-" . $ano . '.docx';
        $document->saveAs(__DIR__ . $name);
//        rename($name, "{$name}");

        $lista_documentos = [
            "path_archivo" => __DIR__ . "{$name}",
            "nombre_archivo" => "{$name}",
        ];
        $headers = array(
            //'Content-Type: application/msword',
            'Content-Type: vnd.openxmlformats-officedocument.wordprocessingml.document'
        );
        ob_end_clean();
        return $lista_documentos;
    }

    static function GenerarRecibiTodosAlumnosDUAL($dniAlumno) {
        ob_start();

        $centro = Conexion::listarCentro();
        $al = Conexion::listarAlumnoMatriculado($dniAlumno);
        $prac = Conexion::listarPracticasAlumno($dniAlumno);
        $gas = Conexion::listarGastosAlumno($dniAlumno);

        $nombre = "";
        $apellidos = "";
        $domicilio = "";
        $domicilio_empresa = "";
        $nombre_empresa = "";
        $localidad_empresa = "";
        $total_gasto_alumno = "";

        $tutor = session()->get('usu');

        foreach ($centro as $value) {
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
            $domicilio_empresa = $value->direccion;
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
            'alumno' => $nombreAlumno,
            'tutor' => $tutor,
            'familia' => $familia,
            'ciclo' => $ciclo,
            'periodo' => "",
            'horas' => $hora,
            'domicilio' => $dom,
            'cantidad' => $cantidad,
            'director' => $director,
            'dia' => $dia,
            'mes' => $mes,
            'ano' => $ano,
            'empresa' => $empresa,
            'domicilio_empresa' => $domicilio_empresa,
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
        $document->setValue('DOM_EMPRESA', ($data['domicilio_empresa']));
        $document->setValue('LOC_CENTRO', ($data['localidad_centro']));
        $document->setValue('COD', ("CLM"));
        $document->setValue('ALUMNO', ($data['alumno']));
        $document->setValue('TUTOR', ($data['tutor']));
        $document->setValue('FAMILIA', ($data['familia']));
        $document->setValue('CICLO', ($data['ciclo']));
        $document->setValue('PERIODO', ($data['periodo']));
        $document->setValue('HORAS', ($data['horas']));
        $document->setValue('DOMICILIO', ($data['domicilio']));
        $document->setValue('CANTIDAD', ($data['cantidad']));
        $document->setValue('DIRECTOR', ($data['director']));
        $document->setValue('DIA', ($data['dia']));
        $document->setValue('MES', ($data['mes']));
        $document->setValue('ANO', ($data['ano']));
        $document->setValue('EMPRESA', ($data['empresa']));
        $document->setValue('LOC_EMPRESA', ($data['localidad_empresa']));
        $document->setValue('MODALIDAD', (""));
        $document->setValue('DURACION', (""));
        $document->setValue('CUR_ACA_INI', (""));
        $document->setValue('CUR_ACA_FIN', (""));

        $name = '/Recibi_DUAL_' . "$dniAlumno" . "_" . $dia . "-" . $mes . "-" . $ano . '.docx';
        $document->saveAs(__DIR__ . $name);
//        rename($name, "{$name}");

        $lista_documentos = [
            "path_archivo" => __DIR__ . "{$name}",
            "nombre_archivo" => "{$name}",
        ];

        $headers = array(
            //'Content-Type: application/msword',
            'Content-Type: vnd.openxmlformats-officedocument.wordprocessingml.document'
        );
        ob_end_clean();
        return $lista_documentos;
    }

    static function GenerarRecibiDUAL($dniAlumno, $modalidad, $duracion, $cod_proyecto, $inicio, $final) {

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
            'inicio' => $inicio,
            'fin' => $final,
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
        $document->setValue('DOM_EMPRESA', ($data['domicilio']));
        $document->setValue('CANTIDAD', ($data['cantidad']));
        $document->setValue('DIRECTOR', ($data['director']));
        $document->setValue('DIA', ($data['dia']));
        $document->setValue('MES', ($data['mes']));
        $document->setValue('ANO', ($data['ano']));
        $document->setValue('EMPRESA', ($data['empresa']));
        $document->setValue('LOC_EMPRESA', ($data['localidad_empresa']));
        $document->setValue('MODALIDAD', ($data['modalidad']));
        $document->setValue('DURACION', ($data['duracion']));
        $document->setValue('CUR_ACA_INI', ($data['inicio']));
        $document->setValue('CUR_ACA_FIN', ($data['fin']));



        $name = 'Recibi_DUAL_' . "$dniAlumno" . "_" . $dia . "-" . $mes . "-" . $ano . '.docx';
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

    static function GenerarMemoriaAlumnos($alumnos_memoria, $curso, $anio) {

        foreach ($anio as $value) {
            $anyo = $value->ano_academico;
        }

        Documentos::GenerarExcel($alumnos_memoria, $curso, $anyo);
    }

    static function GenerarGastosAlumnos($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director) {

        foreach ($datos_director as $value) {
            $nombre_director = $value->nombre_director;
        }

        foreach ($datos_tutor as $value) {
            $nombre_tutor = $value->nombre_tutor;
            $email_tutor = $value->email;
        }

        foreach ($datos_centro as $value) {
            $cod_centro = $value->cod;
            $nombre_centro = $value->nombre;
            $localidad_centro = $value->localidad;
        }

        foreach ($datos_ciclo as $value) {
            $descripcion_ciclo = $value->descripcion;
            $horas = $value->horas;
        }

        Documentos::GenerarExcelGastos($alumnos_gastos, $curso, $fecha_actual, $cod_centro, $nombre_centro, $localidad_centro, $descripcion_ciclo, $nombre_tutor, $horas, $email_tutor, $nombre_director);
    }

    static function GenerarGastosAlumnosDUAL($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director) {

        foreach ($datos_director as $value) {
            $nombre_director = $value->nombre_director;
        }

        foreach ($datos_tutor as $value) {
            $nombre_tutor = $value->nombre_tutor;
            $email_tutor = $value->email;
        }

        foreach ($datos_centro as $value) {
            $cod_centro = $value->cod;
            $nombre_centro = $value->nombre;
            $localidad_centro = $value->localidad;
        }

        foreach ($datos_ciclo as $value) {
            $descripcion_ciclo = $value->descripcion;
            $horas = $value->horas;
        }

        Documentos::GenerarExcelGastosDUAL($alumnos_gastos, $curso, $fecha_actual, $cod_centro, $nombre_centro, $localidad_centro, $descripcion_ciclo, $nombre_tutor, $horas, $email_tutor, $nombre_director);
    }

    static function GenerarExcelGastosDUAL($coleccion, $curso, $fecha_actual, $cod_centro, $nombre_centro, $localidad_centro, $descripcion_ciclo, $nombre_tutor, $horas, $email_tutor, $nombre_director) {
        $path = '../documentacion/plantillas/gastos/Anexo XI-Bis Gastos Alumnos FP DUAL.xlsx';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        $reader->load($path);
        $spreadsheet = $reader->load($path);
        $spreadsheet->getActiveSheet()->setCellValue('B1', $nombre_centro);
        $spreadsheet->getActiveSheet()->setCellValue('B2', $nombre_tutor);
        $spreadsheet->getActiveSheet()->setCellValue('B3', $descripcion_ciclo);
        $spreadsheet->getActiveSheet()->setCellValue('H30', $nombre_tutor);
        $spreadsheet->getActiveSheet()->setCellValue('E30', $nombre_director);
        $spreadsheet->getActiveSheet()->setCellValue('K2', $fecha_actual);
        $spreadsheet->getActiveSheet()->setCellValue('F1', $localidad_centro);
        $spreadsheet->getActiveSheet()->setCellValue('J1', $cod_centro);
        $spreadsheet->getActiveSheet()->setCellValue('J3', $horas);
        $row = 8;
        $indice = 1;

        foreach ($coleccion as $value) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $value->nombre_completo);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value->importe_billete_colectivo);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value->n_dias);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value->kms);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value->numero_dias);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $value->importe_gastos_kilometraje);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $value->otros_gastos_2);
            $row += 1;
            $indice += 1;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save("Anexo XI-Bis Gastos Alumnos FP DUAL_" . $curso . ".xlsx");

        $filename = "Anexo XI-Bis Gastos Alumnos FP DUAL_" . $curso . ".xlsx";
        header('Content-disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit();
    }

    static function GenerarExcelGastos($coleccion, $curso, $fecha_actual, $cod_centro, $nombre_centro, $localidad_centro, $descripcion_ciclo, $nombre_tutor, $horas, $email_tutor, $nombre_director) {
        $path = '../documentacion/plantillas/gastos/Anexo 6-Gastos_FCT.xlsx';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        $reader->load($path);
        $spreadsheet = $reader->load($path);
        $spreadsheet->getActiveSheet()->setCellValue('B1', $nombre_centro);
        $spreadsheet->getActiveSheet()->setCellValue('B2', $nombre_tutor);
        $spreadsheet->getActiveSheet()->setCellValue('I26', $nombre_tutor);
        $spreadsheet->getActiveSheet()->setCellValue('E26', $nombre_director);
        $spreadsheet->getActiveSheet()->setCellValue('B3', $descripcion_ciclo);
        $spreadsheet->getActiveSheet()->setCellValue('K2', $fecha_actual);
        $spreadsheet->getActiveSheet()->setCellValue('F1', $localidad_centro);
        $spreadsheet->getActiveSheet()->setCellValue('J1', $cod_centro);
        $spreadsheet->getActiveSheet()->setCellValue('J3', $horas);
        $spreadsheet->getActiveSheet()->setCellValue('D3', $email_tutor);
        $row = 8;
        $indice = 1;

        foreach ($coleccion as $value) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $value->nombre_completo);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value->importe_billete_colectivo);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value->n_dias);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value->kms);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value->numero_dias);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $value->importe_gastos_kilometraje);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $value->otros_gastos_2);
            $row += 1;
            $indice += 1;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save("Anexo 6-Gastos_FCT_" . $curso . ".xlsx");

        $filename = "Anexo 6-Gastos_FCT_" . $curso . ".xlsx";
        header('Content-disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit();
    }

    static function GenerarExcel($coleccion, $curso, $anio) {
        $path = '../documentacion/plantillas/memoria alumno/MD750601 Memoria Final.xlsx';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        $reader->load($path);
        $spreadsheet = $reader->load($path);
        $spreadsheet->getActiveSheet()->setCellValue('C2', $curso);
        $spreadsheet->getActiveSheet()->setCellValue('C3', $anio);
        $row = 6;
        $indice = 1;

        foreach ($coleccion as $value) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $indice);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $value->alumno);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $value->email);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $value->movil);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value->nombre_empresa);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value->nueva);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value->nombre_responsable);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value->direccion_empresa);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $value->localidad_empresa);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $value->fecha_inicio);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $value->fecha_fin);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $value->horario);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $value->gastos);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $row, $value->apto);
            $row += 1;
            $indice += 1;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save("MD750601 Memoria Final_" . $curso . ".xlsx");

        $filename = "MD750601 Memoria Final_" . $curso . ".xlsx";
        header('Content-disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit();
    }

    public static function generarArchivoZIPDUAL($lista_documentos, $curso) {
        $archive_file_name = storage_path() . '/recibis_DUAL' . $curso . '.zip'; // Name of our archive to download

        $zip = new \ZipArchive();
        if ($zip->open($archive_file_name, \ZipArchive::CREATE) !== TRUE) {
            exit("No se puede abrir el archivo <$archive_file_name>\n");
        }
        foreach ($lista_documentos as $value) {
            $zip->addFile($value["path_archivo"], $value["nombre_archivo"]);
        }
        if ($zip->close() === false) {
            exit("Error creando el archivo ZIP: " . $archive_file_name);
        }

        if (file_exists($archive_file_name)) {
            header("Content-Description: File Transfer");
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=" . $archive_file_name . "");
            header("Pragma: no-cache");
            header("Expires: 0");
            return response(readfile($archive_file_name));
            ob_clean();
            flush();
            exit;
        } else {
            exit("No encuentro el archivo zip para descargar");
        }
    }

    public static function generarArchivoZIP($lista_documentos, $curso) {
        $archive_file_name = storage_path() . '/recibis_' . $curso . '.zip'; // Name of our archive to download

        $zip = new \ZipArchive();
        if ($zip->open($archive_file_name, \ZipArchive::CREATE) !== TRUE) {
            exit("No se puede abrir el archivo <$archive_file_name>\n");
        }
        foreach ($lista_documentos as $value) {
            $zip->addFile($value["path_archivo"], $value["nombre_archivo"]);
        }
        if ($zip->close() === false) {
            exit("Error creando el archivo ZIP: " . $archive_file_name);
        }

        if (file_exists($archive_file_name)) {
            header("Content-Description: File Transfer");
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=" . $archive_file_name . "");
            header("Pragma: no-cache");
            header("Expires: 0");
            return response(readfile($archive_file_name));
            ob_clean();
            flush();
            exit;
        } else {
            exit("No encuentro el archivo zip para descargar");
        }
    }

}
