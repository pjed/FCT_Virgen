$(document).ready(function () {
    $("#gastoPropio").hide();
    $("#gastoColectivo").hide();

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

function handleClick(myRadio) {

    if (myRadio.value === "Propio") {
        $("#gastoColectivo").hide();
        $("#gastoPropio").show();
        //alert('Es propio');
    }

    if (myRadio.value === "Colectivo") {
        $("#gastoPropio").hide();
        $("#gastoColectivo").show();
        //alert('Es colectivo');
    }

}

//$(document).ready(function () {
//    $("#gastoPropio").hide();
//    $("#gastoColectivo").hide();
//    $("#guardar").hide();
//
//    $("#comprobar").click(function () {
//
//        $boolLoc;
//        $boolFoto;
//        $boolImporte;
//        $boolDias;
//
//        if ($("#locC").val() === "") {
//            $("#locC").css({'border-color': 'red'});
//            $boolLoc = false;
//        } else {
//            $boolLoc = true;
//        }
//
//
//        if ($('input[type=file]').val()) {
//            //alert("Imagen seleccionada");
//            $boolFoto = true;
//        } else {
//            //alert("Imagen no seleccionada");
//            $boolFoto = false;
//        }
//
//
//        if ($("#importeT").val() === "" || $("#importeT").val() === 0) {
//            $("#importeT").css({'border-color': 'red'});
//            $boolImporte = false;
//        } else {
//            $boolImporte = true;
//        }
//
//
//        if ($("#diasC").val() === "" || $("#diasC").val() === 0) {
//            $("#diasC").css({'border-color': 'red'});
//            $boolDias = false;
//        } else {
//            $boolDias = true;
//        }
//
//        if ($boolFoto && $boolDias && $boolImporte && $boolLoc) {
//            $("#guardar").show();
//        }
//    });
//
////    $("#fotoTicket").blur(function () {
////
////    });
////
////    $("#locC").blur(function () {
////        if ($("#locC").val() === "") {
////            $("#locC").css({'border-color': 'red'});
////        }
////    });
////
////    $("#importeT").blur(function () {
////        if ($("#importeT").val() === "" || $("#importeT").val() < 0) {
////            $("#importeT").css({'border-color': 'red'});
////        }
////    });
//});
//
//function handleClick(myRadio) {
//
//    if (myRadio.value === "Propio") {
//        $("#gastoColectivo").hide();
//        $("#gastoPropio").show();
//    }
//
//    if (myRadio.value === "Colectivo") {
//        $("#gastoPropio").hide();
//        $("#gastoColectivo").show();
//    }
//
//}