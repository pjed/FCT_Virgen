@extends('maestra.maestraAlumno')

@section('titulo') 
Consultar Gastos por curso
@endsection

@section('contenido') 
<h2 class="text-center">Bienvenido/a Alumno/a</h2>
<div class="row container-fluid">
    <div class="col-5 container panel_informativo ">
        <div class="row h-100 justify-content-center align-items-center">
            <p>Que puedo hacer:</p>
            <ol>
                <li>Crear gasto rellenando un formulario donde indica que tipo de gasto es (transporte o comida)</li>
                <li>Gestiona los datos de transporte y de comida, pudiendo consultarlos, modificarlos y eliminarlos.</li>
                <li>En el perfil puede cambiar su contraseña y nombre de usuario</li>
            </ol>
        </div>
    </div>
</div>
@endsection