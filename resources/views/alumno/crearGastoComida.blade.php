@extends('maestra.maestraAlumno')

@section('titulo') 
Crear gasto comida
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Crear gasto</a></div>
                <div class="breadcrumb-item active"><a href="crearGastoComida">Comida</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Crear gasto comida</h2>
        </div>
    </div>

    <!-- Formulario para crear un gasto -->
    <form name="form" action="crearGastoComida" method="POST">
        {{ csrf_field() }}
        <div class="row justify-content-center"> 

            <div class="col-md-2">

                <p>Ticket</p>
                <img src="{{asset ('images/ticket.png')}}" class="logoInstituto"><br><br>
                <p>Hacer foto</p>
                <input type="file" id="fichero" name="fichero"/><br><br>

            </div>

            <div class="col-md-2">

                <p>Nombre del alumno</p>
                <input type="text" id="nombre" name="nomAlum" placeholder="Nombre" value="" readonly/><br><br>
                <p>Importe total</p>
                <input type="number" id="importeT" name="importeT" min="0" max="9" step="0.01" value="0"/><br><br>

            </div>

        </div>

        <div class="row justify-content-center"> 

            <div class="col-md-2">

                <input type="submit" name="guardar" value="Guardar">

            </div>

        </div>

    </form>
</div>
@endsection