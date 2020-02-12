@extends('maestra.maestraGeneral')

@section('titulo') 
Cambiar Rol
@endsection

@section('contenido') 
<h1>Cambiar rol</h1>
<div class="row justify-content-center container">
    <div class="col-sm col-md-2 col-lg justify-content-center align-items-center">
        <form name="cambiarRol" action="cambiarRol" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="tutor" value="Tutor">
                <input type="submit" class="btn btn-primary" name="administrador" value="Administrador">
            </div>
        </form>
    </div>
</div>
@endsection