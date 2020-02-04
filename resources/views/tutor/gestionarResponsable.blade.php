@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Responsable
@endsection

@section('contenido') 
<h2 class="text-center">Gestionar Responsable</h2>
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionarResponsable" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $key['dni']; ?>" readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $key['nombre']; ?>"></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellido" value="<?php echo $key['apellido']; ?>"/></td>
                            <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value="<?php echo $key['email']; ?>"/></td>
                            <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="tel" value="<?php echo $key['tel']; ?>"/></td>
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