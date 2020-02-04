$(document).ready(function () {
    $("#guardar").click(function () {
        if ($("#importeT").val() === "" || $("#fotoTicket").val() === "") {
            //location.replace("crearGastoTransporte");
        }
    });

    $("#fotoTicket").blur(function () {

    });

    $("#nombreAl").blur(function () {
        if ($("#nombreAl").val() === "") {
            $("#nombreAl").css({'border-color': 'red'});
        }
    });

    $("#importeT").blur(function () {
        if ($("#importeT").val() === "" || $("#importeT").val() > 9.0 || $("#importeT").val() < 0) {
            $("#importeT").css({'border-color': 'red'});
        }
    });
});