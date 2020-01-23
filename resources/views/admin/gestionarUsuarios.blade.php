@extends('maestra.maestraAdmin')
@section('contenido') 
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestión de usuarios</h2>
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>                
                        <th>DNI</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionarUsuarios" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" id="dni" name="dni" value="<?php echo $key['DNI']; ?>" readonly/></td>
                            <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" id="correo" name="correo" value="<?php echo $key['correo']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" id="nombre" name="nombre" value="<?php echo $key['Nombre']; ?>" pattern="[A-Za-z]{1,50}"/></td>
                            <td>

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
@endsection