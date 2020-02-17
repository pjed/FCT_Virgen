<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head></head>
    <link rel="stylesheet" type="text/css" href="{{asset ('css/css_documentacion.css')}}" media="screen" />   
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet"> 

    <!-- Styles -->
    <script src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset ('js/js_crearGastoComida.js')}}"></script>
    <script src="{{asset ('js/js_crearGastoTransporte.js')}}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <body>
        <div class="row">
            <div class="col-2">
                <img src="{{asset ('images_docs/clm_logo.jpg')}}" class="logo_clm">
            </div>
            <div class="col-4 titulo container text-center">
                <div class="row h-100 justify-content-center align-items-center">
                    CONSEJERÍA‌ ‌DE‌ ‌EDUCACIÓN,‌ ‌CULTURA‌ ‌Y‌ ‌DEPORTES‌ ‌
                    DIRECCIÓN‌ ‌GENERAL‌ ‌DE‌ ‌PROGRAMAS,‌ ‌ATENCIÓN‌ ‌A‌ ‌LA‌ ‌DIVERSIDAD‌ ‌Y‌ ‌
                    FORMACIÓN‌ ‌PROFESIONAL‌
                </div>
            </div>
            <div class="col-2">
                <img src="{{asset ('images_docs/ue_logo.png')}}" class="logo_ue">
            </div>
        </div>
        <div class="row titulo_negrita">
            <div class="col-2">
            </div>
            <div class="col-4 titulo_negrita container text-center">
                <div class="row h-100 justify-content-center align-items-center">
                    FORMACIÓN EN CENTROS DE TRABAJO
                    RECIBÍ DEL ALUMNO o ALUMNA
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>
        <table class="borde">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>CENTRO DOCENTE</td><td>LOCALIDAD</td>
                        </tr>
                        <tr>
                            <td>CODIGO</td>
                        </tr>
                        <tr>
                            <td>ALUMNO/A</td>
                        </tr>
                        <tr>
                            <td>PROFESOR - TUTOR/A D./Dª:</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: center;"><b>ANEXO V</b></td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>FAMILIA PROFESIONAL: </td>
                        </tr>
                        <tr>
                            <td>CICLO FORMATIVO: </td>
                        </tr>
                    </table>
                </td>
                <td>
                <table>
                        <tr>
                            <td>PERIODO: </td>
                        </tr>
                        <tr>
                            <td>HORAS: </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>