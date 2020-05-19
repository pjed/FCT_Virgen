/**
 *  @author marina
 */
$(document).ready(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
    });
//cargar ventana modal modificar
    $(".modificar").click(function () {
        var practica = null;
//        var idPractica = $(".modificar").val();
        var idPractica = $(this).attr('data-id');
        var dniResponsable = null;
        var idEmpresa = null;
        var dniAlumno = null;
        var parametros = {'idPractica': idPractica};
        $.ajax({
            url: 'modalModificarPracticaAjax',
            data: parametros,
            type: 'POST',
            success: function (res) {
                if (res !== null) {
                    practica = JSON.parse(res);
                    dniResponsable = practica.idResponsable;
                    idEmpresa = practica.idEmpresa;
                    dniAlumno = practica.dniAlumno;
                    $("#idMod").val(practica.idPractica);
                    $("#codProyectoMod").val(practica.codProyecto);
                    $("#gastoMod").val(practica.gasto);
                    $("#aptoMod").val(practica.apto);
                    $("#fechaInicioMod").val(practica.fechaInicio);
                    $("#fechaFinMod").val(practica.fechaFin);
                    listarEmpresas(idEmpresa);
                    listarResponsables(dniResponsable, idEmpresa);
                    listarAlumnos(dniAlumno);
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    });
    function listarResponsables(dniResponsable, idEmpresa) {
        var listarResponsable = null;
        var parametros = {'idEmpresa': idEmpresa};
        // sacamos  Conexion::listarResponsablesEmpresa(idEmpresa);
        $.ajax({
            url: 'listarResponsablesAjax',
            data: parametros,
            type: 'POST',
            success: function (res) {
                $("#idResponsableMod").empty();
//                alert(res);
                if (res !== null) {
                    listarResponsable = JSON.parse(res);
                    if (dniResponsable === 0) {
                        document.getElementById("idResponsableMod").innerHTML += ' <option value="0" selected>Ninguno</option>';
                    }
                    for (var i = 0; i < listarResponsable.length; i++) {
                        if (dniResponsable === listarResponsable[i].id) {
                            document.getElementById("idResponsableMod").innerHTML += ' <option value="' + listarResponsable[i].id + '" selected>' + listarResponsable[i].nombre + ', ' + listarResponsable[i].apellidos + '</option>';
                        } else {
                            document.getElementById("idResponsableMod").innerHTML += ' <option value="' + listarResponsable[i].id + '">' + listarResponsable[i].nombre + ', ' + listarResponsable[i].apellidos + '</option>';
                        }
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    }
    function listarEmpresas(idEmpresa) {
        var listaEmpresa = null;
        var parametros = {'parametro': null};
        // sacamos Conexion::listarEmpresas();
        $.ajax({
            url: 'listarEmpresasAjax',
            data: parametros,
            type: 'POST',
            success: function (res) {
                $("#idEmpresaMod").empty();
//                alert(res);
                if (res !== null) {
                    listaEmpresa = JSON.parse(res);
                    if (idEmpresa === 0) {
                        document.getElementById("idEmpresaMod").innerHTML += ' <option value="0" selected>Ninguno</option>';
                    }
                    for (var i = 0; i < listaEmpresa.length; i++) {
                        if (idEmpresa === listaEmpresa[i].id) {
                            document.getElementById("idEmpresaMod").innerHTML += '<option value="' + listaEmpresa[i].id + '" selected>' + listaEmpresa[i].nombre_empresa + '</option>';
                        } else {
                            document.getElementById("idEmpresaMod").innerHTML += '<option value="' + listaEmpresa[i].id + '">' + listaEmpresa[i].nombre_empresa + '</option>';
                        }
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    }
    function listarAlumnos(dniAlumno) {
        var listaAlumnoPractica = null;
        var parametros = {'parametro': null};
        // sacamos  Conexion::listarAlumnoPorTutor();
        $.ajax({
            url: 'listarAlumnoPorTutorAjax',
            data: parametros,
            type: 'POST',
            success: function (res) {
                $("#dniAlumnoMod").empty();
//                    alert(res);
                if (res !== null) {
                    listaAlumnoPractica = JSON.parse(res);
                    for (var i = 0; i < listaAlumnoPractica.length; i++) {
                        if (dniAlumno === listaAlumnoPractica[i].dni) {
                            document.getElementById("dniAlumnoMod").innerHTML += ' <option value="' + listaAlumnoPractica[i].dni + '" selected>' + listaAlumnoPractica[i].nombre + ', ' + listaAlumnoPractica[i].apellidos + '</option>';
                        } else {
                            document.getElementById("dniAlumnoMod").innerHTML += ' <option value="' + listaAlumnoPractica[i].dni + '">' + listaAlumnoPractica[i].nombre + ', ' + listaAlumnoPractica[i].apellidos + '</option>';
                        }
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    }

//ventana modal añadir
    $("#idEmpresaA").click(function () {/*si selecionas una empresa te tiene que aparecer un select con sus responsables*/
        var listarResponsable = null;
        var idEmpresa = $("#idEmpresaA").val();
        var parametros = {'idEmpresa': idEmpresa};
        $.ajax({
            url: 'idEmpresaAniadirPracticasAjax',
            type: 'POST',
            data: parametros,
            success: function (res) {
                $("#idResponsableA").empty();
//                alert(res);
                if (res !== null) {
                    listarResponsable = JSON.parse(res);
                    for (var i = 0; i < listarResponsable.length; i++) {
                        document.getElementById("idResponsableA").innerHTML += ' <option value="' + listarResponsable[i].id + '">' + listarResponsable[i].nombre + ', ' + listarResponsable[i].apellidos + '</option>';
                    }
                }
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    });
    $("#idEmpresaA").click(function () {
        if ($("#idEmpresaA").val() === "selected") {
            $("#idEmpresaA").css({'border-color': 'black'});
        } else {
            $("#idEmpresaA").css({'border-color': 'red'});
        }
    });
    $("#dniAlumnoA").click(function () {
        if ($("#dniAlumnoA").val() === "selected") {
            $("#dniAlumnoA").css({'border-color': 'black'});
        } else {
            $("#dniAlumnoA").css({'border-color': 'red'});
        }
    });
    $("#idResponsableAniadir").click(function () {
        if ($("#idResponsableAniadir").val() === "selected") {
            $("#idResponsableAniadir").css({'border-color': 'black'});
        } else {
            $("#idResponsableAniadir").css({'border-color': 'red'});
        }
    });
    $("#fechaFinA").click(function () {
        if ($("#fechaFinA").val() === "") {
            $("#fechaFinA").css({'border-color': 'red'});
        } else {
            $("#fechaFinA").css({'border-color': 'black'});
        }
    });
    $("#fechaInicioA").click(function () {
        if ($("#fechaInicioA").val() === "") {
            $("#fechaInicioA").css({'border-color': 'red'});
        } else {
            $("#fechaInicioA").css({'border-color': 'black'});
        }
    });
    $("#aptoA").click(function () {
        if ($("#aptoA").val() !== "checked") {
            $("#aptoA").css({'border-color': 'red'});
        } else {
            $("#aptoA").css({'border-color': 'black'});
        }
    });
    $("#gastoA").click(function () {
        if ($("#gastoA").val() === "") {
            $("#gastoA").css({'border-color': 'red'});
        } else {
            $("#gastoA").css({'border-color': 'black'});
        }
    });
    $("#codProyectoA").click(function () {
        if ($("#codProyectoA").val() === "") {
            $("#codProyectoA").css({'border-color': 'red'});
        } else {
            $("#codProyectoA").css({'border-color': 'black'});
        }
    });

//ventana modal modificar
    $("#idEmpresaMod").click(function () {
        var idEmpresa = $("#idEmpresaMod").val();
        var listarResponsable = null;
        var parametros = {'idEmpresa': idEmpresa};
        $.ajax({
            url: 'idEmpresaAniadirPracticasAjax',
            type: 'POST',
            data: parametros,
            success: function (res) {
                $("#idResponsableMod").empty();
//                alert(res);
                if (res !== null) {
                    listarResponsable = JSON.parse(res);
                    for (var i = 0; i < listarResponsable.length; i++) {
                        document.getElementById("idResponsableMod").innerHTML += ' <option value="' + listarResponsable[i].id + '">' + listarResponsable[i].nombre + ', ' + listarResponsable[i].apellidos + '</option>';
                    }
                } 
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
            error: function (x, xs, xt) {
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
        });
    });
    $("#idEmpresaMod").click(function () {
        if ($("#idEmpresaMod").val() !== "selected") {
            $("#idEmpresaMod").css({'border-color': 'red'});
        } else {
            $("#idEmpresaMod").css({'border-color': 'black'});
        }
    });
    $("#dniAlumnoMod").click(function () {
        if ($("#dniAlumnoMod").val() !== "selected") {
            $("#dniAlumnoMod").css({'border-color': 'red'});
        } else {
            $("#dniAlumnoMod").css({'border-color': 'black'});
        }
    });
    $("#idResponsableMod").click(function () {
        if ($("#idResponsableMod").val() !== "selected") {
            $("#idResponsableMod").css({'border-color': 'red'});
        } else {
            $("#idResponsableMod").css({'border-color': 'black'});
        }
    });
    $("#fechaFinMod").click(function () {
        if ($("#fechaFinMod").val() === "") {
            $("#fechaFinMod").css({'border-color': 'red'});
        } else {
            $("#fechaFinMod").css({'border-color': 'black'});
        }
    });
    $("#fechaInicioMod").click(function () {
        if ($("#fechaInicioMod").val() === "") {
            $("#fechaInicioMod").css({'border-color': 'red'});
        } else {
            $("#fechaInicioMod").css({'border-color': 'black'});
        }
    });
    $("#aptoMod").click(function () {
        if ($("#aptoMod").val() !== "checked") {
            $("#aptoMod").css({'border-color': 'red'});
        } else {
            $("#aptoMod").css({'border-color': 'black'});
        }
    });
    $("#gastoMod").click(function () {
        if ($("#gastoMod").val() === "") {
            $("#gastoMod").css({'border-color': 'red'});
        } else {
            $("#gastoMod").css({'border-color': 'black'});
        }
    });
    $("#codProyectoMod").click(function () {
        if ($("#codProyectoMod").val() === "") {
            $("#codProyectoMod").css({'border-color': 'red'});
        } else {
            $("#codProyectoMod").css({'border-color': 'black'});
        }
    });
});