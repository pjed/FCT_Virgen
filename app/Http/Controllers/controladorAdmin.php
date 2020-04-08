<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar\Conexion;
use App\Auxiliar\Documentos;

class controladorAdmin extends Controller {

    /**
     * Método que elimina los archivos .csv del directorio uploads
     * @author Pedro
     * @param Request $req
     */
    public function BorrarArchivosCSV(Request $req) {
        $pathCSV = public_path() . '/uploads';
        $ficherosCSV = scandir($pathCSV, 1);

        if (count($ficherosCSV) != 2) {
            foreach ($ficherosCSV as $file) {
                $pathArchivo = $pathCSV . '/' . $file;
                if (is_file($pathArchivo)) {
                    unlink($pathArchivo); //elimino el fichero
                }
            }

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Archivos CSV eliminados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No hay archivos en el directorio para importar, por favor suba algún archivo CSV
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }
        return view('admin/importarDatos');
    }

    /**
     * Método que lanzar un load data por cada archivo .csv
     * @param type $path
     * @param type $filename
     * @return type
     */
    private function _import_csv($path, $filename) {
        $csv = $path . "/" . $filename;

        $server = "localhost";
        $database = "gestionfct";
        $user = "pedro";
        $password = "Chubaca2019";

        switch ($filename):
            case "datAlumnos.csv":
                $sql = "CREATE TABLE IF NOT EXISTS `gestionfct`.datAlumnos (
                        `ALUMNO` INT(11) NULL DEFAULT NULL,
                        `APELLIDOS` VARCHAR(36) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NOMBRE` VARCHAR(21) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `SEXO` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DNI` VARCHAR(9) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NIE` INT(11) NULL DEFAULT NULL,
                        `FECHA_NACIMIENTO` DATETIME NULL DEFAULT NULL,
                        `LOCALIDAD_NACIMIENTO` VARCHAR(31) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `PROVINCIA_NACIMIENTO` VARCHAR(22) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NOMBRE_CORRESPONDENCIA` VARCHAR(47) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DOMICILIO` VARCHAR(53) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `LOCALIDAD` VARCHAR(40) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `PROVINCIA` VARCHAR(11) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TELEFONO` INT(11) NULL DEFAULT NULL,
                        `MOVIL` INT(11) NULL DEFAULT NULL,
                        `CODIGO_POSTAL` VARCHAR(5) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TUTOR1` VARCHAR(28) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DNI_TUTOR1` VARCHAR(13) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TUTOR2` VARCHAR(32) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DNI_TUTOR2` VARCHAR(13) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `PAIS` VARCHAR(9) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NACIONALIDAD` VARCHAR(9) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `EMAIL_ALUMNO` VARCHAR(40) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `EMAIL_TUTOR2` VARCHAR(36) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `EMAIL_TUTOR1` VARCHAR(34) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TELEFONOTUTOR1` INT(11) NULL DEFAULT NULL,
                        `TELEFONOTUTOR2` INT(11) NULL DEFAULT NULL,
                        `MOVILTUTOR1` INT(11) NULL DEFAULT NULL,
                        `MOVILTUTOR2` VARCHAR(10) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `APELLIDO1` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `APELLIDO2` VARCHAR(18) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TIPODOM` VARCHAR(2) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NTUTOR1` VARCHAR(19) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NTUTOR2` VARCHAR(21) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NSS` INT(11) NULL DEFAULT NULL)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_unicode_ci;";
                \DB::statement($sql);

                $conn = new \PDO("mysql:host=$server;dbname=$database", "$user", "$password", array(
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ));

