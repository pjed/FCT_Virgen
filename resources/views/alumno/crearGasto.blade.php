@extends('maestra.maestraAlumno')

@section('titulo') 
Crear gasto
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item active" href="crearGasto"><a>Crear gasto</a></div>
            </div>
        </nav>
    </nav>

    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Crear gasto comida/transporte</h2>
        </div>
    </div>

    <form name="form" action="" method="POST">

        <div class="row justify-content-center"> 

            <div class="col-md-2">

                <p>Ticket</p>
                <img src="{{asset ('images/ticket.png')}}" class=""><br><br>
                <p>Hacer foto</p>
                <input type="file" id="fichero" name="fichero"/><br><br>

            </div>

            <div class="col-md-2">

                <p>Nombre del alumno</p>
                <input type="text" id="nombre" name="nombreReg" placeholder="Nombre" value="" readonly/><br><br>
                <p>Gasto</p>
                <input type="number" id="gasto" name="edadReg" min="0" step="0.01" value="0"/><br><br>

                <fieldset>
                    <legend>Tipo</legend>

                    <div>
                        <input type="radio" id="comida" name="tipo" value="comida"
                               checked>
                        <label for="comida">Comida</label>
                    </div>

                    <div>
                        <input type="radio" id="transporte" name="tipo" value="transporte">
                        <label for="transporte">Transporte</label>
                    </div>
                </fieldset>

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