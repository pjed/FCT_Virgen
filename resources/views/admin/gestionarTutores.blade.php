@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar tutores
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarTutores">Tutores</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de tutores</h2>
        </div>
    </div>

    <!-- Tabla de tutores -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <caption class="text-center blanco">
                        Tabla de tutores
                    </caption>
                    <thead class="thead-dark">
                        <tr>                
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tutor</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaAlumnos as $value) {
                            ?>
                        <form action="gestionarTablaTutores" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="" readonly/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value=""/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellidos" value=""/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value=""/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="telefono" value=""/></td>
                                <td>
                                    <select name="selectCiclo">
                                        <?php
                                        foreach ($listaCiclos as $value) {
                                            ?>
                                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>

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