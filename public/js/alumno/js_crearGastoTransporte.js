$(document).ready(function () {
    $("#gastoPropio").hide();
    $("#gastoColectivo").hide();

    //Campos del transporte colectivo
    $("#locC").blur(function () {
        if ($("#locC").val() === "") {
            $("#locC").css({'border-color': 'red'});
        } else {
            $("#locC").css({'border-color': 'green'});
        }
    });

    $("#diasC").blur(function () {
        if ($("#diasC").val() === "" || $("#diasC").val() < 1) {
            $("#diasC").css({'border-color': 'red'});
        } else {
            $("#diasC").css({'border-color': 'green'});
        }
    });

    $("#importeT").blur(function () {
        if ($("#importeT").val() === "" || $("#importeT").val() < 0) {
            $("#importeT").css({'border-color': 'red'});
        } else {
            $("#importeT").css({'border-color': 'green'});
        }
    });

    //campos del transporte propio
    $("#kms").blur(function () {
        if ($("#kms").val() === "") {
            $("#kms").css({'border-color': 'red'});
        } else {
            $("#kms").css({'border-color': 'green'});
        }
    });
    
    $("#diasP").blur(function () {
        if ($("#diasP").val() === "") {
            $("#diasP").css({'border-color': 'red'});
        } else {
            $("#diasP").css({'border-color': 'green'});
        }
    });
    
    $("#locP").blur(function () {
        if ($("#locP").val() === "") {
            $("#locP").css({'border-color': 'red'});
        } else {
            $("#locP").css({'border-color': 'green'});
        }
    });
});

function handleClick(myRadio) {

    if (myRadio.value === "Propio") {
        $("#gastoColectivo").hide();
        $("#gastoPropio").show();
    }

    if (myRadio.value === "Colectivo") {
        $("#gastoPropio").hide();
        $("#gastoColectivo").show();
    }

}