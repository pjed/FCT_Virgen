/**
 * 
 *  @author marina
 */
$(document).ready(function () {
    var ciclo = null;
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
});