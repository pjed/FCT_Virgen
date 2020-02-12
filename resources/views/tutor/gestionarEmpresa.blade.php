
<?php

use App\Auxiliar\Conexion;

$lu = Conexion::listarEmpresasPagination();
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Empresa
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="#">Gestionar Empresa</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Empresa</h2>
    </div>
</div>
<!-- Añadir Empresa -->
<div class="row justify-content-center">
    <div class="col-sm-4 col-md-4">
        <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">      
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">                            
                            <h3>Añadir Empresas</h3>
                            <form action="gestionarEmpresa" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="text-center" >
                                        CIF de la empresa:
                                        <input type="text" class="form-control form-control-sm" name="CIF" pattern="{9}"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Nombre de la empresa:
                                        <input type="text" class="form-control form-control-sm" name="nombreEmpresa"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Direccion de la empresa:
                                        <input type="text" class="form-control form-control-sm" name="direccion" />
                                    </label>                
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Localidad:
                                        <input type="text" class="form-control form-control-sm" name="localidad" />
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Horario:
                                        <input type="text" class="form-control form-control-sm" name="horario"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Dni del representante:
                                        <input type="text" class="form-control form-control-sm" name="dniRepresentante"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="text-center" >
                                        Nombre del representante:
                                        <input type="text" class="form-control form-control-sm" name="nombreRepresentante" />
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="añadir" class="btn btn-sm btn-primary" name="aniadir" value="añadir" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </button> 
    </div>
</div> 
<!-- Gestionar Empresa -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>CIF</th>
                        <th>Nombre_empresa</th>
                        <th>DNI_Representante</th>
                        <th>Nombre_Representante</th>
                        <th>Direccion</th>
                        <th>Localidad</th>
                        <th>Horario</th>
                        <th>Nueva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionaEmpresa" method="POST">
                        {{ csrf_field() }}
                        <tr> 
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key->id; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="CIF" value="<?php echo $key->cif; ?>"/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreEmpresa" value="<?php echo $key->nombre; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="dniRepresentante" value="<?php echo $key->dni_representante; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreRepresentante" value="<?php echo $key->nombre_representante; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="direccion" value="<?php echo $key->direccion; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="localidad" value="<?php echo $key->localidad; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="horario" value="<?php echo $key->horario; ?>"/></td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md" name="nueva" <?php if ($key->nueva == 1) { ?>checked<?php } ?>/></td>
                            <td><button type="submit" id="editar" class="btn btn-sm" name="editar" /></td>
                            <td><button type="submit" id="eliminar" class="btn btn-sm" name="eliminar" /></td>
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