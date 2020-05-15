@extends('maestra.maestraAlumno')

@section('titulo')
Crear gasto comida
@endsection

@section('javascript') 
<script src="{{asset ('js/alumno/js_crearGastoComida.js')}}"></script>
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
    <form name="form" action="crearGastoComida" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-2">
                <p>Ticket</p>
                <img src="{{asset ('images/ticket.png')}}" alt="fotoTicket" class="fotoTicket"><br><br>
                <p>Hacer foto</p>
                <input type="file" id="fotoTicket" name="fotoTicket"/><br><br>
            </div>

            <div class="col-md-2">
                <p>Fecha gasto</p>
                <input type="date" id="fechaT" name="fechaT" value="" required/><br><br>
                <p>Importe total</p>
                <input type="number" id="importeT" name="importeT" min="0" max="9" step="0.01" value="" required/><br><br>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-2">
                <fieldset>
                    <p>¿Te has desplazado?</p>
                    <div>
                        <input type="radio" name="desplazado" id="si" value="1">
                        <label for="si">Si</label>
                    </div>
                    <div>
                        <input type="radio" name="desplazado" id="no" value="0">
                        <label for="no">No</label>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-2">
                <input type="submit" id="guardar" name="guardar" value="Guardar">
            </div>
        </div>

    </form>
</div>
@endsection
