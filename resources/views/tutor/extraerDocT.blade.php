<?php
use App\Auxiliar\Conexion; ?>
@extends('maestra.maestraTutor')

@section('titulo') 
Extraer Documentos
@endsection

@section('contenido') 
<div class="container">
    <!-- Migas de pan -->
    <nav class="row  justify-content-center">
        <nav class="col-sm col-md-2 col-lg">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Generar Documentos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row  justify-content-center">
        <div class="col-sm col-md-2 col-lg">
            <h2 class="text-center">Generar Documentos</h2>
        </div>
    </div>

    <!-- Generar Documentos -->
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php
            $lu = Conexion::generarDocTutor();
            foreach ($lu as $key) {
                ?>
                <form action="extraerDocT" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>
                            Grupo:      
                            <input type="text" id="id_curso" class="form-control form-control-sm form-control-md" name="id_curso" value="<?php echo $key['id_curso']; ?>" readonly/>
                        </label>
                        <label>
                            Tutor:      
                            <input type="text" id="nom_ape_tutor" class="form-control form-control-sm form-control-md" name="nom_ape_tutor" value="<?php echo $key['nombre_tutor'] . ', ' . $key['apellido_tutor']; ?>" readonly/>
                            <input type="hidden" id="dni_tutor" class="form-control form-control-sm form-control-md" name="dni_tutor" value="<?php echo $key['dni_tutor']; ?>"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            Recibí (PDF):
                        </label>
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="recibiFCT" class="btn btn-primary" name="recibiFCT" value="Anexo V Recibí FCT"/>
                            </div>
                            <div class="col-sm col-md col-lg">
                                <a href="http://www.educa.jccm.es/es/fpclm/centros-formacion-profesional/formacion-centros-trabajo-proyecto.ficheros/100158-anexo5_recibi.doc">FCT</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="recibiFPDUAL" class="btn btn-primary" name="recibiFPDUAL" value="Anexo XV Recibí FP DUAL"/>
                            </div>
                            <div class="col-sm col-md col-lg">
                                <a href="http://www.educa.jccm.es/es/fpclm/fp-dual/proyectos-formacion-profesional-dual-curso-2019-2020.ficheros/317740-Anexo%20XV%20Recib%C3%AD%20del%20alumnado.docx">FP DUAL</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Memoria alumnos (EXCEL):   
                        </label>
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="memoriaAlumnos" class="btn btn-primary" name="memoriaAlumnos" value="Memoria alumnos"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Gastos de alumnos (EXCEL):  
                        </label>
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="gastosFCT" class="btn btn-primary" name="gastosFCT" value="Gastos alumnos FCT"/>
                            </div>
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="gastosFPDUAL" class="btn btn-primary" name="gastosFPDUAL" value="Gastos alumnos FP DUAL"/>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div> 
</div>
@endsection