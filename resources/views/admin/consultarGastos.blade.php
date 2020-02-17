<?php

use App\Auxiliar\Conexion;

if (isset($_SESSION['ciclo'])) {
    $ciclo = session()->get('ciclo');
} else {
    $ciclo = null;
}
if (isset($_SESSION['dniAlumno'])) {
    $dniAlumno = session()->get('dniAlumno');
    $l2 = Conexion::listarAlumnosCurso($ciclo);
} else {
    $dniAlumno = null;
}
if (isset($_GET['page'])) {
    $l1 = Conexion::listaCursos();
    $dniAlumno = session()->get('dniAlumno');
    $desplazamiento = session()->get('desplazamiento');
    $tipo = session()->get('tipo');
    if ($desplazamiento == 1) {
        if ($tipo == 1) {
            $gtp = null;
            $gtc = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);
        } else {
            $gtc = null;
            $gtp = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);
        }
    } else {
        $gtc = null;
        $gtp = null;
    }
    $gc = Conexion::listarGastosComidasPagination($dniAlumno);
    $datos = [
        'l1' => $l1,
        'l2' => null,
        'gc' => $gc,
        'gtp' => $gtp,
        'gtc' => $gtc,
    ];
}
?>
@extends('maestra.maestraAdmin')

@section('titulo') 
Consultar Gastos Alumnos
@endsection

@section('contenido') 
<div class="container">
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Consultar Gastos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md">
            <h2 class="text-center">Consultar Gastos</h2>
        </div>
    </div>

    <!-- Seleccionar curso -->
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-4">
            <form action="consultarGastos" method="POST">
                {{ csrf_field() }}
                <label class="text-center" for='ciclo'>
                    Ciclo:
                    <select name="ciclo">  
                        <?php
                        foreach ($l1 as $value) {
                            ?>
                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == $ciclo) { ?>selected<?php } ?>><?php echo $value->id; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label> 
                <button type="submit" id="buscar" class=" btn-sm-sm btn-sm-sm btn-sm-primary" name="buscar"></button>
            </form>
        </div>
    </div>
    @if ($l2 !=null) 
    <!-- Seleccionar alumno -->
    <div class="row justify-content-center">
        <div class="col-sm-5 col-md-5">
            <form action="consultarGastos" method="POST">
                {{ csrf_field() }}
                <label class="text-center">
                    Alumno:
                    <select name="dniAlumno">                                    
                        <?php
                        foreach ($l2 as $k2) {
                            ?>
                            <option value="<?php echo $k2->dni; ?>" <?php if ($k2->dni == $dniAlumno) { ?>selected<?php } ?>> <?php echo $k2->nombre . ', ' . $k2->apellidos; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
                <button type="submit" id="buscar" class=" btn-sm-sm btn-sm-sm btn-sm-primary" name="buscar1"></button>
            </form>
        </div>
    </div>
    @endif
    @if ($gc !=null) 
    <!-- Gestionar Gastos Comida -->
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
                    <tbody>

                        <?php
                        foreach ($gc as $key) {
                            ?>
                        <form action="consultarGastos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idGasto" value='<?php echo $key->idGasto; ?>' readonly>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="fecha" value="<?php echo $key->fecha; ?>"/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->id; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm" name="importe" value="<?php echo $key->importe; ?>"/></td>
                                <td>
                                    <?php echo '<img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?>
                                </td>
                                <td><button type="submit" id="editar" class="btn-sm" name="editar"></button></td>
                                <td><button type="submit" id="eliminar" class="btn-sm" name="eliminar"></button></td> 
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
    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">
            {{ $gc->links()}}
        </div>
    </div>
    @endif

    @if ($gtc !=null) 
    <!-- Gestionar Gastos Transporte  Colectivo-->
    <div id="colectivo" class="row justify-content-center">
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
                        <form action="consultarGastos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' readonly>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>"/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idColectivos; ?>" readonly/>
                                </td>
                                <td><input type="number" class="form-control form-control-sm" name="n_diasC" value="<?php echo $key->n_diasC; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm" name="precio" value="<?php echo $key->precio; ?>"/></td>
                                <td>
                                    <?php echo '<img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?>
                                </td>
                                <td><button type="submit" id="editar" class="btn-sm" name="editarC"></button></td>
                                <td><button type="submit" id="eliminar" class="btn-sm" name="eliminarC"></button></td>
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
    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">
            {{ $gtc->links()}}
        </div>
    </div>
    @endif

    @if ($gtp !=null) 
    <!-- Gestionar Gastos Transporte  Propio-->
    <div id="propio" class="row justify-content-center">
        <div class="col-sm col-md">
            <h2 class="text-center">Consultar Gastos Transporte Propio</h2>
            <div class="table-responsive ">
                <table class="table  table-sm  table-striped  table-hover table-bordered">
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
                        <form action="consultarGastos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' readonly>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>"/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idPropios; ?>" readonly/>
                                </td>
                                <td><input type="number" class="form-control form-control-sm" name="n_diasP" value="<?php echo $key->n_diasP; ?>"/></td>
                                <td><input type="number" class="form-control form-control-sm" name="kms" value="<?php echo $key->kms; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm" name="precio" value="<?php echo $key->precio; ?>"/></td>
                                <td><button type="submit" id="editar" class="btn-sm" name="editarP"></button></td>
                                <td><button type="submit" id="eliminar" class="btn-sm" name="eliminarP"></button></td>
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
    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">
            {{ $gtp->links()}}
        </div>
    </div>
    @endif
</div>
@endsection