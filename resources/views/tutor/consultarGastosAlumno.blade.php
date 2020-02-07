
<?php

use App\Auxiliar\Conexion;

//$gc = Conexion::listarGastosComidaPagination();
//$gt = Conexion::listarGastosTransportePagination();
$l2 = Conexion::listarAlumnoPorTutor();
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Consultar Gastos por alumnos
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="#">Gestionar Practicas</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Practicas</h2>
    </div>
</div>

<!-- Seleccionar alumno -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <form action="consultarGastosAlumno" method="POST">
            <label class="text-center">
                Alumno:
                <select name="dniAlumno">                                    
                    <?php
                    foreach ($l2 as $k2) {
                        ?>
                        <option value="<?php echo $k2->dni; ?>"> <?php echo $k2->nombre . ', ' . $k2->apellido; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </label>
            <button type="submit" id="buscar" class="btn btn-sm btn-primary" name="buscar"></button>
        </form>
    </div>
</div>

<!-- Gestionar Gastos Comida -->
<h2 class="text-center">Consultar Gastos Comida</h2>
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>Tipo de gastos</th> <!--  inidica que tipo de gastos tiene este alumno-->
                        <th>Total gasto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    foreach ($gc as $key) {
                        ?>
                    <form action="consultarGastosAlumno" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                            </td>
                            <td><button type="submit" id="editar" class="btn" name="editarC" /></td>
                            <td><button type="submit" id="eliminar" class="btn" name="eliminarC" /></td>
                        </tr>
                    </form>
                    <?php
//                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  
<!-- Gestionar Gastos Transporte -->
<h2 class="text-center">Consultar Gastos Transporte</h2>
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>Tipo de gastos</th> <!--  inidica que tipo de gastos tiene este alumno-->
                        <th>Total gasto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    foreach ($gt as $key) {
                        ?>
                    <form action="consultarGastosAlumno" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                            </td>
                            <td><button type="submit" id="editar" class="btn" name="editarT" /></td>
                            <td><button type="submit" id="eliminar" class="btn" name="eliminarT" /></td>
                        </tr>
                    </form>
                    <?php
//                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection