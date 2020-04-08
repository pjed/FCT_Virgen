$(document).ready(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
    });
    $(".modificar").click(function () {
        var practica = null;
        var key = null;
        var idPractica = $(".modificar").val();
//        var idPractica = $(this).attr('data-id');
        var dniResponsable = null;
        var idEmpresa = null;
        var dniAlumno = null;
        var parametros = {'idPractica': idPractica};
        $.ajax({
            url: 'modalModificarPracticaAyax',
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
            url: 'listarResponsablesAyax',
            data: parametros,
            type: 'POST',
            success: function (res) {
                alert(res);
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
            url: 'listarEmpresasAyax',
            data: parametros,
            type: 'POST',
            success: function (res) {
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
            url: 'listarAlumnoPorTutorAyax',
            data: parametros,
            type: 'POST',
            success: function (res) {
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
     $(".dniAlumno").blur(function () {
        if ($(".dniAlumno").val() !== "selected") {
            $(".dniAlumno").css({'border-color': 'red'});
        } else {
            $(".dniAlumno").css({'border-color': 'black'});
        }
    });
    $(".idResponsableModalAniadir").blur(function () {
        if ($(".idResponsable").val() !== "selected") {
            $(".idResponsable").css({'border-color': 'red'});
        }
    });

    $(".fechaFin").blur(function () {
        if ($(".fechaFin").val() === "") {
            $(".fechaFin").css({'border-color': 'red'});
        } else {
            $(".fechaFin").css({'border-color': 'black'});
        }
    });
    $(".fechaInicio").blur(function () {
        if ($(".fechaInicio").val() === "") {
            $(".fechaInicio").css({'border-color': 'red'});
        } else {
            $(".fechaInicio").css({'border-color': 'black'});
        }
    });
    $(".apto").blur(function () {
        if ($(".apto").val() !== "checked") {
            $(".apto").css({'border-color': 'red'});
        } else {
            $(".apto").css({'border-color': 'black'});
        }
    });
    $(".gasto").blur(function () {
        if ($(".gasto").val() === "") {
            $(".gasto").css({'border-color': 'red'});
        } else {
            $(".gasto").css({'border-color': 'black'});
        }
    });
    $(".codProyecto").blur(function () {
        if ($(".codProyecto").val() === "") {
            $(".codProyecto").css({'border-color': 'red'});
        } else {
            $(".codProyecto").css({'border-color': 'black'});
        }
    });
});