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

    <!-- Seleccionar tipo de transporte -->
    <div class="row justify-content-center"> 

        <div class="col-md-2 col-sm-2">

            <fieldset>
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
    <form name="formP" action="crearGastoTransporte" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div id="gastoPropio">
            <div class="row justify-content-center">

<!--                <div class="col-md-4 col-sm-4 col-lg-4">

                    <p>Kilómetros</p>
                    <input type="number" id="kms" name="kms" value="" min="0" required>

                    <p>Días</p>
                    <input type="number" id="diasP" name="diasP" value="" min="0" required>

                </div>  -->

                <div class="col-md-2 col-sm-2 col-lg-2">
                    
                    <p>Kilómetros</p>
                    <input type="number" id="kms" name="kms" value="" min="0" required>

                    <p>Precio</p>
                    <input type="number" id="precioP" name="precioP" value="0.12" readonly>

                    <p>Localidad</p>
                    <input type="text" id="locP" name="locP" value="" placeholder="Localidad" required>
                </div>
            </div>

            <div class="row justify-content-center"> 

                <div class="col-md-2 col-sm-2">

                    <br><input type="submit" id="guardarP" name="guardarP" value="Guardar">

                </div>

            </div>
        </div>
    </form>

    <!-- Campos para el gasto de transporte colectivo -->
    <form name="formC" action="crearGastoTransporte" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div id="gastoColectivo">
            <div class="row justify-content-center"> 

                <div class="col-md-2">

                    <p>Ticket</p>
                    <img src="{{asset ('images/ticket.png')}}" alt="ticketGasto" class="fotoTicket"><br><br>
                    <p>Hacer foto</p>
                    <input type="file" id="fotoTicket" name="fotoTicket"/><br><br>
<!--                    <p>Días</p>
                    <input type="number" id="diasC" name="diasC" value="" min="1" required>-->

                </div>

                <div class="col-md-2">

                    <p>Localidad</p>
                    <input type="text" id="locC" name="locC" value="" placeholder="Localidad" required><br><br>
                    <p>Importe total</p>
                    <input type="number" id="importeT" name="importeT" min="0" step="0.01" value="" required/><br><br>

                </div>

            </div>

            <div class="row justify-content-center"> 

                <div class="col-md-2 col-sm-2">

                    <br><input type="submit" id="guardarC" name="guardarC" value="Guardar">

                </div>

            </div>
        </div>
    </form>

    <!--</form>-->
</div>
@endsection
