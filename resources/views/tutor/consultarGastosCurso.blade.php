@extends('maestraAdmin')
@section('contenido') 
<div class="container-fluid">  
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de usuarios</h2>
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>                                     
                            <th>Activo</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Edad</th>
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
                                <td>
                                    <label class="custom-control custom-checkbox">                                                    
                                        <input type="checkbox" class="acti custom-control-input" name="activo" <?php if ($key['activo'] == 1) { ?> checked <?php } ?>/>
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $key['DNI']; ?>" readonly/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="correo" value="<?php echo $key['correo']; ?>"readonly/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="tel" value="<?php echo $key['Tfno']; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $key['Nombre']; ?>" pattern="[A-Za-z]{1,50}"/></td>
                                <td><input type="number" class="form-control form-control-sm form-control-md form-control-lg" name="edad" value="<?php echo $key['edad']; ?>"/></td>
                                <td>
                                    <select name='rol'>
                                        <option value="Administrador"<?php if ($key['idRol'] == 2) { ?>selected <?php } ?>>Administrador</option>
                                        <option value="Gestor"<?php if ($key['idRol'] == 1) { ?>selected <?php } ?>>Gestor</option>
                                        <option value="Usuario"<?php if ($key['idRol'] == 0) { ?>selected <?php } ?>>Usuario</option>
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