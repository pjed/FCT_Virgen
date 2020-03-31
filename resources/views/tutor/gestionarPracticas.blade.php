<?php

use App\Auxiliar\Conexion;

//$lu = Conexion::listarPracticasPagination();
//$l1 = Conexion::listarEmpresas();
//$l2 = Conexion::listarAlumnoPorTutor();
//$l3 = Conexion::listarResponsables();
//$l4 = Conexion::listarAlumnoPorTutorSinPracticas();
//dd($l1,$l2,$l3,$l4);
?>
@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar  Practicas
@endsection

@section('javascript') 
<script src="{{asset ('js/tutor/js_gestionarPracticas.js')}}"></script>
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
                        <th colspan="2">Recibís</th>
                        <th>
                            <!-- Añadir Practicas -->
                            <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                            </button>
                            <!-- Modal Añadir Practicas -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="text-center">Añadir Practicas</h3>
                                            <form action="gestionarPracticas" method="POST">
                                                {{ csrf_field() }}
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Empresa:
                                                        <select id="idEmpresa" name="idEmpresa" required>
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
                                                        <select id="dniAlumno" name="dniAlumno" required>                                    
                                                            <?php
                                                            foreach ($l4 as $k4) {
                                                                ?>
                                                                <option value="<?php echo $k4->dni; ?>"> 
                                                                    <?php echo $k4->nombre . ', ' . $k4->apellidos; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Responsable:
                                                        <select id="idResponsable" name="idResponsable" required>
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
                                                        <input type="text" class="codProyecto form-control form-control-sm" name="codProyecto" pattern="[0-9]{6}" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Gasto Total:
                                                        <input type="text" class="form-control form-control-sm gasto" name="gasto"/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Apto:
                                                        <input type="checkbox" class="form-control form-control-sm apto"  name="apto" />
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Fecha inicio:
                                                        <input type="date" class="form-control form-control-sm fechaInicio" name="fechaInicio" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Fecha fin:
                                                        <input type="date" class="form-control form-control-sm fechaFin" name="fechaFin"/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
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
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="idEmpresa" value="<?php echo $key->idEmpresa; ?>"/>
                                <?php
                                foreach ($l1 as $k1) {
                                    if ($key->idEmpresa == $k1->id) {
                                        ?>
                                        <input type="text" class="form-control form-control-sm form-control-md" name="nombreEmpresa" value="<?php echo $k1->nombre; ?>" readonly/>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="dniAlumno" value="<?php echo $key->dniAlumno; ?>"/>                                  
                                <?php
                                foreach ($l2 as $k2) {
                                    if ($key->dniAlumno == $k2->dni) {
                                        ?> 
                                        <input type="text" class="form-control form-control-sm form-control-md" name="nombreAlumno" value="<?php echo $k2->nombre . ', ' . $k2->apellidos; ?>" readonly/>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="codProyecto" value="<?php echo $key->codProyecto; ?>" readonly/></td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="idResponsable" value="<?php echo $key->idResponsable; ?>"/>
                                <?php
                                foreach ($l3 as $k3) {
                                    if ($key->idResponsable == $k3->id) {
                                        ?>
                                        <input type="text" class="form-control form-control-sm form-control-md" name="nombreResponsable" value="<?php echo $k3->nombre . ', ' . $k3->apellidos; ?>" readonly/>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="ID" value="<?php echo $key->idPractica; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="gasto" value="<?php echo $key->gasto; ?>" readonly/>
                            </td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md" name="apto" <?php if ($key->apto == 1) { ?> checked <?php } ?>  readonly/></td>
                            <td><input type="date" class="form-control form-control-sm form-control-md" name="fechaInicio" value="<?php echo $key->fechaInicio; ?>" readonly/></td>
                            <td><input type="date" class="form-control form-control-sm form-control-md" name="fechaFin" value="<?php echo $key->fechaFin; ?>" readonly/></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" id="addPeriodo"  data-toggle="modal" data-target="#exampleModal2">
                                    FTC
                                </button>
                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3 class="text-center">Añadir Período</h3>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Periodo:
                                                        <input type="text" name="periodo" id="periodo" placeholder="Periodo">
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <input type="submit" required id="recibiFTC" class="btn btn-primary btn-sm" name="recibiFCT" value="Generar"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary" id="addPeriodo2" data-toggle="modal" data-target="#exampleModal3">
                                    FCT DUAL
                                </button> 
                                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3 class="text-center">Añadir Período</h3>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Modalidad:
                                                        <select name="modalidad">
                                                            <option selected value="0">Elige una modalidad</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                        </select>
                                                    </label>

                                                    <label class="col-sm text-center">
                                                        Duración del proyecto:
                                                        <select name="duracion">
                                                            <option selected value="0">Elige duración</option>
                                                            <option value="1">CURSO</option>
                                                            <option value="2">CURSOS</option>
                                                        </select>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Código del Proyecto:
                                                        <input type="text" name="codigo" id="codigo" placeholder="Código" value="CLM" maxlength="6">
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Curso Académico de Inicio:
                                                        <input type="date" name="inicio" id="inicio">
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Curso académico de finalización:
                                                        <input type="date" name="final" id="final">
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <input type="submit" id="recibiFPDUAL" class="btn btn-primary btn-sm" name="recibiFPDUAL" value="Generar"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <!-- Editar Practicas -->                                
                                <!--<button type="submit" class="btn editar" name="editar" ></button>-->
                                <button type="button" id="modificar" class="btn editar" value="<?php echo $key->idPractica; ?>"  data-toggle="modal" data-target="#editar"></button>
                                <!-- Modal  Editar Practicas -->
                                <div id="modalModificar">
                                    
                                </div>
                                         <!-- </td><td>-->
                                <!--<button type="submit" class="btn eliminar" name="eliminar" ></button>-->
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
