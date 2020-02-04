@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Empresa
@endsection

@section('contenido') 
<h2 class="text-center">Gestionar Empresa</h2>
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
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="CIF" value="<?php echo $key['CIF']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombreEmpresa" value="<?php echo $key['nombreEmpresa']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dniRepresentante" value="<?php echo $key['dniRepresentante']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombreRepresentante" value="<?php echo $key['nombreRepresentante']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="direccion" value="<?php echo $key['direccion']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="localidad" value="<?php echo $key['localidad']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="horario" value="<?php echo $key['horario']; ?>"/></td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md form-control-lg" name="nueva" <?php if ($key['nueva'] == 1) { ?>checked<?php } ?>/>Apto</td>
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
@endsection