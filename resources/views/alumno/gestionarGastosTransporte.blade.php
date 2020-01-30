@extends('maestra.maestraAlumno')

@section('titulo') 
Gestionar gastos transporte
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar gastos</a></div>
                <div class="breadcrumb-item active"><a href="gestionarGastosTransporte">Transporte</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestionar gastos transporte</h2>
        </div>
    </div>

    <!-- Tabla de gastos del usuario -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered illo">
                    <caption class="text-center blanco">
                        Tabla de gastos de transporte
                    </caption>
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Donde</th>
                            <th>Colectivo ID</th>
                            <th>Propio ID</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        foreach ($gastosAlumno as $value) {
                            ?>

                        <form name="form" action="gestionarGastosTransporte" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" name ="idGasto" value='' readonly></td>
                                <td><input type="text" name ="tipoGasto" value=''></td>
                                <td><input type="text" name ="dondeGasto" value=""></td>
                                <td><input type="text" name ="colectivoIdGasto" value=""></td>
                                <td><input type="text" name ="propioIdGasto" value=''></td>

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