                $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `datalumnos` CHARACTER SET UTF8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
                        . "LINES TERMINATED BY '\\n' IGNORE 1 LINES (`ALUMNO`, `APELLIDOS`,`NOMBRE`,`SEXO`,`DNI`,`NIE`,`FECHA_NACIMIENTO`,`LOCALIDAD_NACIMIENTO`,`PROVINCIA_NACIMIENTO`,`NOMBRE_CORRESPONDENCIA`,`DOMICILIO`,`LOCALIDAD`,`PROVINCIA`,`TELEFONO`,`MOVIL`,`CODIGO_POSTAL`,`TUTOR1`,`DNI_TUTOR1`,`TUTOR2`,`DNI_TUTOR2`,`PAIS`,`NACIONALIDAD`,`EMAIL_ALUMNO`,`EMAIL_TUTOR2`,`EMAIL_TUTOR1`,`TELEFONOTUTOR1`,`TELEFONOTUTOR2`,`MOVILTUTOR1`,`MOVILTUTOR2`,`APELLIDO1`,`APELLIDO2`,`TIPODOM`,`NTUTOR1`,`NTUTOR2`,`NSS`)", addslashes($csv));
                $conn->exec($query);
                break;

            case "datMaterias.csv":
                $sql = "CREATE TABLE IF NOT EXISTS `gestionfct`.`datmaterias` (
                        `MATERIA` INT(11) NULL DEFAULT NULL,
                        `DESCRIPCION` VARCHAR(110) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `ABREVIATURA` VARCHAR(5) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DEPARTAMENTO` VARCHAR(58) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `CURSO` VARCHAR(84) CHARACTER SET 'utf8' NULL DEFAULT NULL)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_unicode_ci;";
                \DB::statement($sql);

                $conn = new \PDO("mysql:host=$server;dbname=$database", "$user", "$password", array(
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ));

                $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `datmaterias` CHARACTER SET UTF8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
                        . "LINES TERMINATED BY '\\n' IGNORE 1 LINES (`MATERIA`, `DESCRIPCION`,`ABREVIATURA`,`DEPARTAMENTO`,`CURSO`)", addslashes($csv));
                $conn->exec($query);
                break;

            case "datMatriculas.csv":
                $sql = "CREATE TABLE IF NOT EXISTS `gestionfct`.`datmatriculas` (
                        `ALUMNO` INT(11) NULL DEFAULT NULL,
                        `APELLIDOS` VARCHAR(36) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NOMBRE` VARCHAR(21) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `MATRICULA` INT(11) NULL DEFAULT NULL,
                        `ETAPA` INT(11) NULL DEFAULT NULL,
                        `ANNO` INT(11) NULL DEFAULT NULL,
                        `TIPO` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `ESTUDIOS` VARCHAR(84) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `GRUPO` VARCHAR(10) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `REPETIDOR` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `FECHAMATRICULA` DATETIME NULL DEFAULT NULL,
                        `CENTRO` INT(11) NULL DEFAULT NULL,
                        `PROCEDENCIA` INT(11) NULL DEFAULT NULL,
                        `ESTADOMATRICULA` VARCHAR(14) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `FECHARESMATRICULA` DATETIME NULL DEFAULT NULL,
                        `NUM_EXP_CENTRO` INT(11) NULL DEFAULT NULL,
                        `PROGRAMA_2` INT(11) NULL DEFAULT NULL)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_unicode_ci;";
                \DB::statement($sql);

                $conn = new \PDO("mysql:host=$server;dbname=$database", "$user", "$password", array(
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ));

                $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `datmatriculas` CHARACTER SET UTF8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
                        . "LINES TERMINATED BY '\\n' "
                        . "IGNORE 1 LINES (`ALUMNO`, `APELLIDOS`,`NOMBRE`,`MATRICULA`,`ETAPA`,`ANNO`,`TIPO`,`ESTUDIOS`,`GRUPO`,`REPETIDOR`,`FECHAMATRICULA`,`CENTRO`,`PROCEDENCIA`,`ESTADOMATRICULA`,`FECHARESMATRICULA`,`NUM_EXP_CENTRO`,`PROGRAMA_2`)", addslashes($csv));
                $conn->exec($query);
                break;

            case "datProfesores.csv":
                $sql = "CREATE TABLE IF NOT EXISTS `gestionfct`.`datprofesores` (
                        `CODIGO` INT(11) NULL DEFAULT NULL,
                        `APELLIDOS` VARCHAR(22) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NOMBRE` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `NRP` VARCHAR(16) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DNI` VARCHAR(9) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `ABREVIATURA` VARCHAR(5) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `FECHA_NACIMIENTO` DATETIME NULL DEFAULT NULL,
                        `SEXO` VARCHAR(1) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TITULO` VARCHAR(91) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DOMICILIO` VARCHAR(59) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `LOCALIDAD` VARCHAR(24) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `CODIGO_POSTAL` INT(11) NULL DEFAULT NULL,
                        `PROVINCIA` VARCHAR(11) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TELEFONO_RP` INT(11) NULL DEFAULT NULL,
                        `ESPECIALIDAD` VARCHAR(5) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `CUERPO` VARCHAR(6) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `DEPARTAMENTO` VARCHAR(48) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `FECHA_ALTA_CENTRO` DATETIME NULL DEFAULT NULL,
                        `FECHA_BAJA_CENTRO` DATETIME NULL DEFAULT NULL,
                        `EMAIL` VARCHAR(32) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TELEFONO` INT(11) NULL DEFAULT NULL)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_unicode_ci;";
                \DB::statement($sql);

                $conn = new \PDO("mysql:host=$server;dbname=$database", "$user", "$password", array(
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ));

                $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `datprofesores` CHARACTER SET UTF8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
                        . "LINES TERMINATED BY '\\n' "
                        . "IGNORE 1 LINES (`CODIGO`, `APELLIDOS`,`NOMBRE`,"
                        . "`NRP`,`DNI`,`ABREVIATURA`,`FECHA_NACIMIENTO`,"
                        . "`SEXO`,`TITULO`,`DOMICILIO`,`LOCALIDAD`,"
                        . "`CODIGO_POSTAL`,`PROVINCIA`,`TELEFONO_RP`,"
                        . "`ESPECIALIDAD`,`CUERPO`,"
                        . "`DEPARTAMENTO`, `FECHA_ALTA_CENTRO`, "
                        . "`FECHA_BAJA_CENTRO`, `EMAIL`, `TELEFONO`)", addslashes($csv));
                $conn->exec($query);
                break;

            case "datUnidades.csv":
                $sql = "CREATE TABLE IF NOT EXISTS `gestionfct`.`datunidades` (
                        `ANNO` INT(11) NULL DEFAULT NULL,
                        `GRUPO` VARCHAR(10) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `ESTUDIO` VARCHAR(71) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `CURSO` VARCHAR(84) CHARACTER SET 'utf8' NULL DEFAULT NULL,
                        `TUTOR` VARCHAR(34) CHARACTER SET 'utf8' NULL DEFAULT NULL)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_unicode_ci;";
                \DB::statement($sql);

                $conn = new \PDO("mysql:host=$server;dbname=$database", "$user", "$password", array(
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ));

                $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `datunidades` CHARACTER SET UTF8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
                        . "LINES TERMINATED BY '\\n' "
                        . "IGNORE 1 LINES (`ANNO`, `GRUPO`,`ESTUDIO`,`CURSO`,`TUTOR`)", addslashes($csv));
                $conn->exec($query);
                break;

        endswitch;
    }

    /**
     * Método que añade los archivos del csv a la BBDD gestionfct
     * @author Pedro
     * @param Request $req
     */
    public function AddDatosCSVtoBBDD(Request $req) {


        $sql = "/*Sentencia para crear el centro*/
                SET FOREIGN_KEY_CHECKS=0;
                insert into centros(cod, nombre, localidad, created_at, updated_at) 
                values(13002691, 'CIFP Virgen de Gracia', 'Puertollano', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Centro creado correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear el centro.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }


        $sql = "/*Sentencia para llenar los cursos*/
                insert into cursos(id_curso, descripcion, ano_academico, familia, horas, centros_cod, created_at, updated_at)
                select 	datunidades.GRUPO as id_curso, 
                                datunidades.CURSO as descripcion, 
                                datunidades.ANNO as ano_academico,
                        datunidades.ESTUDIO as familia,  
                        null as horas, 
                                13002691 as centro_cod, 
                        CURRENT_TIMESTAMP as created_at, 
                        CURRENT_TIMESTAMP as updated_at 
                        from datunidades;";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cursos creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los cursos.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar a todos los profesores en la tabla usuarios*/
                insert into usuarios(dni, nombre, apellidos, domicilio, email, telefono, movil, iban, created_at, updated_at)
                select 	datprofesores.DNI, 
                                datprofesores.NOMBRE, 
                                datprofesores.APELLIDOS, 
                                datprofesores.DOMICILIO, 
                                datprofesores.EMAIL, 
                                datprofesores.TELEFONO, 
                                null as movil, 
                        null as iban, 
                                CURRENT_TIMESTAMP as created_at, 
                                CURRENT_TIMESTAMP as updated_at
                from datprofesores;";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profesores creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los profesores.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar los roles */
                insert into roles(id, nombre, created_at, updated_at)
                values(0, 'Director', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

                insert into roles(id, nombre, created_at, updated_at)
                values(1, 'Administrador', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

                insert into roles(id, nombre, created_at, updated_at)
                values(2, 'Tutor', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

                insert into roles(id, nombre, created_at, updated_at)
                values(3, 'Alumno', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

                insert into roles(id, nombre, created_at, updated_at)
                values(4, 'Tutor - Administrador', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Roles añadidos correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los roles.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar los alumnos matriculados que tienen matricula diferente de anulada y diferente de vacia*/
                insert into usuarios(dni, nombre, apellidos, domicilio, email, telefono, movil, iban, created_at, updated_at)
                select  datAlumnos.DNI, 
                                datAlumnos.NOMBRE, 
                        datAlumnos.APELLIDOS, 
                        datAlumnos.DOMICILIO, 
                        datAlumnos.EMAIL_ALUMNO, 
                        datAlumnos.TELEFONO, 
                        datAlumnos.MOVIL, 
                        null as iban,  
                        CURRENT_TIMESTAMP, 
                        CURRENT_TIMESTAMP
                from datmatriculas, datAlumnos
                where datmatriculas.ALUMNO = datAlumnos.ALUMNO
                and datAlumnos.ALUMNO = datmatriculas.ALUMNO 
                and datmatriculas.ESTADOMATRICULA <> 'Anulada'
                and datmatriculas.ESTADOMATRICULA <> '';";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Alumnos matriculados creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al matricular los alumnos.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar los roles de los tutores*/
                insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
                select null, 2 as rol_id, datprofesores.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datprofesores, datunidades
                where datunidades.TUTOR = concat(datprofesores.APELLIDOS, ', ',datprofesores.NOMBRE);";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Roles de los tutores añadidos correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al añadir los roles de los tutores.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para dar de alta con permiso de Administrador y Director*/
                /* Ana Belen Directora*/
                insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
                select null, 0 as rol_id, datprofesores.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datprofesores
                where DNI='05664525Q';

                /* Ana Belen Administrador*/
                insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
                select null, 1 as rol_id, datprofesores.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datprofesores
                where DNI='05664525Q';

                /* Jose Alberto como administrador */
                insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
                select null, 1 as rol_id, datprofesores.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datprofesores
                where DNI='05679252T';";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Roles de acceso Administrador y Director creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR no se ha podido crear los roles de acceso Administrador y Director.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar los roles de los alumnos*/
                insert into usuarios_roles(id, rol_id, usuario_dni, created_at, updated_at)
                select null, 3 as rol_id, datAlumnos.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datmatriculas, datAlumnos
                where datmatriculas.ALUMNO = datAlumnos.ALUMNO
                and datAlumnos.ALUMNO = datmatriculas.ALUMNO and datmatriculas.ESTADOMATRICULA <> 'Anulada'
                and datmatriculas.ESTADOMATRICULA <> '';";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Roles de alumnos creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los roles de alumnos.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para dar de alta los profesores que son tutores de cada curso*/
                insert into tutores(idtutores, cursos_id_curso, usuarios_dni, created_at, updated_at)
                select null, datunidades.GRUPO, datprofesores.DNI, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP 
                from datunidades, datprofesores
                where datunidades.TUTOR = concat(datprofesores.APELLIDOS, ', ',datprofesores.NOMBRE);";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Tutores de cada curso creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los tutores de cada curso.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para dar de alta los alumnos en los cursos que estan matriculados */
                insert into matriculados(idmatriculados, usuarios_dni, cursos_id_curso, created_at, updated_at)
                select null, datAlumnos.DNI, datmatriculas.GRUPO, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                from datAlumnos, datmatriculas
                where datAlumnos.ALUMNO = datmatriculas.ALUMNO
                and datmatriculas.ESTADOMATRICULA <> 'Anulada'
                and datmatriculas.ESTADOMATRICULA <> '';";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Alumnos matriculados en curso creados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear los alumnos matriculados en curso.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        $sql = "/* Sentencia para insertar empresas de prueba */
                insert into empresas(id, cif, nombre, dni_representante, nombre_representante, direccion, localidad, horario, nueva, created_at, updated_at)
                values(null, 'A28599033','Indra Sistemas',null,null,'Avenida de Bruselas nº 35','Alcobendas',null,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

                insert into empresas(id, cif, nombre, dni_representante, nombre_representante, direccion, localidad, horario, nueva, created_at, updated_at)
                values(null, 'B83028084','Deimos Space',null,null,'Ronda de Poniente 19, – 28760','Tres Cantos',null,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

                insert into empresas(id, cif, nombre, dni_representante, nombre_representante, direccion, localidad, horario, nueva, created_at, updated_at)
                values(null, 'B82387770','Everis',null,null,'Camino de la Fuente de la Mora, 1','Madrid',null,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

                insert into empresas(id, cif, nombre, dni_representante, nombre_representante, direccion, localidad, horario, nueva, created_at, updated_at)
                values(null, 'A28855260','IECISA',null,null,'C/ Hermosilla 112','Madrid',null,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
                
                SET FOREIGN_KEY_CHECKS=1;";
        try {
            \DB::connection()->getPdo()->exec($sql);
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Empresas de prueba creadas correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR al crear empresas de prueba.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }
    }

    /**
     * Método que añade los datos de los archivos .csv a tablas en la BBDD gestionfct
     * @author Pedro
     * @param Request $req
     */
    public function ImportarDatosCSV(Request $req) {

        $pathCSV = public_path() . '/uploads';
        $ficherosCSV = scandir($pathCSV, 1);

        if (count($ficherosCSV) != 2) {
            /*
             * Bucle que obtiene cada archivo CSV y lo inserta en la tabla del
             * nombre del archivo en la BBDD gestionfct
             */
            foreach (new \DirectoryIterator($pathCSV) as $fileInfo) {
                if ($fileInfo->isDot())
                    continue;
                $this->_import_csv($fileInfo->getPath(), $fileInfo->getFilename());
            }

            //Método que añade los datos de los archivos .csv a tablas en la BBDD gestionfct
            $this->AddDatosCSVtoBBDD($req);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Archivos CSV importados correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al importar los archivos CSV.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        }

        return view('admin/importarDatos');
    }

    /**
     * Metodo que permite borrar la DB gestionfct y importar el archivo 
     * gestionfct_solo_usuario_auxiliardaw2@gmail.com.sql con el usuario 
     * auxiliardaw2@gmail.com con password 1 por defecto.
     * @author Pedro
     * @param Request $req
     */
    public function DeleteDB(Request $req) {
        //Borrar la DB
        $database_name = 'gestionfct';
        \DB::statement("DROP DATABASE IF EXISTS `{$database_name}`;");
        \DB::statement("CREATE DATABASE `{$database_name}` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;");
        $valor = 'NO_AUTO_VALUE_ON_ZERO';
        $valor2 = '+00:00';
        $sqlDB = "USE `{$database_name}`;
                    -- phpMyAdmin SQL Dump
                    -- version 4.6.6deb5
                    -- https://www.phpmyadmin.net/
                    --
                    -- Servidor: localhost:3306
                    -- Tiempo de generación: 31-03-2020 a las 11:48:39
                    -- Versión del servidor: 5.7.29-0ubuntu0.18.04.1
                    -- Versión de PHP: 7.2.24-0ubuntu0.18.04.3

                    SET SQL_MODE = `{$valor}`;
                    SET time_zone = `{$valor2}`;


                    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                    /*!40101 SET NAMES utf8mb4 */;

                    --
                    -- Base de datos: `gestionfct`
                    --

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `centros`
                    --

                    CREATE TABLE `centros` (
                      `cod` varchar(10) NOT NULL,
                      `nombre` varchar(100) NOT NULL,
                      `localidad` varchar(50) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `colectivos`
                    --

                    CREATE TABLE `colectivos` (
                      `id` int(11) NOT NULL,
                      `n_dias` varchar(45) DEFAULT NULL,
                      `importe` float(8,2) NOT NULL,
                      `transportes_id` int(11) DEFAULT NULL,
                      `foto` varchar(45) NOT NULL DEFAULT 'images/ticket.png',
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `comidas`
                    --

                    CREATE TABLE `comidas` (
                      `id` int(11) NOT NULL,
                      `importe` varchar(8) NOT NULL,
                      `fecha` date NOT NULL,
                      `foto` varchar(45) NOT NULL DEFAULT 'images/ticket.png',
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `cursos`
                    --

                    CREATE TABLE `cursos` (
                      `id_curso` varchar(50) NOT NULL,
                      `descripcion` varchar(191) NOT NULL,
                      `ano_academico` varchar(9) NOT NULL,
                      `familia` varchar(100) NOT NULL,
                      `horas` int(11) DEFAULT '400',
                      `centros_cod` varchar(10) DEFAULT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `empresas`
                    --

                    CREATE TABLE `empresas` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `cif` varchar(9) NOT NULL,
                        `nombre` varchar(100) NOT NULL,
                        `dni_representante` varchar(9) DEFAULT NULL,
                        `nombre_representante` varchar(100) DEFAULT NULL,
                        `direccion` varchar(100) NOT NULL,
                        `localidad` varchar(100) NOT NULL,
                        `horario` varchar(100) DEFAULT NULL,
                        `nueva` int(11) DEFAULT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `gastos`
                    --

                    CREATE TABLE `gastos` (
                      `id` int(11) NOT NULL,
                      `desplazamiento` int(1) NOT NULL,
                      `tipo` int(1) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      `usuarios_dni` varchar(9) NOT NULL,
                      `comidas_id` int(11) NOT NULL,
                      `transportes_id` int(11) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `matriculados`
                    --

                    CREATE TABLE `matriculados` (
                    `idmatriculados` int(11) NOT NULL AUTO_INCREMENT,
                    `usuarios_dni` varchar(9) NOT NULL,
                    `cursos_id_curso` varchar(50) NOT NULL,
                    `created_at` timestamp NULL DEFAULT NULL,
                    `updated_at` timestamp NULL DEFAULT NULL,
                    PRIMARY KEY (`idmatriculados`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `practicas`
                    --

                    CREATE TABLE `practicas` (
                      `id` int(10) NOT NULL,
                      `cod_proyecto` varchar(6) DEFAULT NULL,
                      `fecha_inicio` date DEFAULT NULL,
                      `fecha_fin` date DEFAULT NULL,
                      `gastos` int(11) DEFAULT NULL,
                      `apto` int(11) DEFAULT NULL,
                      `usuarios_dni` varchar(9) NOT NULL,
                      `empresas_id` int(11) NOT NULL,
                      `responsables_id` int(11) DEFAULT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `propios`
                    --

                    CREATE TABLE `propios` (
                      `id` int(11) NOT NULL,
                      `kms` int(11) NOT NULL,
                      `n_dias` varchar(45) DEFAULT NULL,
                      `precio` double(8,2) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      `transportes_id` int(11) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `responsables`
                    --

                    CREATE TABLE `responsables` (
                      `id` int(11) NOT NULL,
                      `dni` varchar(9) NOT NULL,
                      `nombre` varchar(100) NOT NULL,
                      `apellidos` varchar(100) NOT NULL,
                      `email` varchar(100) DEFAULT NULL,
                      `telefono` varchar(9) DEFAULT NULL,
                      `empresa_id` int(10) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `roles`
                    --

                    CREATE TABLE `roles` (
                      `id` int(11) NOT NULL,
                      `nombre` varchar(50) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `transportes`
                    --

                    CREATE TABLE `transportes` (
                      `id` int(11) NOT NULL,
                      `tipo` int(1) NOT NULL,
                      `donde` varchar(50) NOT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `tutores`
                    --

                    CREATE TABLE `tutores` (
                        `idtutores` int(11) NOT NULL AUTO_INCREMENT,
                        `cursos_id_curso` varchar(50) NOT NULL,
                        `usuarios_dni` varchar(9) NOT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`idtutores`)
                      ) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `usuarios`
                    --

                    CREATE TABLE `usuarios` (
                      `dni` varchar(9) NOT NULL,
                      `nombre` varchar(100) NOT NULL,
                      `apellidos` varchar(100) NOT NULL,
                      `domicilio` varchar(100) DEFAULT NULL,
                      `email` varchar(100) DEFAULT NULL,
                      `pass` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b',
                      `telefono` varchar(9) DEFAULT NULL,
                      `movil` varchar(9) DEFAULT NULL,
                      `iban` varchar(24) DEFAULT NULL,
                      `foto` varchar(45) NOT NULL DEFAULT 'images/defecto.jpeg',
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    --
                    -- Volcado de datos para la tabla `usuarios`
                    --

                    INSERT INTO `usuarios` (`dni`, `nombre`, `apellidos`, `domicilio`, `email`, `pass`, `telefono`, `movil`, `iban`, `foto`, `created_at`, `updated_at`) VALUES
                    ('0', 'Usuario', 'Borrado', '', 'auxiliardaw2@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '', '', '', 'images/defecto.jpeg', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `usuarios_roles`
                    --

                    CREATE TABLE `usuarios_roles` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `rol_id` int(11) NOT NULL,
                        `usuario_dni` varchar(9) NOT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                    --
                    -- Volcado de datos para la tabla `usuarios_roles`
                    --

                    INSERT INTO `usuarios_roles` (`id`, `rol_id`, `usuario_dni`, `created_at`, `updated_at`) VALUES
                    (1, 4, '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

                    --
                    -- Índices para tablas volcadas
                    --

                    --
                    -- Indices de la tabla `centros`
                    --
                    ALTER TABLE `centros`
                      ADD PRIMARY KEY (`cod`);

                    --
                    -- Indices de la tabla `colectivos`
                    --
                    ALTER TABLE `colectivos`
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `fk_colectivos_transportes1_idx` (`transportes_id`);

                    --
                    -- Indices de la tabla `comidas`
                    --
                    ALTER TABLE `comidas`
                      ADD PRIMARY KEY (`id`);

                    --
                    -- Indices de la tabla `cursos`
                    --
                    ALTER TABLE `cursos`
                      ADD PRIMARY KEY (`id_curso`),
                      ADD KEY `fk_cursos_centros1_idx` (`centros_cod`);

                    --
                    -- Indices de la tabla `empresas`
                    --
                    ALTER TABLE `empresas`
                      ADD PRIMARY KEY (`id`);

                    --
                    -- Indices de la tabla `gastos`
                    --
                    ALTER TABLE `gastos`
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `fk_gastos_usuarios1_idx` (`usuarios_dni`),
                      ADD KEY `fk_gastos_comidas1_idx` (`comidas_id`),
                      ADD KEY `fk_gastos_transportes1_idx` (`transportes_id`);

                    --
                    -- Indices de la tabla `matriculados`
                    --
                    ALTER TABLE `matriculados`
                      ADD PRIMARY KEY (`idmatriculados`),
                      ADD KEY `fk_matriculados_usuarios1_idx` (`usuarios_dni`),
                      ADD KEY `fk_matriculados_cursos1_idx` (`cursos_id_curso`);

                    --
                    -- Indices de la tabla `practicas`
                    --
                    ALTER TABLE `practicas`
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `fk_practicas_usuarios1_idx` (`usuarios_dni`),
                      ADD KEY `fk_practicas_empresas1_idx` (`empresas_id`);

                    --
                    -- Indices de la tabla `propios`
                    --
                    ALTER TABLE `propios`
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `fk_propios_transportes1_idx` (`transportes_id`);

                    --
                    -- Indices de la tabla `responsables`
                    --
                    ALTER TABLE `responsables`
                      ADD PRIMARY KEY (`id`);

                    --
                    -- Indices de la tabla `roles`
                    --
                    ALTER TABLE `roles`
                      ADD PRIMARY KEY (`id`);

                    --
                    -- Indices de la tabla `transportes`
                    --
                    ALTER TABLE `transportes`
                      ADD PRIMARY KEY (`id`);

                    --
                    -- Indices de la tabla `tutores`
                    --
                    ALTER TABLE `tutores`
                      ADD PRIMARY KEY (`idtutores`),
                      ADD KEY `fk_tutores_cursos1_idx` (`cursos_id_curso`),
                      ADD KEY `fk_tutores_usuarios1_idx` (`usuarios_dni`);

                    --
                    -- Indices de la tabla `usuarios`
                    --
                    ALTER TABLE `usuarios`
                      ADD PRIMARY KEY (`dni`);

                    --
                    -- Indices de la tabla `usuarios_roles`
                    --
                    ALTER TABLE `usuarios_roles`
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `fk_usuarios_roles_roles` (`rol_id`),
                      ADD KEY `fk_usuarios_roles_usuarios_idx` (`usuario_dni`);

                    --
                    -- AUTO_INCREMENT de las tablas volcadas
                    --

                    --
                    -- AUTO_INCREMENT de la tabla `colectivos`
                    --
                    ALTER TABLE `colectivos`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
                    --
                    -- AUTO_INCREMENT de la tabla `comidas`
                    --
                    ALTER TABLE `comidas`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
                    --
                    -- AUTO_INCREMENT de la tabla `empresas`
                    --
                    ALTER TABLE `empresas`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
                    --
                    -- AUTO_INCREMENT de la tabla `gastos`
                    --
                    ALTER TABLE `gastos`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
                    --
                    -- AUTO_INCREMENT de la tabla `matriculados`
                    --
                    ALTER TABLE `matriculados`
                      MODIFY `idmatriculados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
                    --
                    -- AUTO_INCREMENT de la tabla `practicas`
                    --
                    ALTER TABLE `practicas`
                      MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
                    --
                    -- AUTO_INCREMENT de la tabla `propios`
                    --
                    ALTER TABLE `propios`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
                    --
                    -- AUTO_INCREMENT de la tabla `responsables`
                    --
                    ALTER TABLE `responsables`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
                    --
                    -- AUTO_INCREMENT de la tabla `transportes`
                    --
                    ALTER TABLE `transportes`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
                    --
                    -- AUTO_INCREMENT de la tabla `tutores`
                    --
                    ALTER TABLE `tutores`
                      MODIFY `idtutores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
                    --
                    -- AUTO_INCREMENT de la tabla `usuarios_roles`
                    --
                    ALTER TABLE `usuarios_roles`
                      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
                    --
                    -- Restricciones para tablas volcadas
                    --

                    --
                    -- Filtros para la tabla `colectivos`
                    --
                    ALTER TABLE `colectivos`
                      ADD CONSTRAINT `fk_colectivos_transportes1` FOREIGN KEY (`transportes_id`) REFERENCES `transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `cursos`
                    --
                    ALTER TABLE `cursos`
                      ADD CONSTRAINT `fk_cursos_centros1` FOREIGN KEY (`centros_cod`) REFERENCES `centros` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `gastos`
                    --
                    ALTER TABLE `gastos`
                      ADD CONSTRAINT `fk_gastos_comidas1` FOREIGN KEY (`comidas_id`) REFERENCES `comidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_gastos_transportes1` FOREIGN KEY (`transportes_id`) REFERENCES `transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_gastos_usuarios1` FOREIGN KEY (`usuarios_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `matriculados`
                    --
                    ALTER TABLE `matriculados`
                      ADD CONSTRAINT `fk_matriculados_cursos` FOREIGN KEY (`cursos_id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_matriculados_usuarios1` FOREIGN KEY (`usuarios_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `practicas`
                    --
                    ALTER TABLE `practicas`
                      ADD CONSTRAINT `fk_practicas_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_practicas_usuarios1` FOREIGN KEY (`usuarios_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `propios`
                    --
                    ALTER TABLE `propios`
                      ADD CONSTRAINT `fk_propios_transportes1` FOREIGN KEY (`transportes_id`) REFERENCES `transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `tutores`
                    --
                    ALTER TABLE `tutores`
                      ADD CONSTRAINT `fk_tutores_cursos1` FOREIGN KEY (`cursos_id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_tutores_usuarios1` FOREIGN KEY (`usuarios_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    --
                    -- Filtros para la tabla `usuarios_roles`
                    --
                    ALTER TABLE `usuarios_roles`
                      ADD CONSTRAINT `fk_usuarios_roles_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
                      ADD CONSTRAINT `fk_usuarios_roles_usuarios` FOREIGN KEY (`usuario_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                    SET FOREIGN_KEY_CHECKS=0;
    
        ";
        \DB::connection()->getPdo()->exec($sqlDB);
        echo '<div class="alert alert alert-success alert-dismissible fade show" role="alert">
                    Restaurada la base de datos correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Debe de adjuntar los archivos .csv en el cuadro Subir Archivos para importar los datos. Gracias.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';

        return view('admin/importarDatos');
    }

    /**
     * Gestionar Curso
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarCursos(Request $req) {
        $id = $req->get('id');
        $descripcion = $req->get('descripcion');
        $anioAcademico = $req->get('anioAcademico');
        $familia = $req->get('familia');
        $horas = $req->get('horas');
        if (isset($_REQUEST['aniadir'])) {
            if ($id != null && $descripcion != null && $anioAcademico != null && $familia != null && $horas != null) {
                $val = Conexion::existeCurso($id);
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
        if (isset($_REQUEST['eliminar'])) {
            Conexion::borrarCurso($id);
        }
        $l = Conexion::listaCursosPagination();
        return view('admin/gestionarCursos', ['l1' => $l]);
    }

    /**
     * Devuelve las listas
     * @author Marina
     */
    public static function paginacionConsultarGastoAlumno() {
        $gc = null;
        $gtp = null;
        $gtc = null;

        $l1 = Conexion::listaCursos();

        $ciclo = session()->get('ciclo');
        $l2 = Conexion::listarAlumnosCurso($ciclo);

        $dniAlumno = session()->get('dniAlumno');
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
            $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
        }
        if ($propio == 0) {
            $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
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

    /**
     * Gestionar gastos alumnos
     * @author Marina
     * @param Request $req
     * @return type
     */
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
            $fot = $req->file('foto');

            if ($fot == null) {
                Conexion::ModificarGastoComidaSinFoto($id, $fecha, $importe);
            } else {
                $foto = $fot->move('imagenes_gastos/comida', $id);
                Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
            }
        }
        if (isset($_REQUEST['eliminar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoComida($id);
        }
//            editar y borrar transporte propio
        if (isset($_REQUEST['editarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $kms = $req->get('kms');
            $precio = $kms * 0.12;
            Conexion::ModificarGastoTransportePropio($id, $precio, $kms);
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
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != 'images/ticket.png') {
                unlink($file);
            }
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte);
        }
        $datos = controladorAdmin::paginacionConsultarGastoAlumno();
        return view('admin/consultarGastos', $datos);
    }

    /**
     * Escribe las tablas
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function muestraConsultarGastosAjax(Request $req) {
        $v = null;

        if (isset($_REQUEST['dniAlumno'])) {
            $dniAlumno = $req->get('dniAlumno');
            session()->put('dniAlumno', $dniAlumno);
        }

        $v = controladorAdmin::escribirTablaCunsultarGastosAjax($dniAlumno);

        echo $v;
    }

    /**
     * Escribe las tablas de consultar gastos ajax
     * @param type $dniAlumno
     * @return string
     */
    public function escribirTablaCunsultarGastosAjax($dniAlumno) {
        $gt = Conexion::listarGastosTransportes($dniAlumno);
        $v = null;
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
                                            <th>Importe</th>                      
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                foreach ($gtc as $key) {
                    $v = $v . '
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="idTransporte" name ="idTransporte" value="' . $key->idTransporte . '" readonly>
                                                    <input type="text" class="form-control form-control-sm form-control-md" id="dondeC" name="donde" value="' . $key->donde . '" readonly/>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="ID" name="ID" value="' . $key->idColectivos . '" readonly/>
                                                </td>
                                                <td><input type="number" step="0.01" class="form-control form-control-sm" id="precio" name="precio" value="' . $key->precio . '"/></td>
                                                <td>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="fotoUrl" name="fotoUrl" value="' . $key->foto . '" readonly/>
                                                    <a  href="' . $key->foto . '" target="_blank"> <img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/></a>
                                                    <input type="file" class="form-control form-control-sm form-control-md"  id="foto" name="foto">
                                                </td>
                                                <td><button type="button" id="editarC" class="btn-sm editar" name="editarC"></button></td>
                                                <td><button type="button" id="eliminarC" class="btn-sm eliminar" name="eliminarC"></button></td>
                                            </tr>';
                }
                $v = $v . '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
            }
        }
        if ($propio == 0) {
            $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
            if ($gtp != null) {
                $v = $v . '<!-- Gestionar Gastos Transporte  Propio-->
                    <div id="propio" class="row justify-content-center">
                        <div class="col-sm col-md">
                            <h2 class="text-center">Consultar Gastos Transporte Propio</h2>
                            <div class="table-responsive ">
                                <table class="table  table-striped  table-hover table-bordered">
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
                    $v = $v . '
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="idTransporte1" name ="idTransporte" value="' . $key->idTransporte . '" readonly>
                                                    <input type="text" class="form-control form-control-sm form-control-md" id="donde" name="donde" value="' . $key->donde . '" readonly/>
                                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="ID1" name="ID" value="' . $key->idPropios . '" readonly/>
                                                </td>
                                                <td><input type="number"  step="0.01" class="form-control form-control-sm" id="kms" name="kms" value="' . $key->kms . '"/></td>
                                                <td><input type="number"  step="0.01" class="form-control form-control-sm" id="precio1" name="precio" value="' . $key->precio . '"/></td>
                                                <td><button type="button" id="editarP" class="btn-sm editar" name="editarP"></button></td>
                                                <td><button type="button" id="eliminarP" class="btn-sm eliminar" name="eliminarP"></button></td>
                                            </tr>';
                }
                $v = $v . '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
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
                $v = $v . '
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control form-control-sm form-control-md" id="idGasto" name ="idGasto" value="' . $key->idGasto . '" readonly>
                                                <input type="date" class="form-control form-control-sm form-control-md" id="fecha" name="fecha" value="' . $key->fecha . '"/>
                                                <input type="hidden" class="form-control form-control-sm form-control-md" id="ID2"  name="ID" value="' . $key->id . '" readonly/>
                                            </td>
                                            <td><input type="number"  step="0.01" class="form-control form-control-sm" id="importe" name="importe" value="' . $key->importe . '"/></td>
                                            <td>
                                                <input type="hidden" class="form-control form-control-sm form-control-md" id="fotoUrl1" name="fotoUrl" value="' . $key->foto . '" readonly/>
                                                <a  href="' . $key->foto . '" target="_blank"> <img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/></a>
                                                <input type="file" class="form-control form-control-sm form-control-md"  id="foto1" name="foto">
                                            </td>
                                            <td><button type="button" id="editar" class="btn-sm"></button></td>
                                            <td><button type="button" id="eliminar" class="btn-sm"></button></td> 
                                        </tr>';
            }
            $v = $v . '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';
        }
        return $v;
    }

    /**
     * Gestionar gastos alumnos ajax
     * @author Marina
     * @param Request $req
     * @return type
     */
    public function gestionarGastosAjax(Request $req) {
        $dniAlumno = session()->get('dniAlumno');

        //            editar y borrar comida
        if (isset($_REQUEST['editar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $fecha = $req->get('fecha');
            $importe = $req->get('importe');
            $foto = $req->get('foto');

            if ($fot == null) {
                Conexion::ModificarGastoComidaSinFoto($id, $fecha, $importe);
            } else {
                $foto = $fot->move('imagenes_gastos/comida', $id);
                Conexion::ModificarGastoComida($id, $fecha, $importe, $foto);
            }
        }
        if (isset($_REQUEST['eliminar'])) {
            $id = $req->get('ID');
            $idGasto = $req->get('idGasto');
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != "images/ticket.png") {
                unlink($file);
            }
            Conexion::borrarGastoComida($id);
        }
//            editar y borrar transporte propio
        if (isset($_REQUEST['editarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $kms = $req->get('kms');
            $precio = $kms * 0.12;
            Conexion::ModificarGastoTransportePropio($id, $precio, $kms);
        }
        if (isset($_REQUEST['eliminarP'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            Conexion::borrarGastoTransportePropio($id, $idTransporte);
        }
//            editar y borrar transporte colectivo
        if (isset($_REQUEST['editarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $precio = $req->get('precio');
            $foto = $req->get('foto');

            if ($fot == null) {
                Conexion::ModificarGastoTransporteColectivoSinFoto($id, $precio);
            } else {
                $foto = $fot->move('imagenes_gastos/transporte', $idTransporte);
                Conexion::ModificarGastoTransporteColectivo($id, $precio, $foto);
            }
        }
        if (isset($_REQUEST['eliminarC'])) {
            $id = $req->get('ID');
            $idTransporte = $req->get('idTransporte');
            $file = $req->get('fotoUrl');
            if (file_exists($file) && $file != "images/ticket.png") {
                unlink($file);
            }
            Conexion::borrarGastoTransporteColectivo($id, $idTransporte);
        }
        $v = controladorAdmin::escribirTablaCunsultarGastosAjax($dniAlumno);

        echo $v;
    }

    /**
     * Gestionar todos los usuarios
     * @author Manu
     * @param Request $req
     * @return type
     */
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

            $rolUsuario = Conexion::obtenerRolUsuario($dni);
            $rolAntiguo = $rolUsuario->rol_id;

            //SI ES TUTOR:
            if ($rolAntiguo == 2) {
                //si antes era tutor y ahora va a ser administrador
                if ($rolAntiguo == 2 && $rol_id == 1) {
                    Conexion::borrarTutor($dni);
                    Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                } else {
                    //si antes era tutor y ahora va a ser alumno
                    if ($rolAntiguo == 2 && $rol_id == 3) {
                        Conexion::borrarTutor($dni);
                        Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                        Conexion::insertarAlumnoTablaMatriculados($dni, 0);
                    } else {
                        //si antes era tutor y ahora va a ser tutor-administrador
                        if ($rolAntiguo == 2 && $rol_id == 4) {
                            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                        } //si antes era tutor y va a seguir siendo tutor
                        if ($rolAntiguo == 2 && $rol_id == 2) {
                            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                        }
                    }
                }
            } else {
                //SI ES ADMINISTRADOR:
                if ($rolAntiguo == 1) {
                    //si antes era administrador y ahora va a ser tutor
                    if ($rolAntiguo == 1 && $rol_id == 2) {
                        Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                        Conexion::insertarTutor(0, $dni);
                    } else {
                        //si antes era administrador y ahora va a ser alumno
                        if ($rolAntiguo == 1 && $rol_id == 3) {
                            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                            Conexion::insertarAlumnoTablaMatriculados($dni, 0);
                        } else {
                            //si antes era administrador y ahora va a ser tutor-administrador
                            if ($rolAntiguo == 1 && $rol_id == 4) {
                                Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                Conexion::insertarTutor(0, $dni);
                            } //si antes era administrador y va a seguir siendo administrador
                            if ($rolAntiguo == 1 && $rol_id == 1) {
                                Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                            }
                        }
                    }
                } else {
                    //SI ES TUTOR-ADMINISTRADOR:
                    if ($rolAntiguo == 4) {
                        //si antes era tutor-administrador y ahora va a ser administrador
                        if ($rolAntiguo == 4 && $rol_id == 1) {
                            Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                            Conexion::borrarTutor($dni);
                        } else {
                            //si antes era tutor-administrador y ahora va a ser tutor
                            if ($rolAntiguo == 4 && $rol_id == 2) {
                                Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                            } else {
                                //si antes era tutor-administrador y ahora va a ser alumno
                                if ($rolAntiguo == 4 && $rol_id == 3) {
                                    Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                    Conexion::insertarAlumnoTablaMatriculados($dni, 0);
                                } //si antes era tutor-administrador y va a seguir siendo tutor-administrador
                                if ($rolAntiguo == 4 && $rol_id == 4) {
                                    Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                }
                            }
                        }
                    } else {
                        //SI ES ALUMNO:
                        if ($rolAntiguo == 3) {
                            //si antes era alumno y ahora va a ser administrador
                            if ($rolAntiguo == 3 && $rol_id == 1) {
                                Conexion::borrarAlumnoTablaPracticas($dni);
                                Conexion::borrarAlumnoTablaGastos($dni);
                                Conexion::borrarAlumno($dni);
                                Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                            } else {
                                //si antes era alumno y ahora va a ser alumno
                                if ($rolAntiguo == 3 && $rol_id == 3) {
                                    Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                } else {
                                    //si antes era alumno y ahora va a ser tutor
                                    if ($rolAntiguo == 3 && $rol_id == 2) {
                                        Conexion::borrarAlumnoTablaPracticas($dni);
                                        Conexion::borrarAlumnoTablaGastos($dni);
                                        Conexion::borrarAlumno($dni);
                                        Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                        Conexion::insertarTutor(0, $dni);
                                    } //si antes era alumno y va a ser tutor-administrador
                                    if ($rolAntiguo == 2 && $rol_id == 4) {
                                        Conexion::borrarAlumnoTablaPracticas($dni);
                                        Conexion::borrarAlumnoTablaGastos($dni);
                                        Conexion::borrarAlumno($dni);
                                        Conexion::ModificarUsuarios($dni, $nombre, $apellidos, $domicilio, $email, $tel, $movil, $rol_id);
                                        Conexion::insertarTutor(0, $dni);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');
            $rol_id = $req->get('selectRol');
            $file = $req->get('fotoUrl');

            if (file_exists($file) && $file != "images/defecto.jpeg") {
                unlink($file);
            }

            if ($rol_id == 1) {
//                Conexion::borrarGastoComidaDNI($dni); 
//                Conexion::borrarGastoPropioDNI($dni);
//                Conexion::borrarGastoColectivoDNI($dni);
                Conexion::borrarUsuario($dni);
            } else if ($rol_id == 2) {

                $cursoTutor = Conexion::obtenerCicloTutor($dni);

                Conexion::borrarTutor($dni);
                Conexion::borrarUsuario($dni);
            } else if ($rol_id == 4) {

                $cursoTutor = Conexion::obtenerCicloTutor($dni);

                Conexion::borrarTutor($dni);
                Conexion::borrarUsuario($dni);
            }
        }

        return redirect()->route('gestionarUsuarios');
    }

    /**
     * Gestionar alumnos
     * @author Manu
     * @param Request $req
     * @return type
     */
    public function gestionarAlumnos(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $iban = $req->get('iban');

            $ciclo = $req->get('selectCiclo');

            $now = new \DateTime();
            $updated_at = $now->format('Y-m-d H:i:s');

            Conexion::actualizarDatosAlumno($dni, $nombre, $apellidos, $email, $telefono, $iban, $ciclo, $updated_at);

            return redirect()->route('gestionarAlumnos');
        }
    }

    /**
     * Gestionar tutores
     * @author Manu
     * @param Request $req
     * @return type
     */
    public function gestionarTutores(Request $req) {

        if (isset($_REQUEST['editar'])) {

            $dni = $req->get('dni');
            $nombre = $req->get('nombre');
            $apellidos = $req->get('apellidos');
            $email = $req->get('email');
            $telefono = $req->get('telefono');
            $ciclo = $req->get('selectCiclo');

            Conexion::actualizarDatosTutor($dni, $nombre, $apellidos, $email, $telefono, $ciclo);
        }

        if (isset($_REQUEST['eliminar'])) {

            $dni = $req->get('dni');
            $file = $req->get('fotoUrl');

            if (file_exists($file) && $file != "images/defecto.jpeg") {
                unlink($file);
            }

            Conexion::borrarTutor($dni);
            Conexion::borrarUsuario($dni);
        }
        return redirect()->route('gestionarTutores');
    }

    /**
     * Exportar Docmentos
     * @author Pedro
     * @param Request $req
     * @return type
     */
    public function exportarDocumentos(Request $req) {
        $familia = $req->get('familiaProfesional');
        $idCurso = $req->get('ciclo');
        if (isset($_REQUEST['recibiFPDUAL'])) {
            $curso = $req->get("ciclo");

            $alumnos_curso = Conexion::obtenerAlumnosTutor($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);

            $cuantos_alumnos = count($alumnos_curso);

            if ($cuantos_alumnos != 0) {
                foreach ($alumnos_curso as $alumno) {
                    $lista_documentos[] = Documentos::GenerarRecibiTodosAlumnosAdminDUAL($alumno->dni, $datos_tutor);
                }
            } else {
                $lista_documentos = null;
            }
            if ($lista_documentos != null) {
                Documentos::generarArchivoZIPDUAL($lista_documentos, $curso);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos del ciclo  ' . $curso . ' con FP DUAL
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        if (isset($_REQUEST['recibiFCT'])) {
            $curso = $req->get("ciclo");

            $alumnos_curso = Conexion::obtenerAlumnosTutor($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $cuantos_alumnos = count($alumnos_curso);

            if ($cuantos_alumnos != 0) {
                foreach ($alumnos_curso as $alumno) {
                    $lista_documentos[] = Documentos::GenerarRecibiTodosAdminAlumnos($alumno->dni, $datos_tutor);
                }
            } else {
                $lista_documentos = null;
            }

            if ($lista_documentos != null) {
                Documentos::generarArchivoZIP($lista_documentos, $curso);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos del ciclo ' . $curso . ' con FP
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }

        if (isset($_REQUEST['memoriaAlumnos'])) {

            $curso = $req->get("ciclo");
            $anio = Conexion::obtenerAnioAcademico();
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $alumnos_memoria = Conexion::obtenerAlumnosTutorMemoria($curso);
            $cuantos_alumnos_memoria = count($alumnos_memoria);

            if ($cuantos_alumnos_memoria != 0) {
                $alumnos_memoria = Conexion::obtenerAlumnosTutorMemoria($curso);
            } else {
                $alumnos_memoria = null;
            }

            if ($alumnos_memoria != null) {
                Documentos::GenerarMemoriaAlumnos($alumnos_memoria, $curso, $anio);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen alumnos del ciclo ' . $curso . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['gastosFCT'])) {
            $curso = $req->get("ciclo");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);
            $datos_director = Conexion::obtenerDatosDirector();

            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            $cuantos_alumnos_gastos = count($alumnos_gastos);

            if ($cuantos_alumnos_gastos != 0) {
                $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            } else {
                $alumnos_gastos = null;
            }

            if ($alumnos_gastos != null) {
                Documentos::GenerarGastosAlumnos($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No hay alumnos con gastos de FCT en este curso
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        if (isset($_REQUEST['gastosFPDUAL'])) {
            $curso = $req->get("ciclo");
            $fecha_actual = date('d-m-Y');
            $datos_centro = Conexion::obtenerDatosCentro();
            $datos_ciclo = Conexion::obtenerDatosCiclo($curso);
            $datos_tutor = Conexion::obtenerDatosTutorCiclo($curso);

            $datos_director = Conexion::obtenerDatosDirector();

            $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            $cuantos_alumnos_gastos = count($alumnos_gastos);

            if ($cuantos_alumnos_gastos != 0) {
                $alumnos_gastos = Conexion::obtenerAlumnosGastos($curso);
            } else {
                $alumnos_gastos = null;
            }

            if ($alumnos_gastos != null) {
                Documentos::GenerarGastosAlumnosDUAL($alumnos_gastos, $curso, $fecha_actual, $datos_centro, $datos_ciclo, $datos_tutor, $datos_director);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No hay alumnos con gastos de FCT DUAL en este curso
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
            }
        }
        $l1 = Conexion::listaCursos();
        $datos = [
            'l1' => $l1
        ];
        return view('admin/extraerDocA', $datos);
    }

    /**
     * Pefil Admin
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


        $now = new \DateTime();
        $updated_at = $now->format('Y-m-d H:i:s');

        $domicilio = $req->get('domicilio');
        $telefono = $req->get('telefono');
        $movil = $req->get('movil');

        $pass = $req->get('pass');
        if ($pass != null) {
            $passHash = hash('sha256', $pass);
            Conexion::ModificarConstrasenia($dni, $passHash);
            $clave = $passHash;
        }

        Conexion::actualizarDatosAdminTutor($dni, $nombre, $apellidos, $domicilio, $email, $telefono, $movil, $updated_at);

        $usu = Conexion::existeUsuario($email, $clave);

        session()->put('usu', $usu);

        return view('admin/perfilAdmin', ['usu' => $usu]);
    }

    /**
     * Añadir usuario
     * @author Manu
     * @param Request $req
     * @return type
     */
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
    }

    /**
     * Listar curso para consultar gastos ajax
     * @author Marina
     */
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

    /**
     * Listar curso para consultar gastos ajax
     * @author Marina
     */
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
