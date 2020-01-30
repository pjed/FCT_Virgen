@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar alumnos
@endsection

@section('contenido') 

<main>

    <?php
    $listaAlumnos = Conexion::listarAlumnos();
    ?>

    <div class="container-fluid">  

        <!-- Migas de pan -->
        <nav class="row">
            <nav class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                    <div class="breadcrumb-item"><a href="">Gestionar Usuarios</a></div>
                    <div class="breadcrumb-item active"><a href="gestionarAlumnos">Alumnos</a></div>
                </div>
            </nav>
        </nav>

        <!-- Título página -->
        <div class="row">
            <div class="col-sm col-md col-lg">
                <h2 class="text-center">Gestión de alumnos</h2>
            </div>
        </div>

        <!-- Tabla de alumnos -->
        <div class="row">
            <div class="col-sm col-md col-lg">
                <div class="table-responsive ">
                    <table class="table table-striped  table-hover table-bordered">
                        <caption class="text-center blanco">
                            Tabla de alumnos
                        </caption>
                        <thead class="thead-dark">
                            <tr>                
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Iban</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listaAlumnos as $value) {
                                ?>
                            <form action="gestionarTablaAlumnos" method="POST">
                                {{ csrf_field() }}
                                <tr>
                                    <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $value['dni']; ?>" readonly/></td>
                                    <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $value['nombre']; ?>"/></td>
                                    <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellidos" value="<?php echo $value['apellidos']; ?>"/></td>
                                    <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value="<?php echo $value['email']; ?>"/></td>
                                    <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="telefono" value="<?php echo $value['telefono']; ?>"/></td>
                                    <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="iban" value="<?php echo $value['iban']; ?>"/></td>

                                    <td><button type="submit" id="editar" class="btn" name="editar" value=""/></td>
                                    <td><button type="submit" id="eliminar" class="btn" name="eliminar" value=""/></td>
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
</main>
@endsection