
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
    <div class="col-sm-4 col-md-4">
        <form action="gestionarPracticas" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="text-center">
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
                <label class="text-center">
                    Alumno:
                    <select name="dniAlumno">                                    
                        <?php
                        foreach ($l2 as $k2) {
                            ?>
                            <option value="<?php echo $k2['dni']; ?>"> <?php echo $k2['nombre'] . ', ' . $k2['apellidos']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <label class="text-center">
                    Cod proyecto:
                    <input type="text" class="codProyecto form-control form-control-sm" name="codProyecto" pattern="[0-9]{6}"/>
                </label>
                <label class="text-center">
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
            <div class="form-group">
                <label class="text-center">
                    Gasto Total:
                    <input type="text" class="form-control form-control-sm" name="gasto"/>
                </label>
                <label class="text-center">
                    Apto:
                    <input type="checkbox" class="form-control form-control-sm" name="apto"/>
                </label>
            </div>
            <div class="form-group">
                <label class="text-center">
                    Fecha inicio:
                    <input type="date" class="form-control form-control-sm" name="fechaInicio"/>
                </label>
                <label class="text-center">
                    Fecha fin:
                    <input type="date" class="form-control form-control-sm" name="fechaFin"/>
                </label>
                <input type="submit" id="añadir" class="btn btn-sm btn-primary" name="aniadir" value="añadir" />
            </div>
        </form>
    </div>
</div> 
<!-- Gestionar Practicas -->
<div class="row">
    <div class="col-sm col-md">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
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
                                <select name="idEmpresa">
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
                                <select name="dniAlumno">                                    
                                    <?php
                                    foreach ($l2 as $k2) {
                                        ?>
                                        <option value="<?php echo $k2['dni']; ?>" <?php if ($key->dniAlumno == $k2['dni']) { ?> selected <?php } ?> > <?php echo $k2['nombre'] . ', ' . $k2['apellidos']; ?></option>
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
                            <td><button type="submit" id="editar" class="btn btn-sm" name="editar"/></td>
                            <td><button type="submit" id="eliminar" class="btn btn-sm" name="eliminar"/></td>
                            <td>
                                <label>
                                    Recibí (PDF):
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="submit" id="recibiFCT" class="btn btn-primary" name="recibiFCT" value="Anexo V Recibí FCT"/>
                                        </div>
                                        <div class="col-sm">
                                            <a href="http://www.educa.jccm.es/es/fpclm/centros-formacion-profesional/formacion-centros-trabajo-proyecto.ficheros/100158-anexo5_recibi.doc">FCT</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="submit" id="recibiFPDUAL" class="btn btn-primary" name="recibiFPDUAL" value="Anexo XV Recibí FP DUAL"/>
                                        </div>
                                        <div class="col-sm">
                                            <a href="http://www.educa.jccm.es/es/fpclm/fp-dual/proyectos-formacion-profesional-dual-curso-2019-2020.ficheros/317740-Anexo%20XV%20Recib%C3%AD%20del%20alumnado.docx">FP DUAL</a>
                                        </div>
                                </label>
                            </td>
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