@extends('maestra.maestraGeneral')

@section('titulo') 
Recuperar contraseña
@endsection

@section('contenido') 
<h1 class="text-center">Recuperar contraseña</h1>
<div class="col-6 container text-center">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-6">                   
            <form name="olvidarPwd" action="olvidarPwd" method="POST">
                {{ csrf_field() }}
                <label for="email">Email:</label>
                <div class="form-group">
                    <input type="email"class="form-control form-control-sm form-control-md form-control-lg" id="email" name="email" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo" required><br>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="recuperarPwd" name="recuperarPwd" value="Aceptar">
                </div>
            </form>
            <form name="volver" action="VolverIndex" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="volver" name="volver" value="Volver">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection