/**
 * 
 *  @author marina
 */
$(document).ready(function () {
    $(".dni").blur(function () {
        if ($(".dni").val() === "") {
            $(".dni").css({'border-color': 'red'});
        } else {
            $(".dni").css({'border-color': 'black'});
        }
    });
    $(".nombre").blur(function () {
        if ($(".nombre").val() === "") {
            $(".nombre").css({'border-color': 'red'});
        } else {
            $(".nombre").css({'border-color': 'black'});
        }
    });
    $(".apellido").blur(function () {
        if ($(".apellido").val() === "") {
            $(".apellido").css({'border-color': 'red'});
        } else {
            $(".apellido").css({'border-color': 'black'});
        }
    });
    $(".email").blur(function () {
        if ($(".email").val() === "") {
            $(".email").css({'border-color': 'red'});
        } else {
            $(".email").css({'border-color': 'black'});
        }
    });
    $(".tel").blur(function () {
        if ($(".tel").val() === "") {
            $(".tel").css({'border-color': 'red'});
        } else {
            $(".tel").css({'border-color': 'black'});
        }
    });
});