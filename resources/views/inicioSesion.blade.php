@extends('maestra.maestraGeneral')

@section('titulo') 
Inicio de sesion
@endsection

@section('contenido') 
<p class="text-center">Iniciar Sesión</p>
<div class="container" style="height: 50vh;">
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3"> 
            <form name="inicioSesion" action="inicioSesion" method="POST">
                {{ csrf_field() }}                
                <div class="form-group mx-auto">
                    <label class="text-center" for="email">
                        Usuario:
                        <input type="email" class="form-control form-control-sm form-control-md form-control-lg" id="usuario" name="usuario" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo"><br>
                    </label>                   
                </div>
                <div class="form-group">
                    <label class="text-center" for="pwd">
                        Contraseña:
                        <input type="password" class="form-control form-control-sm form-control-md form-control-lg" id="pwd" name="pwd" placeholder="Contraseña" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca una contraseña"><br>
                    </label> 
                </div>
                <div class="form-group">
                    <a href="olvidarPwd">He olvidado la contraseña</a>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" id="aceptarInicioSesion" name="aceptarInicioSesion" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection