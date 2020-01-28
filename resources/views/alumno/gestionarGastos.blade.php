@extends('maestra.maestraAlumno')

@section('titulo') 
Gestionar gastos
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item active"><a href="gestionarGastos">Gestionar gastos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestionar gasto comida/transporte</h2>
        </div>
    </div>

    <!-- Tabla de gastos del usuario -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered illo">
                    <caption class="text-center blanco">
                        Tabla de gastos
                    </caption>
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Desplazamiento</th>
                            <th>Ticket</th>
                            <th>Total gasto</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        foreach ($gastosAlumno as $value) {
                            ?>

                        <form name="form" action="gestionarGastos" method="POST">
                            <tr>
                                <td><input type="text" name ="idGasto" value='' readonly></td>
                                <td><input type="text" name ="tipoGasto" value=''></td>
                                <td><input type="number" name ="desplazamientoGasto" value="0" min="0"></td>
                                <td>
                                    <?php
                                    echo '<img name="ticketGasto" src="data:image/jpeg;base64,' . base64_encode($value->getFoto()) . '"/>';
                                    ?>
                                    <input type="file" class="form-control" id="image" name="image">
                                </td>
                                <td><input type="text" name ="totalGasto" value=''></td>

                                <td><button type="submit" id="editar" class="btn" name="editar" /></td>
                                <td><button type="submit" id="eliminar" class="btn" name="eliminar" /></td>
                            </tr>
                        </form>

                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection