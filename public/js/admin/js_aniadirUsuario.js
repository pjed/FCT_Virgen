$(document).ready(function () {
    $("#crearAlumno").hide();
    $("#crearTutor").hide();
    $("#crearAdmin").hide();
    $("#crearTutorAdmin").hide();

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
});

function handleClick(myRadio) {

    if (myRadio.value === "Alumno") {
        $("#crearAlumno").show();
        $("#crearTutor").hide();
        $("#crearAdmin").hide();
        $("#crearTutorAdmin").hide();
    }
    
    if (myRadio.value === "Administrador") {
        $("#crearAlumno").hide();
        $("#crearTutor").hide();
        $("#crearAdmin").show();
        $("#crearTutorAdmin").hide();
    }
    
    if (myRadio.value === "TutorAdministrador") {
        $("#crearAlumno").hide();
        $("#crearTutor").hide();
        $("#crearAdmin").hide();
        $("#crearTutorAdmin").show();
    }
    
    if (myRadio.value === "Tutor") {
        $("#crearAlumno").hide();
        $("#crearTutor").show();
        $("#crearAdmin").hide();
        $("#crearTutorAdmin").hide();
    }

}