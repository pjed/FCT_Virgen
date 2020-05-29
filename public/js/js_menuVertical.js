$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');         
        $(this).toggleClass('active');
        $('#logotipo').toggleClass('active');
    });
});