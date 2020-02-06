
<?php

use App\Auxiliar\Conexion;

$lu = Conexion::listarResponsablesPagination();
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Responsable
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="#">Gestionar Responsable</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Responsable</h2>
    </div>
</div>
<!-- Añadir Responsable -->
<div class="row justify-content-center">
    <div class="col-sm-4 col-md-4">
        <form action="gestionarResponsable" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="dni"/>
            </div>
                <td><input type="text" class="form-control form-control-sm" name="nombre"/>
                <td><input type="text" class="form-control form-control-sm" name="apellido" />
                <td><input type="email" class="form-control form-control-sm" name="email" />
                <td><input type="tel" class="form-control form-control-sm" pattern="[0-9]{9}"/>
                <td><button type="submit" id="editar" class="btn" name="aniadir" value="añadir"/>
            </tr>
        </form>
    </div>
</div> 
<!-- Gestionar Responsable -->
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
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md form-control-lg" name="id" value="<?php echo $key['id']; ?>" readonly/>
                                <input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $key['dni']; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $key['nombre']; ?>"></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellido" value="<?php echo $key['apellido']; ?>"/></td>
                            <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value="<?php echo $key['email']; ?>"/></td>
                            <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="tel" value="<?php echo $key['tel']; ?>" pattern="[0-9]{9}"/></td>
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
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $lu->links()}}
    </div>
</div>
@endsection