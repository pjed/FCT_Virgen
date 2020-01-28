@extends('maestra.maestraGeneral')

@section('titulo') 
Recuperar contraseña
@endsection

@section('contenido') 
<h1 class="text-center">Recuperar contraseña</h1>
<div class="container">
    <div class="row">
        <div class="col">                   
                <form name="olvidarPwd" action="olvidarPwd" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email"class="form-control form-control-sm form-control-md form-control-lg" id="email" name="email" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo"><br>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" id="recuperarPwd" name="recuperarPwd" value="Aceptar">
                        <input type="submit" class="btn btn-primary" id="recuperarPwd" name="volver" value="volver">
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection