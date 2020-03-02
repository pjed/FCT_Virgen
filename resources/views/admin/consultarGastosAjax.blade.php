<?php

use App\Auxiliar\Conexion;
use App\Http\Controllers\controladorAdmin;

if (isset($_SESSION['dniAlumno'])) {
    $dniAlumno = session()->get('dniAlumno');
} else {
    $gc = null;
    $gtp = null;
    $gtc = null;
}
?>
@extends('maestra.maestraAdmin')

@section('titulo') 
Consultar Gastos Alumnos
@endsection

@section('javascript') 
<!--<script src="{{asset ('js/admin/js_consultarGasto.js')}}"></script>-->
<script>
    /**
     * 
     *  @author marina
     */
    $(document).ready(function () {
        var ciclo = null;
        var dniAlumno = null;
        var token = '{{csrf_token()}}';
        var parametros = {
            "_token": token
        };
//    $.ajaxSetup({
//        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
//    });
        /**
         * se carga nada mas iniciar la pagina
         */
        $("#ciclo").ready(function () {
            $.ajax({
                url: 'consultarGastosAjaxCiclo',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#ciclo").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        }
        );
        /*
         * funciona cuando se selecciona un ciclo y muestra la lista de los alumnos de es curso
         * @param {type} listaCiclo
         * @return {undefined}
         */
        $("#ciclo").blur(function () {
            ciclo = $("select#ciclo option:checked").val();
            jQuery(ciclo).load('session_write.php?ciclo=' + ciclo);
            parametros = {
                "_token": token,
                "ciclo": ciclo
            };
            $.ajax({
                url: 'consultarGastosAjaxDniAlumno',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#dniAlumno").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
//        $("#dniAlumno").blur(function () {
//            dniAlumno = $("select#dniAlumno option:checked").val();
//            jQuery(dniAlumno).load('session_write.php?dniAlumno=' + dniAlumno);
//             parametros = {
//                "_token": token
//            };
//            $.ajax({
//                url: 'consultarGastosAjaxTabla',
//                type: 'POST',
//                data: parametros,
//                success: function (response) {
//                    if (response !== null) {
//                        
//                    }
//                },
//                statusCode: {
//                    404: function () {
//                        alert('web not found');
//                    }
//                }
//            });
//        });
    });
</script>
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
            <div id="consultarGastosAjaxCiclo">
                <label class="text-center" for='ciclo'>
                    Ciclo:
                    <select id="ciclo" class="sel" name="ciclo">  

                    </select>
                </label> 
            </div>
        </div>
    </div>
    <!-- Seleccionar alumno -->
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3">
            <div id="consultarGastosAjaxDniAlumno">
                <form action="consultarGastosAjax" method="POST">
                    {{ csrf_field() }}
                    <label class="text-center">
                        Alumno:
                        <select id="dniAlumno" class="sel" name="dniAlumno">                                    

                        </select>
                    </label>
                    <button type="submit" id="buscar" class=" btn-sm-sm btn-sm-sm btn-sm-primary" name="buscar1"></button>
                </form>
            </div>
        </div>
    </div>
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
                        <form action="consultarGastoAjax" method="POST">
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
                        <form action="consultarGastoAjax" method="POST">
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
                                    <a  href="<?php echo $key->foto; ?>" target="_blank"> <?php echo '<img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?></a>
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
                        <form action="consultarGastoAjax" method="POST">
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