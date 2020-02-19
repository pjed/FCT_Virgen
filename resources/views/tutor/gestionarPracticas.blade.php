
<?php

use App\Auxiliar\Conexion;

$lu = Conexion::listarPracticasPagination();
$l1 = Conexion::listarEmpresas();
$l2 = Conexion::listarAlumnoPorTutor();
$l3 = Conexion::listarResponsables();
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar  Practicas
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="#">Gestionar Practicas</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Practicas</h2>
    </div>
</div>

<!-- Añadir Practicas -->
<div class="row justify-content-center">
    <div class="col-sm col-md">
        <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
        </button>
        <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 class="text-center">Añadir Practicas</h3>
                            <form action="gestionarPracticas" method="POST">
                                {{ csrf_field() }}
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Empresa:
                                        <select name="idEmpresa">
                                            <?php
                                            foreach ($l1 as $k1) {
                                                ?>
                                                <option value="<?php echo $k1->id; ?>"><?php echo $k1->nombre; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Alumno:
                                        <select name="dniAlumno">                                    
                                            <?php
                                            foreach ($l2 as $k2) {
                                                ?>
                                                <option value="<?php echo $k2->dni; ?>"> <?php echo $k2->nombre . ', ' . $k2->apellidos; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Responsable:
                                        <select name="idResponsable">
                                            <?php
                                            foreach ($l3 as $k3) {
                                                ?>
                                                <option value="<?php echo $k3->id; ?>"><?php echo $k3->nombre . ', ' . $k3->apellidos; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Cod proyecto:
                                        <input type="text" class="codProyecto form-control form-control-sm" name="codProyecto" pattern="[0-9]{6}"/>
                                    </label>
                                    <label class="col-sm text-center">
                                        Gasto Total:
                                        <input type="text" class="form-control form-control-sm" name="gasto"/>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Apto:
                                        <input type="checkbox" class="form-control form-control-sm" name="apto"/>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <label class="col-sm text-center">
                                        Fecha inicio:
                                        <input type="date" class="form-control form-control-sm" name="fechaInicio"/>
                                    </label>
                                    <label class="col-sm text-center">
                                        Fecha fin:
                                        <input type="date" class="form-control form-control-sm" name="fechaFin"/>
                                    </label>
                                </div>
                                <div class="row justify-content-center form-group">
                                    <input type="submit" id="añadir" class="btn btn-sm btn-primary" name="aniadir" value="añadir" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div> 
<!-- Gestionar Practicas -->
<div class="row">
    <div class="col-sm col-md">
        <div class="table-responsive ">
            <table class="table  table-sm  table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>       
                        <th>Nombre_Empresa</th>                      
                        <th>Nombre_Alumno</th>
                        <th>Cod_proyecto</th>                    
                        <th>Nombre_Responsable</th>
                        <th>Gasto</th>
                        <th>Apto</th> 
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Recibí</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionarPracticas" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <select class="sel" name="idEmpresa">
                                    <?php
                                    foreach ($l1 as $k1) {
                                        ?>
                                        <option value="<?php echo $k1->id; ?>" <?php if ($key->idEmpresa == $k1->id) { ?> selected<?php } ?>><?php echo $k1->nombre; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="sel" name="dniAlumno">                                    
                                    <?php
                                    foreach ($l2 as $k2) {
                                        ?>                                    
                                        <option value="<?php echo $k2->dni; ?>" <?php if ($key->dniAlumno == $k2->dni) { ?> selected <?php } ?> > <?php echo $k2->nombre . ', ' . $k2->apellidos; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" class="codProyecto form-control form-control-sm form-control-md" name="codProyecto" value="<?php echo $key->codProyecto; ?>"/></td>
                            <td>
                                <select name="idResponsable">
                                    <?php
                                    foreach ($l3 as $k3) {
                                        ?>
                                        <option value="<?php echo $k3->id; ?>" <?php if ($key->idResponsable == $k3->id) { ?> selected<?php } ?>><?php echo $k3->nombre . ', ' . $k3->apellidos; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->id; ?>" readonly/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="gasto" value="<?php echo $key->gasto; ?>"/>
                            </td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md" name="apto" <?php if ($key->apto == 1) { ?>checked<?php } ?>/></td>
                            <td><input type="date" class="form-control form-control-sm form-control-md" name="fechaInicio" value="<?php echo $key->fechaInicio; ?>"/></td>
                            <td><input type="date" class="form-control form-control-sm form-control-md" name="fechaFin" value="<?php echo $key->fechaFin; ?>"/></td>
                            <td>
                                <input type="submit" id="recibiFCT" class="btn btn-primary btn-sm" name="recibiFCT" value="FCT"/>
                                <input type="submit" id="recibiFPDUAL" class="btn btn-primary btn-sm" name="recibiFPDUAL" value="FP DUAL"/>
                            </td>
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
<div class="row justify-content-center">
    <div class="col-sm col-md col-lg">
        {{ $lu->links()}}
    </div>
</div>

@endsection
