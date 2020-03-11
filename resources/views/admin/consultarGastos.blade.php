<?php

$ciclo = null;
$dniAlumno = null;
if (session()->get('ciclo') != null) {
    $ciclo = session()->get('ciclo');
}
if (session()->get('dniAlumno') != null) {
    $dniAlumno = session()->get('dniAlumno');
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
        <div class="col-sm-3 col-md-3">
            <form action="consultarGastos" method="POST">
                {{ csrf_field() }}
                <label class="text-center" for='ciclo'>
                    Ciclo:
                    <select class="sel" name="ciclo">  
                        <?php
                        foreach ($l1 as $value) {
                            ?>
                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == $ciclo) { ?>selected<?php } ?>><?php echo $value->id; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label> 
                <button type="submit" class="buscar btn btn-primary" name="buscar"></button>
            </form>
        </div>
    </div>
    @if ($l2 !=null) 
    <!-- Seleccionar alumno -->
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3">
            <form action="consultarGastos" method="POST">
                {{ csrf_field() }}
                <label class="text-center">
                    Alumno:
                    <select class="sel" name="dniAlumno">                                    
                        <?php
                        foreach ($l2 as $k2) {
                            ?>
                            <option value="<?php echo $k2->dni; ?>" <?php if ($k2->dni == $dniAlumno) { ?>selected<?php } ?>> <?php echo $k2->nombre . ', ' . $k2->apellidos; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
                <button type="submit" class="buscar btn btn-primary" name="buscar1"></button>
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
                <table class="table table-sm table-striped  table-hover table-bordered">
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
                        <form action="consultarGastos" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idGasto" value='<?php echo $key->idGasto; ?>'>
                                    <input type="date" class="form-control form-control-sm form-control-md" name="fecha" value="<?php echo $key->fecha; ?>"/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->id; ?>"/>
                                </td>
                                <td><input type="number" step="0.01" class="form-control form-control-sm" name="importe" value="<?php echo $key->importe; ?>" max="9" min="0"/></td>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $key->foto; ?>"/>
                                    <a  href="<?php echo $key->foto; ?>" target="_blank"> <?php echo '<img alt="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?></a>
                                    <input type="file" class="form-control form-control-sm form-control-md" name="foto">
                                </td>
                                <td>
                                    <button type="submit" class="btn editar" name="editar" ></button>
                                         <!-- </td><td>-->
                                    <button type="submit" class="btn eliminar" name="eliminar" ></button>
                                </td>
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
                <table class="table table-sm table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr> 
                            <th>Donde es</th>   
                            <th>Importe</th>                     
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($gtc as $key) {
                            ?>
                        <form action="consultarGastos" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' />
                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>" readonly/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idColectivos; ?>" />
                                </td>
                                <td><input type="number" step="0.01" min="0" class="form-control form-control-sm" name="precio" value="<?php echo $key->precio; ?>"/></td>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $key->foto; ?>" />
                                    <a  href="<?php echo $key->foto; ?>" target="_blank"> <?php echo '<img alt="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?></a>
                                    <input type="file" class="form-control form-control-sm form-control-md" name="foto">
                                </td>
                                <td>
                                    <button type="submit" class="btn editar" name="editarC" ></button>
                                         <!-- </td><td>-->
                                    <button type="submit" class="btn eliminar" name="eliminarC" ></button>
                                </td>
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
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' >
                                    <input type="text" class="form-control form-control-sm form-control-md" name="donde" value="<?php echo $key->donde; ?>" readonly/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idPropios; ?>" />
                                </td>
                                <td><input type="number" min="0" step="0.01" class="form-control form-control-sm" name="kms" value="<?php echo $key->kms; ?>"/></td>
                                <td><input type="number" step="0.01" class="form-control form-control-sm" name="precio" value="<?php echo $key->precio; ?>" readonly/></td>
                                <td>
                                    <button type="submit" class="btn editar" name="editarP" ></button>
                                         <!-- </td><td>-->
                                    <button type="submit" class="btn eliminar" name="eliminarP" ></button>
                                </td>
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
