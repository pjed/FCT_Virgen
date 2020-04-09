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
        var foto = null;
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
        $(document).on("click", "#editarC", function () {
//        $("#editarC").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            var n_diasC = $('#n_diasC').val();
            var importe = $('#importe').val();
            foto = $('#foto').val();
            var fotoUrl = $('#fotoUrl').val();
            parametros = {
                "_token": token,
                "editarC": 'editarC',
                "id": id,
                "idTransporte": idTransporte,
                "n_diasC": n_diasC,
                "importe": importe,
                "foto": foto,
                "fotoUrl": fotoUrl

            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#tablas").empty();
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
        $(document).on("click", "#eliminarC", function () {
//        $("#eliminarC").click(function () {
            var id = $('#ID').val();
            var idTransporte = $('#idTransporte').val();
            var fotoUrl = $('#fotoUrl').val();
            parametros = {
                "_token": token,
                "eliminarC": 'eliminarC',
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
                        $("#tablas").empty();
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
        $(document).on("click", "#editarP", function () {
//        $("#editarP").click(function () {
            var id = $('#ID1').val();
            var idTransporte = $('#idTransporte1').val();
            var n_diasP = $('#n_diasP').val();
            var precio = $('#precio1').val();
            var kms = $('#kms').val();
            parametros = {
                "_token": token,
                "editarP": 'editarP',
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
                        $("#tablas").empty();
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
//        $("#eliminarP").click(function () {
        $(document).on("click", "#eliminarP", function () {
            var id = $('#ID1').val();
            var idTransporte = $('#idTransporte1').val();
            parametros = {
                "_token": token,
                "eliminarP": 'eliminarP',
                "id": id,
                "idTransporte": idTransporte
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#tablas").empty();
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
//        $("#editar").click(function () {
        $(document).on("click", "#editar", function () {
            var id = $('#ID2').val();
            var idGasto = $('#idGasto').val();
            var fecha = $('#fecha').val();
            var importe = $('#importe').val();
            foto = $('#foto1').val();
            var fotoUrl = $('#fotoUrl1').val();
            parametros = {
                "_token": token,
                "editar": 'editar',
                "id": id,
                "idGasto": idGasto,
                "fecha": fecha,
                "importe": importe,
                "foto": foto,
                "fotoUrl": fotoUrl
            };
            $.ajax({
                url: 'gestionarGastosAjax',
                type: 'POST',
                data: parametros,
                success: function (response) {
                    if (response !== null) {
                        $("#tablas").empty();
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
        $(document).on("click", "#eliminar", function () {
//        $("#eliminar").click(function () {
            var id = $('#ID2').val();
            var idGasto = $('#idGasto').val();
            var fotoUrl = $('#fotoUrl1').val();
            parametros = {
                "_token": token,
                "eliminar": 'eliminar',
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
                        $("#tablas").empty();
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
                <label class="text-center">
                    Alumno:
                    <select id="dniAlumno" class="sel" name="dniAlumno">                                    

                    </select>
                </label>
            </div>
        </div>
    </div>
    <div id="tablas">
    </div>
</div>
<!-- Modal  Editar Colectivo -->
<div class="modal fade" id="editarColectivo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center">Modificar Gasto Colectivo</h3>
                <form action="consultarGastos" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Donde:
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="idTransporteCol" name ="idTransporte">
                            <input type="text" class="form-control form-control-sm form-control-md" id="dondeCol" name="donde"/>
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="IDCol" name="ID"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Importe:
                            <input type="number" step="0.01" class="form-control form-control-sm" id="precioCol" name="precio"/></td>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Foto:
                            <div id="fotoCol1">
                                <!--POR JAVASCRIPT-->
<!--                                <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl"/>
                                <a id="afotoCol" href="" target="_blank"> 
                                    <img name="ticketGasto" id="imgfotoCol" class="foto_small" src=""/>
                                </a>-->
                            </div>
                            <input type="file" class="form-control form-control-sm form-control-md"  id="fotoCol" name="foto">
                        </label>
                    </div>
                    <div class="row justify-content-center form-group">
                        <input type="submit" class="btn btn-sm btn-primary" name="editarCol" value="Modificar" />
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Editar Comida -->
<div class="modal fade" id="editarComida" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center">Modificar Gasto Comida</h3>
                <form action="consultarGastos" method="POST">
                    {{ csrf_field() }} 
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Fecha:
                            <input type="date" class="form-control form-control-sm form-control-md" id="fechaCom" name="fecha"/>
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="idGasto" name ="idGasto">
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="IDCom" name="ID"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Importe:
                            <input type="number" step="0.01" class="form-control form-control-sm" id="precioCom" name="importe"/></td>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Foto:
                            <div id="fotoCol1">
                                <!--POR JAVASCRIPT-->
<!--                                <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl"/>
                                <a id="afotoCol" href="" target="_blank"> 
                                    <img name="ticketGasto" id="imgfotoCol" class="foto_small" src=""/>
                                </a>-->
                            </div>
                            <input type="file" class="form-control form-control-sm form-control-md"  id="fotoCol" name="foto">
                        </label>
                    </div>
                    <div class="row justify-content-center form-group">
                        <input type="submit" class="btn btn-sm btn-primary" name="editarCom" value="Modificar" />
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection