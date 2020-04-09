$(document).ready(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
    });
//cargar ventana modal modificar
    $(".modificar").click(function () {
        var practica = null;
        var key = null;
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
                practica = JSON.parse(res);
                if (practica !== null) {
//                        alert('entro en buscar practica por id');
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
                    for (var i = 0; i < listaEmpresa.length; i++) {
                        if (idEmpresa === listaEmpresa[i].id) {
                            document.getElementById("idEmpresaMod").innerHTML += '<option value="' + listaEmpresa[i].id + '" selected>' + listaEmpresa[i].nombre + '</option>';
                        } else {
                            document.getElementById("idEmpresaMod").innerHTML += '<option value="' + listaEmpresa[i].id + '">' + listaEmpresa[i].nombre + '</option>';
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
    $("#idEmpresaA").blur(function () {
        if ($("#idEmpresaA").val() !== "selected") {
            $("#idEmpresaA").css({'border-color': 'red'});
        } else {
            $("#idEmpresaA").css({'border-color': 'black'});
        }
    });
    $("#dniAlumnoA").blur(function () {
        if ($("#dniAlumnoA").val() !== "selected") {
            $("#dniAlumnoA").css({'border-color': 'red'});
        } else {
            $("#dniAlumnoA").css({'border-color': 'black'});
        }
    });
    $("#idResponsableAniadir").blur(function () {
        if ($("#idResponsableAniadir").val() !== "selected") {
            $("#idResponsableAniadir").css({'border-color': 'red'});
        } else {
            $("#idResponsableAniadir").css({'border-color': 'black'});
        }
    });
    $("#fechaFinA").blur(function () {
        if ($("#fechaFinA").val() === "") {
            $("#fechaFinA").css({'border-color': 'red'});
        } else {
            $("#fechaFinA").css({'border-color': 'black'});
        }
    });
    $("#fechaInicioA").blur(function () {
        if ($("#fechaInicioA").val() === "") {
            $("#fechaInicioA").css({'border-color': 'red'});
        } else {
            $("#fechaInicioA").css({'border-color': 'black'});
        }
    });
    $("#aptoA").blur(function () {
        if ($("#aptoA").val() !== "checked") {
            $("#aptoA").css({'border-color': 'red'});
        } else {
            $("#aptoA").css({'border-color': 'black'});
        }
    });
    $("#gastoA").blur(function () {
        if ($("#gastoA").val() === "") {
            $("#gastoA").css({'border-color': 'red'});
        } else {
            $("#gastoA").css({'border-color': 'black'});
        }
    });
    $("#codProyectoA").blur(function () {
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
    $("#idEmpresaMod").blur(function () {
        if ($("#idEmpresaMod").val() !== "selected") {
            $("#idEmpresaMod").css({'border-color': 'red'});
        } else {
            $("#idEmpresaMod").css({'border-color': 'black'});
        }
    });
    $("#dniAlumnoMod").blur(function () {
        if ($("#dniAlumnoMod").val() !== "selected") {
            $("#dniAlumnoMod").css({'border-color': 'red'});
        } else {
            $("#dniAlumnoMod").css({'border-color': 'black'});
        }
    });
    $("#idResponsableMod").blur(function () {
        if ($("#idResponsableMod").val() !== "selected") {
            $("#idResponsableMod").css({'border-color': 'red'});
        } else {
            $("#idResponsableMod").css({'border-color': 'black'});
        }
    });
    $("#fechaFinMod").blur(function () {
        if ($("#fechaFinMod").val() === "") {
            $("#fechaFinMod").css({'border-color': 'red'});
        } else {
            $("#fechaFinMod").css({'border-color': 'black'});
        }
    });
    $("#fechaInicioMod").blur(function () {
        if ($("#fechaInicioMod").val() === "") {
            $("#fechaInicioMod").css({'border-color': 'red'});
        } else {
            $("#fechaInicioMod").css({'border-color': 'black'});
        }
    });
    $("#aptoMod").blur(function () {
        if ($("#aptoMod").val() !== "checked") {
            $("#aptoMod").css({'border-color': 'red'});
        } else {
            $("#aptoMod").css({'border-color': 'black'});
        }
    });
    $("#gastoMod").blur(function () {
        if ($("#gastoMod").val() === "") {
            $("#gastoMod").css({'border-color': 'red'});
        } else {
            $("#gastoMod").css({'border-color': 'black'});
        }
    });
    $("#codProyectoMod").blur(function () {
        if ($("#codProyectoMod").val() === "") {
            $("#codProyectoMod").css({'border-color': 'red'});
        } else {
            $("#codProyectoMod").css({'border-color': 'black'});
        }
    });
});