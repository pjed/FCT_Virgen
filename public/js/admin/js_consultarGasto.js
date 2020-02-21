$(document).ready(function () {
    var ciclo = null;
    var dniAlumno = null;
    /**
     * se carga nada mas iniciar la pagina
     */
    $("#ciclo").ready(function () {
        var parametros = null;
        var listaCiclo = new Array();
        $.ajax({
            url: 'consultarGastosAjaxCiclo',
            //data:{'nombre':"DAW2"},
            data: parametros,
            type: 'post',
            success: function (response) {
                if (response !== null) {
                    listaCiclo = JSON.parse(response); //conversión a json de los datos de respuesta
                    if (listaCiclo !== null) {
                        MostrarConsultarGastosAjaxCiclo(listaCiclo);
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
    /*
     * funciona cuando se selecciona un ciclo y muestra la lista de los alumnos de es curso
     * @param {type} listaCiclo
     * @return {undefined}
     */
    $("#ciclo").blur(function () {
        ciclo = $("select#ciclo option:checked").val();
        sessionStorage.setItem("ciclo", ciclo);
        jQuery(ciclo).load('session_write.php?ciclo=' + ciclo);
        var parametros = {
            "ciclo": ciclo
        };
        var listaAlumno = new Array();
        $.ajax({
            url: 'consultarGastosAjaxDniAlumno',
            data: parametros,
            type: 'post',
            success: function (response) {
                if (response !== null) {
                    listaAlumno = JSON.parse(response); //conversión a json de los datos de respuesta
                    if (listaAlumno !== null) {
                        MostrarconsultarGastosAjaxDniAlumno(listaAlumno);
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
    $("#dniAlumno").blur(function () {
        dniAlumno = $("select#dniAlumno option:checked").val();        
        sessionStorage.setItem("dniAlumno", dniAlumno);
        jQuery(dniAlumno).load('session_write.php?dniAlumno=' + dniAlumno);

    });
    /**
     * Escribe el formalario del select de ciclo
     * @param {type} listaCiclo
     * @return {undefined}
     */
    function MostrarConsultarGastosAjaxCiclo(listaCiclo) {
        ciclo = sessionStorage.getItem("ciclo"); 
        var $e = $('#consultarGastosAjaxCiclo');
        $e.empty();
        $e.append('<form action="consultarGastosAjaxCiclo" method="POST">');
        $e.append('{{ csrf_field() }}');
        $e.append('<label class="text-center"  for="ciclo">');
        $e.append('Ciclo:');
        $e.append(' <select id="ciclo" class="sel" name="ciclo"> ');
        for (var i = 0; i < listaCiclo.length; i++) {
            if (listaCiclo[i].id == ciclo) { //ciclo variable guarda en un sesion
                $e.append('<option value="' + listaCiclo[i].id + '" selected>' + listaCiclo[i].id + '</option>');
            } else {
                $e.append('<option value="' + listaCiclo[i].id + '" > ' + listaCiclo[i].id + '</option>');
            }
        }
        $e.append('</select>');
        $e.append('</label> ');
        $e.append('</form>');
    }
    /**
     * Escribe el formalario del select de los alumnos de un ciclo
     * @param {type} listaAlumno
     * @return {undefined}
     */
    function MostrarconsultarGastosAjaxDniAlumno(listaAlumno) {
       dniAlumno = sessionStorage.getItem("dniAlumno"); 
        var $e = $("#consultarGastosAjaxDniAlumno");
        $e.empty();
        $e.append('<form action="consultarGastos" method="POST">');
        $e.append('{{ csrf_field() }}');
        $e.append('<label class="text-center">  for="dniAlumno"');
        $e.append('Alumno:');
        $e.append('<select id="dniAlumno" class="sel" name="dniAlumno">');
        for (var i = 0; i < listaAlumno.length; i++) {
            if (listaAlumno[i].dni == dniAlumno) { //$dniAlumno variable guarda en un sesion
                $e.append('<option value="' + listaAlumno[i].dni + '" selected>' + listaAlumno[i].nombre + ', ' + +listaAlumno[i].apellidos + '</option>');
            } else {
                $e.append('<option value="' + listaAlumno[i].dni + '" > ' + listaAlumno[i].nombre + ', ' + +listaAlumno[i].apellidos + '</option>');
            }
        }
        $e.append('</select>');
        $e.append('</label> ');
        $e.append('<button type="submit" id="buscar" class=" btn-sm-sm btn-sm-sm btn-sm-primary" name="buscar1"></button>');
        $e.append('</form>');
    }
});