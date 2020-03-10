/**
 * 
 *  @author marina
 */
$(document).ready(function () {
  
    $(".CIF").blur(function () {
        if ($(".CIF").val() === "") {
            $(".CIF").css({'border-color': 'red'});
        }else{                   
            $(".CIF").css({'border-color': 'black'});
        }
    });
    $(".nombreEmpresa").blur(function () {
        if ($(".nombreEmpresa").val() === "") {            
            $(".nombreEmpresa").css({'border-color': 'red'});
        }else{                   
            $(".nombreEmpresa").css({'border-color': 'black'});
        }
    });
    $(".direccion").blur(function () {
        if ($(".direccion").val() === "") {            
            $(".direccion").css({'border-color': 'red'});
        }else{                   
            $(".direccion").css({'border-color': 'black'});
        }
    });
    $(".localidad").blur(function () {
        if ($(".localidad").val() === "") {            
            $(".localidad").css({'border-color': 'red'});
        }else{                   
            $(".localidad").css({'border-color': 'black'});
        }
    });
    $(".horario").blur(function () {
        if ($(".horario").val() === "") {            
            $(".horario").css({'border-color': 'red'});
        }else{                   
            $(".horario").css({'border-color': 'black'});
        }
    });
    $(".dniRepresentante").blur(function () {
        if ($(".dniRepresentante").val() === "") {            
            $(".dniRepresentante").css({'border-color': 'red'});
        }else{                   
            $(".dniRepresentante").css({'border-color': 'black'});
        }
    });
    $(".nombreRepresentante").blur(function () {
        if ($(".nombreRepresentante").val() === "") {            
            $(".nombreRepresentante").css({'border-color': 'red'});
        }else{                   
            $(".nombreRepresentante").css({'border-color': 'black'});
        }
    });
});