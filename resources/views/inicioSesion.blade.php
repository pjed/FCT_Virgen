@extends('maestra.maestraGeneral')

@section('titulo') 
Inicio de sesion
@endsection

@section('javascript') 
<script src="{{asset ('js/js_inicioSesion.js')}}"></script>
@endsection

@section('contenido') 
<h1 class="text-center">Iniciar Sesión</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3">
            <form name="inicioSesion" action="inicioSesion" method="POST">
                {{ csrf_field() }}                
                <div class="form-group mx-auto">
                    <label class="text-center" for="usuario">
                        Usuario:
                        <input type="email" class="form-control form-control-sm form-control-md form-control-lg" id="usuario" name="usuario" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduzca un correo" required><br>
                    </label>                   
                </div>
                <div class="form-group">
                    <label class="text-center" for="pwd">
                        Contraseña:
                        <input type="password" class="form-control form-control-sm form-control-md form-control-lg" id="pwd" name="pwd" placeholder="Contraseña" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduzca una contraseña" required ><br>
                    </label> 
                </div>
                <div class="form-group">
                    <a href="olvidarPwd">He olvidado la contraseña</a>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" id="aceptarInicioSesion" name="aceptarInicioSesion" value="Aceptar">
                </div>
                <img src="{{asset ('images/chrome_logo.jpg')}}" alt="logotipo chrome" class="logo_chrome"> Para generar documentos se recomienda usar Chrome<br>
                    <img src="{{asset ('images/firefox_logo.png')}}" alt="logotipo chrome" class="logo_chrome"> Para visualizar la aplicación se recomienda usar Firefox
            </form>
        </div>
    </div>
</div>
@endsection