@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar usuarios
@endsection

@section('contenido') 

<?php
$listaUsuarios = Conexion::listarUsuarios();
$listaRoles = Conexion::obtenerRolesUsuarios();
?>

<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarUsuarios">Usuarios</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de usuarios</h2>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <caption class="text-center blanco">
                        Tabla de usuarios
                    </caption>
                    <thead class="thead-dark">
                        <tr>                
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Iban</th>
                            <th>Rol</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaUsuarios as $value) {
                            ?>
                        <form action="gestionarTablaUsuarios" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $value['dni']; ?>" readonly/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $value['nombre']; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellidos" value="<?php echo $value['apellidos']; ?>"/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value="<?php echo $value['email']; ?>"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="telefono" value="<?php echo $value['telefono']; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="iban" value="<?php echo $value['iban']; ?>"/></td>
                                <td>
                                    <fieldset>

                                        <div>
                                            <input type="checkbox" id="admin" name="rol" value="administrador">
                                            <label for="admin">Administrador</label>
                                        </div>

                                        <div>
                                            <input type="checkbox" id="tutor" name="rol" value="tutor">
                                            <label for="tutor">Tutor</label>
                                        </div>

                                        <div>
                                            <input type="checkbox" id="alumno" name="rol" value="alumno">
                                            <label for="alumno">Alumno</label>
                                        </div>
                                    </fieldset>
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