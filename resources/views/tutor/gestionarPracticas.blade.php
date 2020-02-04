@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar  Practicas
@endsection

@section('contenido') 
<h2 class="text-center">Gestionar Practicas</h2>
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>       
                        <th>ID</th>
                        <th>CIF</th>
                        <th>Nombre_Empresa</th>
                        <th>DNI_Alumno</th>                         
                        <th>Nombre_Alumno</th>
                        <th>Cod_proyecto</th>
                        <th>DNI_Responsable</th>                     
                        <th>Nombre_Responsable</th>
                        <th>Horario</th>
                        <th>Gasto</th>
                        <th>Apto</th> 
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionarPracticas" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="ID" value="<?php echo $key['id']; ?>" readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="CIF" value="<?php echo $key['CIF']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombreEmpresa" value="<?php echo $key['nombreEmpresa']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dniAlumno" value="<?php echo $key['dniAlumno']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombreAlumno" value="<?php echo $key['nombreAlumno']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="codProyecto" value="<?php echo $key['codProyecto']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dniResponsable" value="<?php echo $key['dniResponsable']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombreResponsable" value="<?php echo $key['nombreResponsable']; ?>"readonly/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="horario" value="<?php echo $key['horario']; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="gasto" value="<?php echo $key['gasto']; ?>" readonly/></td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md form-control-lg" name="apto" <?php if ($key['apto'] == 1) { ?>checked<?php } ?>/>Apto</td>
                            <td><input type="date" class="form-control form-control-sm form-control-md form-control-lg" name="fechaInicio" value="<?php echo $key['fechaInicio']; ?>"/></td>
                            <td><input type="date" class="form-control form-control-sm form-control-md form-control-lg" name="fechaFin" value="<?php echo $key['fechaFin']; ?>"/></td>
                            <td><button type="submit" id="editar" class="btn btn-sm" name="editar"/></td>
                            <td><button type="submit" id="eliminar" class="btn btn-sm" name="eliminar"/></td>
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