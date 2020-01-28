@extends('maestra.maestraGeneral')

@section('titulo') 
Inicio de sesion
@endsection

@section('contenido') 
<div class="row justify-content-center">
    <div class="col-sm col-md-2 col-lg">
        <main class="mt-5 mb-5 "> 
            <div class="row justify-content-center">
                <div class="col-sm col-md-2 col-lg">
                    <h1>Cambiar rol</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm col-md-2 col-lg">       
                    <form name="cambiarRol" action="cambiarRol" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="tutor" value="Tutor">
                            <input type="submit" class="btn btn-primary" name="administrador" value="Administrador">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection