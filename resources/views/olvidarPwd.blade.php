@extends('maestra.maestraGeneral')

@section('titulo') 
Recuperar contraseña
@endsection

@section('contenido') 
<div class="row">
    <div class="col">
        <header>
            <h1>Recuperar contraseña</h1>
        </header>
    </div>
</div>
<div class="row">
    <div class="col">
        <main>                      
            <form name="olvidarPwd" action="olvidarPwd" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email"class="form-control form-control-sm form-control-md form-control-lg" id="usuario" name="usuario" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo"><br>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="recuperarPwd" name="recuperarPwd" value="Aceptar">
                </div>
            </form>
        </main>
    </div>
</div>
@endsection