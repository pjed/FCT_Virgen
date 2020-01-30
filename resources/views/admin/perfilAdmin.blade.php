@extends('maestra.maestraAdmin')

@section('titulo') 
Perfil
@endsection

@section('contenido') 
<h1 class="text-center">Perfil</h1>
<div class="container">
    <div class="row">
        <div class="col-sm col-md col-lg">       
            <form name="perfil" action="perfil" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="" value="">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection