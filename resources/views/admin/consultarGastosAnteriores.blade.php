@extends('maestra.maestraAdmin')
<!-- CSS -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/dropzone.css" rel="stylesheet" type="text/css">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/dropzone.js" type="text/javascript"></script>
@section('titulo') 
Consultar gastos anteriores
@endsection

@section('contenido') 
<div class="container-fluid">
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gastos Anteriores</a></div>
            </div>
        </nav>
    </nav>

    <div class="container">
        <h3>Consultar Gastos Años Anteriores</h3>
        <form name="formCursos" action="consultarGastosAnteriores"  method="post">
            {{ csrf_field() }}
            Curso: 
            <select name="curso">
                <?php
                if (isset($lista_cursos)) {
                    foreach ($lista_cursos as $curso) {
                        ?>
                        <option value="<?php echo $curso->cod; ?>"><?php echo $curso->descripcion; ?></option>
                        <?php
                    }
                }
                ?>
            </select><br><br>
            Familia Profesional: 
            <select name="familias">
                <?php
                if (isset($lista_familias)) {
                    foreach ($lista_familias as $familia) {
                        ?>
                        <option value="<?php echo $familia->id_curso; ?>"><?php echo $familia->familia; ?></option>
                        <?php
                    }
                }
                ?>
            </select><br><br>
            Empresas: 
            <select name="empresas">
                <?php
                if (isset($lista_empresas)) {
                    foreach ($lista_empresas as $empresas) {
                        ?>
                        <option value="<?php echo $empresas->cif; ?>"><?php echo $empresas->nombre; ?></option>
                        <?php
                    }
                }
                ?>
            </select><br><br>
            <input type="submit" id="verTabla" class="btn btn-primary" name="verTabla" value="Ver Gastos"/>
            <br><br>
        </form>

        <?php
        if (isset($tabla_gastos)) {
            if (count($tabla_gastos) > 0) {
                ?>
                <form name="formExportarPDF" action="exportarPDF"  method="post">
                    <input type="submit" id="exportarPDF" class="btn btn-primary" name="exportarPDF" value="Exportar PDF"/>
                </form>
                <div class="row">
                    <div class="col-sm col-md">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-hover table-bordered">
                                <thead class="thead-dark">
                                <thead>
                                <th>Ciclo</th>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Gastos</th>
                                <th>CIF</th>
                                <th>Empresa</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($tabla_gastos as $gastos) {
                                        ?>
                                        <tr>
                                            <td><?php echo $gastos->cursos_id_curso; ?></td>
                                            <td><?php echo $gastos->dni; ?></td>
                                            <td><?php echo $gastos->nombre; ?></td>
                                            <td><?php echo $gastos->apellidos; ?></td>
                                            <td><?php echo $gastos->gastos; ?> €</td>
                                            <td><?php echo $gastos->cif; ?></td>
                                            <td><?php echo $gastos->nombre; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    @endsection