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
        //mostrar los gastos del alumno
        $("#dniAlumno").blur(function () {
            dniAlumno = $("select#dniAlumno option:checked").val();
            parametros = {
                "_token": token,
                "dniAlumno": dniAlumno
            };
            $.ajax({
                url: 'muestraConsultarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        //gastos de transtporte colectivo
        $(".editarC").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            var n_diasC = $('#n_diasC').val();
            var precio = $('#precio').val();
            var foto = $('#foto').val();
            parametros = {
                "_token": token,
                "editarC": 'editarC',
                "id": id,
                "idTransporte": idTransporte,
                "n_diasC": n_diasC,
                "precio": precio,
                "foto": foto
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        $(".eliminarC").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            var fotoUrl = $('#fotoUrl').val();
            parametros = {
                "_token": token,
                "editarC": 'eliminarC',
                "id": id,
                "idTransporte": idTransporte,
                "fotoUrl": fotoUrl
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        //gastos de transtporte propio
        $(".editarP").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            var n_diasP = $('#n_diasP').val();
            var precio = $('#precio').val();
            var kms = $('#kms').val();
            parametros = {
                "_token": token,
                "editarC": 'editarP',
                "id": id,
                "idTransporte": idTransporte,
                "n_diasP": n_diasP,
                "precio": precio,
                "kms": kms
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        $(".eliminarP").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            parametros = {
                "_token": token,
                "editarC": 'eliminarP',
                "id": id,
                "idTransporte": idTransporte
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        //gastos de comida
        $(".editar").click(function () {
            var id = $('#ID').val();
            var idGasto = $('#idGasto').val();
            var fecha = $('#fecha').val();
            var importe = $('#importe').val();
            var foto = $('#foto').val();
            parametros = {
                "_token": token,
                "editarC": 'editar',
                "id": id,
                "idGasto": idGasto,
                "fecha": fecha,
                "importe": importe,
                "foto": foto
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
        $(".eliminar").click(function () {
            var id = $('#ID').val();
            var idGasto = $('#idGasto').val();
            var fotoUrl = $('#fotoUrl').val();
            parametros = {
                "_token": token,
                "editarC": 'eliminar',
                "id": id,
                "idGasto": idGasto,
                "fotoUrl": fotoUrl
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $$("#tablas").empty();
                        $("#tablas").html(response);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                }
            });
        });
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
                </form>
            </div>
        </div>
    </div>
    <div id="tablas">
    </div>
</div>
@endsection