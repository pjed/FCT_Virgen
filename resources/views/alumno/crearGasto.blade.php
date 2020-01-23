@extends('maestraAlumno')
@section('contenido') 
<div class="container-fluid">  
    
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Crear gasto comida/transporte</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Izquierda</h2>
        </div>
        
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Derecha</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm col-md col-lg">
            <input type="submit" id="editar" class="btn" name="guardar" value="Guardar"/>
        </div>
    </div>
    
</div>
@endsection