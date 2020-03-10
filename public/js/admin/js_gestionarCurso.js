/**
 * 
 *  @author marina
 */
$(document).ready(function () {
    $(".id").blur(function () {
        if ($(".id").val() === "") {
            $(".id").css({'border-color': 'red'});
        } else {
            $(".id").css({'border-color': 'black'});
        }
    });
    $(".descripcion").blur(function () {
        if ($(".descripcion").val() === "") {
            $(".descripcion").css({'border-color': 'red'});
        } else {
            $(".descripcion").css({'border-color': 'black'});
        }
    });
    $(".anioAcademico").blur(function () {
        if ($(".anioAcademico").val() === "") {
            $(".anioAcademico").css({'border-color': 'red'});
        } else {
            $(".anioAcademico").css({'border-color': 'black'});
        }
    });
    $(".familia").blur(function () {
        if ($(".familia").val() === "") {
            $(".familia").css({'border-color': 'red'});
        } else {
            $(".familia").css({'border-color': 'black'});
        }
    });
    $(".horas").blur(function () {
        if ($(".horas").val() === "") {
            $(".horas").css({'border-color': 'red'});
        } else {
            $(".horas").css({'border-color': 'black'});
        }
    });
});
