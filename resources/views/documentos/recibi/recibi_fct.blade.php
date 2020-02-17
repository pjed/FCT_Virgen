<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head></head>
    <link rel="stylesheet" type="text/css" href="{{asset ('css/css_documentacion.css')}}" media="screen" />   
    <!-- Fonts -->

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
                            <td>CENTRO DOCENTE: <input type="text" id="centro" class="campos_derecha tamano_campo campo_readonly" readonly name="centro" value=""></td><td>&nbsp;&nbsp;&nbsp;&nbsp;LOCALIDAD: <input type="text" class="campos_derecha campo_readonly" readonly id="localidad" name="localidad" value=""></td>
                        </tr>
                        <tr>
                            <td>CODIGO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="codigo" class="campos_derecha tamano_campo campo_readonly" readonly name="codigo" value=""></td>
                        </tr>
                        <tr>
                            <td>ALUMNO/A: <input type="text" id="alumno" class="campos_derecha tamano_campo campo_readonly" readonly name="alumno" value=""></td>
                        </tr>
                        <tr>
                            <td>PROFESOR - TUTOR/A D./Dª: <input type="text" class="campos_derecha tamano_campo campo_readonly" readonly id="tutor" name="tutor" value=""></td>
                        </tr>
                    </table>
                </td>
                <td class="anexo">ANEXO V</td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>FAMILIA PROFESIONAL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="tamano_campo campo_readonly" readonly id="familia" name="familia" value=""></td>
                        </tr>
                        <tr>
                            <td>CICLO FORMATIVO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="tamano_campo campo_readonly" readonly id="ciclo" name="ciclo" value=""></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>PERIODO: &nbsp;&nbsp;&nbsp;<input type="text" class="campo_readonly" readonly id="periodo" name="periodo" value=""></td>
                        </tr>
                        <tr>
                            <td>HORAS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="campo_readonly" readonly id="horas" name="horas" value=""></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="row ">
            <div class="col cuerpo_recibi">
                <p>He recibido del Centro Docente CIFP Virgen de Gracia, en concepto de ayuda para compensar los gastos ocasionados 
                    por desplazamiento en vehículo propio (excepto ciclomotores) o transporte colectivo público, y otros gastos 
                    extraordinarios, para la realización del Módulo de Formación en Centros de Trabajo, en la empresa 
                    <input type="text" id="empresa" name="empresa" value="" class="campo_readonly" readonly> de la localidad de 
                    <input type="text" id="localidad" name="localidad" value="" class="campo_readonly" readonly> con domicilio 
                    <input type="text" id="domicilio" name="domicilio" value="" class="campo_readonly" readonly>, la cantidad de 
                    <input type="text" id="cantidad" name="cantidad" value="" class="campo_readonly" readonly> euros. 
                </p>
                <p>Así mismo, DECLARO conocer que esta ayuda es incompatible con cualquier otra subvención, ayuda, ingreso o recursos 
                    destinados a la misma finalidad, procedentes de cualquier administración o ente público o privado, nacionales, de la 
                    Unión Europea o de organismos internacionales de las que no soy beneficiario/a.</p>
            </div>
        </div>
        <div class="row float-right">
            <div class="col">
                Total: <input type="text" value="" id="importe" name="importe" class="campo_readonly" readonly> €
            </div>
        </div>
        <div class="row float-right margen_arriba">
            <div class="col">
                En Puertollano a <input type="text" value="" id="fecha_actual" name="fecha_actual" class="campo_readonly" readonly>
            </div>
        </div>
        <br><br><br><br>
        <div class="row margen_arriba content text-center">
            <div class="col justify-content-center">
                El/La director/a<br>
                <input type="text" id="director" name="director" value="" class="campo_readonly" readonly>
                <br><br><br><br><br>
                Fdo.:
                <img src="" id="firmaDirector">
            </div>
            <div class="col justify-content-center">
                El/La Alumno/a<br>
                <input type="text" id="alumno" name="alumno" value="" class="campo_readonly" readonly>
                <br><br><br><br><br>
                Fdo.:
            </div>
        </div>
    </body>
</html>