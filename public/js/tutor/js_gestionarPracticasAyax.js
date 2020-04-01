/**
 * 
 *  @author marina
 */
$(document).ready(function () {

    $(".idEmpresa").blur(function () {
        if ($(".idEmpresa").val() !== "selected") {
            $(".idEmpresa").css({'border-color': 'red'});
        } else {
            empresa = $(".idEmpresa").val();
            $.ajax({
                url: 'listarResponsablesAyax',
                type: 'POST',
                data: {'empresa': empresa},
                success: function (res) {
                    alert('asd');
                    if (res !== null) {
                         $(".idResponsable").empty();
                        for (var i = 0; i < res.length; i++) {
                            $(".idResponsable").append( '<option value="'+res[i].id+'">'+res[i].nombre + ', ' +res[i].apellidos+'></option>');
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
            $(".idEmpresa").css({'border-color': 'black'});
        }
    });
    $(".dniAlumno").blur(function () {
        if ($(".dniAlumno").val() !== "selected") {
            $(".dniAlumno").css({'border-color': 'red'});
        } else {
            $(".dniAlumno").css({'border-color': 'black'});
        }
    });
    $(".idResponsable").blur(function () {
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
    $(".").blur(function () {
        if ($(".").val() === "") {
            $(".").css({'border-color': 'red'});
        } else {
            $(".").css({'border-color': 'black'});
        }
    });
});