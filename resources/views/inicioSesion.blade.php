@extends('maestra.maestraGeneral')

@section('titulo') 
Inicio de sesion
@endsection

@section('contenido') 
<h1 class="text-center">Iniciar Sesión</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">       
            <form name="inicioSesion" action="inicioSesion" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">
                        Usuario:
                        <input type="email"class="form-control form-control-sm form-control-md form-control-lg" id="usuario" name="usuario" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo"><br>
                    </label>
                </div>
                <div class="form-group">
                    <label for="pwd">
                        Contraseña:
                        <input type="password" class="form-control form-control-sm form-control-md form-control-lg" id="pwd" name="pwd" placeholder="Contraseña" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca una contraseña"><br>
                    </label>
                </div>
                <div class="form-group">
                    <a href="olvidarPwd">He olvidado la contraseña</a>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="aceptar" name="aceptarIndex" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection