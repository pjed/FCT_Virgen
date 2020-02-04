$(document).ready(function () {
    $("#aceptarInicioSesion").click(function () {
        if ($("#usuario").val() === "" && $("#pwd").val() === "") {
            location.replace("inicioSesion");
        }
    });
    $("#usuario").blur(function () {
        if ($("#usuario").val() === "") {
            $("#usuario").css({'border-color': 'red'});
        }
    });
    $("#pwd").blur(function () {
        if ($("#pwd").val() === "") {            
            $("#pwd").css({'border-color': 'red'});
        }
    });
});
