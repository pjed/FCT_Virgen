/**
 * 
 *  @author marina
 */
$(document).ready(function () {
    var ciclo = null;
    var dniAlumno = null;
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
    });
    /*
     * funciona cuando se selecciona un ciclo y muestra la lista de los alumnos de es curso
     * @param {type} listaCiclo
     * @return {undefined}
     */
    $("#ciclo").click(function () {
        ciclo = $("select#ciclo option:checked").val();
        var parametros = {"ciclo": ciclo};
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
    $("#dniAlumno").click(function () {
        dniAlumno = $("select#dniAlumno option:checked").val();
        var parametros = {"dniAlumno": dniAlumno};
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
    $(".editarCol").click(function () {
        var id = $(this).attr('data-id');
        var parametros = {
            "idTransporte": id,
            "tipo": 'colectivo'
        };
        $.ajax({
            url: 'buscarGastoAjax',
            type: 'POST',
            data: parametros,
            success: function (response) {
                if (response !== null) {
                    alert('entro');
                    var colectivo = JSON.parse(response);
                    for (var i = 0; i < colectivo.length; i++) {
                        $("#idTransporteCol").val(colectivo.idTransporte);
                        $("#dondeCol").val(colectivo.donde);
                        $("#IDCol").val(colectivo.id);
                        $("#precioCol").val(colectivo.precio);
                        document.getElementById("fotoCol").innerHTML += '<input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="' + colectivo.foto + '"/><a href="' + colectivo.foto + '" target="_blank">  <img name="ticketGasto" class="foto_small" src="' + colectivo.foto + '"/> </a>';
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            }
        });
    });
    $(".eliminarCol").click(function () {
        var id = $(this).attr('data-id');
        var dniAlumno = $("select#dniAlumno option:checked").val();
        var parametros = {
            "idTransporte": id,
            "eliminarCol": 'eliminarCol',
            "dniAlumno" : dniAlumno
        };
        $.ajax({
            url: 'gestionarGastosAjax',
            type: 'POST',
            data: parametros,
            success: function (response) {
                if (response !== null) {
                    alert('entro');
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
    $(".editarP").click(function () {
        var id = $(this).attr('data-id');
        var parametros = {
            "idTransporte": id,
            "tipo": 'propio'
        };
        $.ajax({
            url: 'buscarGastoAjax',
            type: 'POST',
            data: parametros,
            success: function (response) {
                if (response !== null) {
                    alert('entro');
                    var propio = JSON.parse(response);
                    for (var i = 0; i < propio.length; i++) {
                        $("#idTransporteP").val(propio.idTransporte);
                        $("#dondeP").val(propio.donde);
                        $("#IDP").val(propio.id);
                        $("#precioP").val(propio.precio);
                        $("#kmsP").val(propio.kms);
                    }
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
        var id = $(this).attr('data-id');
        var dniAlumno = $("select#dniAlumno option:checked").val();
        var parametros = {
            "idTransporte": id,
            "eliminarP": 'eliminarP',
            "dniAlumno" : dniAlumno
        };
        $.ajax({
            url: 'gestionarGastosAjax',
            type: 'POST',
            data: parametros,
            success: function (response) {
                if (response !== null) {
                    alert('entro');
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
    $(".editarCom").click(function () {
        var id = $(this).attr('data-id');
        parametros = {
            "idGasto": id,
            "tipo": 'comida'
        };
        $.ajax({
            url: 'buscarGastoAjax',
            type: 'POST',
            data: parametros,
            success: function (response) {
                if (response !== null) {
                    alert('entro');
                    var comida = JSON.parse(response);
                    for (var i = 0; i < comida.length; i++) {
                        $("#fechaCom").val(comida.fecha);
                        $("#precioCom").val(comida.importe);
                        $("#IDCom").val(comida.id);
                        $("#idGasto").val(comida.idGasto);
                        document.getElementById("fotoCom").innerHTML += '<input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="' + comida.foto + '"/><a href="' + comida.foto + '" target="_blank">  <img name="ticketGasto" class="foto_small" src="' + comida.foto + '"/> </a>';
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            }
        });
    });
    $(".eliminarCom").click(function () {
        var id = $(this).attr('data-id');
        var dniAlumno = $("select#dniAlumno option:checked").val();
        //        1º con el idGasto buscamos el idComida correspondiente
        //        2º eliminamos el idComida
        //        3º eliminamos el IdGatos
        //        4º enviamos el html para mostrar la tabla cargada con los nuevos datos
        var parametros = {
            "idGasto": id,
            "eliminarCom": 'eliminarCom',
            "dniAlumno" : dniAlumno
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