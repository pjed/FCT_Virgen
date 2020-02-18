@extends('maestra.maestraAdmin')

@section('titulo') 
Exportar documentos
@endsection

@section('contenido') 
<div class="container-fluid">

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item active"><a href="extraerDocA">Exportar documentos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Exportar documentos</h2>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center"> 
        <div class="col-sm-3 col-md-3">
            <form name="form" action="exportarDocumentos" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="text-center" for='familiaProfesional'>
                        Familia profesional:
                        <select class="sel" name="familiaProfesional">  
                            <?php
                            foreach ($l1 as $value) {
                                ?>
                                <option value="<?php echo $value->familia; ?>"><?php echo $value->familia; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </label>  
                </div>
                <br>
                <div class="form-group">
                    <label class="text-center" for='ciclo'>
                        Ciclo:
                        <select class="sel" name="ciclo">  
                            <?php
                            foreach ($l1 as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->id; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </label> 
                </div>
                </br>
                <div class="form-group">
                    <label>
                        Recibí (PDF):
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
                    </label>
                </div>
                </br>
                <div class="form-group">
                    <label>
                        Memoria alumnos (EXCEL):   
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="memoriaAlumnos" class="btn btn-primary" name="memoriaAlumnos" value="Memoria alumnos"/>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Gastos de alumnos (EXCEL):  
                        <div class="row">
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="gastosFCT" class="btn btn-primary" name="gastosFCT" value="Gastos alumnos FCT"/>
                            </div>
                            <div class="col-sm col-md col-lg">
                                <input type="submit" id="gastosFPDUAL" class="btn btn-primary" name="gastosFPDUAL" value="Gastos alumnos FP DUAL"/>
                            </div>
                        </div>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection