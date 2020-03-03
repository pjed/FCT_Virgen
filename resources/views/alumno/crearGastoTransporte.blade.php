@extends('maestra.maestraAlumno')

@section('titulo') 
Crear gasto transporte
@endsection

@section('javascript') 
<script src="{{asset ('js/alumno/js_crearGastoTransporte.js')}}"></script>
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Crear gasto</a></div>
                <div class="breadcrumb-item active"><a href="crearGastoTransporte">Transporte</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Crear gasto transporte</h2>
        </div>
    </div>

    <!-- Formulario para crear un gasto -->
    <form name="form" action="crearGastoTransporte" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row justify-content-center"> 

            <div class="col-md-2">

                <fieldset>
                    <!--                    <legend>Tipo transporte</legend>-->
                    <p>Tipo transporte</p>
                    <div>
                        <input type="radio" name="tipoT" id="colectivo" value="Colectivo" onclick="handleClick(this);">
                        <label for="colectivo">Colectivo</label>
                    </div>
                    <div>
                        <input type="radio" name="tipoT" id="propio" value="Propio" onclick="handleClick(this);">
                        <label for="propio">Propio</label>
                    </div>
                </fieldset>

            </div>

        </div>

        <!-- Campos para el gasto de transporte propio -->
        <div class="row justify-content-center" id="gastoPropio">

            <div class="col-md-2">

                <p>Kilómetros</p>
                <input type="number" id="kms" name="kms" value="" min="0">

                <p>Número de días</p>
                <input type="number" id="diasP" name="diasP" value="" min="0">

            </div>  

            <div class="col-md-2">

                <p>Precio</p>
                <input type="number" id="precioP" name="precioP" value="0.12" readonly>

                <p>Localidad</p>
                <input type="text" id="locP" name="locP" value="" placeholder="Localidad">
            </div>
        </div>

        <!-- Campos para el gasto de transporte colectivo -->
        <div class="row justify-content-center" id="gastoColectivo"> 

            <div class="col-md-2">

                <p>Ticket</p>
                <img src="{{asset ('images/ticket.png')}}" class="fotoTicket"><br><br>
                <p>Hacer foto</p>
                <input type="file" id="fotoTicket" name="fotoTicket"/><br><br>
                <p>Número de días</p>
                <input type="number" id="diasC" name="diasC" value="" min="0">

            </div>

            <div class="col-md-2">

                <p>Localidad</p>
                <input type="text" id="locC" name="locC" value="" placeholder="Localidad"><br><br>
                <p>Importe total</p>
                <input type="number" id="importeT" name="importeT" min="0" step="0.01" value="0"/><br><br>

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
