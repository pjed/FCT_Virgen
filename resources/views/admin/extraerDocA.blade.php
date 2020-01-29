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
    <form name="form" action="exportarDocumentos" method="POST">
        {{ csrf_field() }}
        <div class="row justify-content-center"> 

            <!-- Columna izquierda -->
            <div class="col-md-2">

                <fieldset>
                    <legend>Familia profesional</legend>

                    <?php
                    foreach ($listaFamiliasProfesionales as $value) {
                        ?>
                        <div>
                            <input type="radio" id='<?php $value ?>' name="familiaProfesional" value="">
                            <label for='<?php $value ?>'><?php $value ?></label>
                        </div>
                        <?php
                    }
                    ?>
                </fieldset>

            </div>

            <!-- Columna centro izquierda -->
            <div class="col-md-2">

                <fieldset>
                    <legend>Ciclo</legend>

                    <?php
                    foreach ($listaCiclosFamilia as $value) {
                        ?>
                        <div>
                            <input type="radio" id='<?php $value ?>' name="ciclo" value="">
                            <label for='<?php $value ?>'><?php $value ?></label>
                        </div>
                        <?php
                    }
                    ?>
                </fieldset>

                <fieldset>
                    <legend>Curso</legend>

                    <div>
                        <input type="radio" id="primero" name="curso" value="1">
                        <label for="primero">1</label>
                    </div>

                    <div>
                        <input type="radio" id="segundo" name="curso" value="2">
                        <label for="segundo">2</label>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Tutor</legend>

                    <div>
                        <input type="text" name="tutor" value="" readonly>
                    </div>

                </fieldset>

            </div>

            <!-- Columna centro derecha -->
            <div class="col-md-2">

                <fieldset>
                    <legend>Recibí (pdf)</legend>

                    <div>
                        <input type="submit" name="recibiFPdual" value="Anexo XV Recibí FP DUAL"><br><br>
                    </div>

                    <div>
                        <input type="submit" name="recibiFCT" value="Anexo XV Recibí FCT">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Memoria alumnos (excel)</legend>

                    <div>
                        <input type="submit" name="memoriaAlumnos" value="Memoria de alumnos">
                    </div>

                </fieldset>

            </div>

            <!-- Columna derecha -->
            <div class="col-md-2">

                <fieldset>
                    <legend>Enlaces anexos</legend>

                    <div>
                        <a href="">FP Dual</a>
                    </div>

                    <div>
                        <a href="">FCT</a>
                    </div>

                </fieldset>

            </div>

        </div>

    </form>

</div>
@endsection