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
    /**
     * se carga nada mas iniciar la pagina
     */
    $("#ciclo").ready(function () {
        $.ajax({
            url: 'consultarGastosAjaxCiclo',
            type: 'POST',
            data: {'parametros': null},
            success: function (response) {
                alert('asd');
                if (response !== null) {
                    $("#ciclo").html(response);
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
    );
    /*
     * funciona cuando se selecciona un ciclo y muestra la lista de los alumnos de es curso
     * @param {type} listaCiclo
     * @return {undefined}
     */
    $("#ciclo").blur(function () {
        ciclo = $("select#ciclo option:checked").val();
        jQuery(ciclo).load('session_write.php?ciclo=' + ciclo);
        var parametros = {
            "ciclo": ciclo
        };
        $.ajax({
            url: 'consultarGastosAjaxDniAlumno',
            data: parametros,
            type: 'POST',
            success: function (response) {
                if (response !== null) {
                    $("#ciclo").html(response);
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
    $("#dniAlumno").blur(function () {
        dniAlumno = $("select#dniAlumno option:checked").val();
        jQuery(dniAlumno).load('session_write.php?dniAlumno=' + dniAlumno);
    });
});