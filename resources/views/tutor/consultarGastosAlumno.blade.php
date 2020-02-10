
<?php

use App\Auxiliar\Conexion;

$l2 = Conexion::listarAlumnoPorTutor();
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Consultar Gastos Alumnos
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="#">Consultar Gastos Alumnos</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md">
        <h2 class="text-center">Consultar Gastos Alumnos</h2>
    </div>
</div>

<!-- Seleccionar alumno -->
<div class="row justify-content-center">
    <div class="col-sm-4 col-md-4">
        <form action="consultarGastosAlumno" method="POST">
            {{ csrf_field() }}
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
            <button type="submit" id="buscar" class=" btn-sm btn-sm btn-primary" name="buscar"></button>
        </form>
    </div>
</div>
@if ($gc !=null) 
<!-- Gestionar Gastos Comida -->
<h2 class="text-center">Consultar Gastos Comida</h2>
<div class="row">
    <div class="col-sm col-md">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>Fecha</th>
                        <th>Importe</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($gc as $key) {
                        ?>
                    <form action="consultarGastosAlumno" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm form-control-md" name="fecha" value="<?php echo $key->fecha; ?>" readonly/>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->id; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="importe" value="<?php echo $key->importe; ?>" readonly/></td>
                            <td><img <?php echo $key->foto; ?>/></td>
                            <td><input type="submit" id="revisar" class=" btn-sm btn-primary" name="revisar" value="Revisar" /></td>
                        </tr>
                    </form>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  
@endif

@if ($gtc !=null) 
<!-- Gestionar Gastos Transporte  Colectivo-->
<div id="colectivo" class="row">
    <div class="col-sm col-md">
        <h2 class="text-center">Consultar Gastos Transporte Colectivo</h2>
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr> 
                        <th>Donde es</th>
                        <th>Nº dias</th>                        
                        <th>Foto</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($gtc as $key) {
                        ?>
                    <form action="consultarGastosAlumno" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>" readonly/>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idColectivos; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="n_diasC" value="<?php echo $key->n_diasC; ?>" readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="precio" value="<?php echo $key->precio; ?>" readonly/></td>
                            <td><img <?php echo $key->foto; ?>/></td>
                            <td><input type="submit" id="revisar" class=" btn-sm btn-primary" name="revisar" value="Revisar" /></td>
                        </tr>
                    </form>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endif

@if ($gtp !=null) 
<!-- Gestionar Gastos Transporte  Propio-->
<div id="propio" class="row">
    <div class="col-sm col-md">
        <h2 class="text-center">Consultar Gastos Transporte Propio</h2>
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>   
                        <th>Donde es</th>
                        <th>Nº dias</th>                        
                        <th>KMS</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($gtp as $key) {
                        ?>
                    <form action="consultarGastosAlumno" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>" readonly/>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idPropios; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="n_diasP" value="<?php echo $key->n_diasP; ?>" readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="kms" value="<?php echo $key->kms; ?>" readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="precio" value="<?php echo $key->precio; ?>" readonly/></td>
                            <td><input type="submit" id="revisar" class=" btn-sm btn-primary" name="revisar" value="Revisar" /></td>
                        </tr>
                    </form>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endif
@endsection
