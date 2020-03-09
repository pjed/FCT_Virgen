<?php

use App\Auxiliar\Conexion;
?>
@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar usuarios
@endsection
@section('javascript') 
<script src="{{asset ('js/admin/js_aniadirUsuario.js')}}"></script>
@endsection

@section('contenido') 



<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarUsuarios">Usuarios</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de usuarios</h2>
        </div>
    </div>    

    <!-- Tabla de usuarios -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>                
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Domicilio</th>
                            <th>Teléfono</th>
                            <th>Móvil</th>
                            <th>Rol</th>
                            <th>
                                <!-- Añadir Usuario -->
                                <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                                </button> 
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">      
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">                            
                                                <h3 class="text-center">Añadir Usuario</h3>

                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Rol del usuario:
                                                        <fieldset>
                                                            <div>
                                                                <input type="radio" name="tipoU" id="administrador" value="Administrador" onclick="handleClick(this);">
                                                                <label for="colectivo">Administrador</label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" name="tipoU" id="tutor" value="Tutor" onclick="handleClick(this);">
                                                                <label for="propio">Tutor</label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" name="tipoU" id="alumno" value="Alumno" onclick="handleClick(this);">
                                                                <label for="propio">Alumno</label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" name="tipoU" id="tutorAdministrador" value="TutorAdministrador" onclick="handleClick(this);">
                                                                <label for="propio">Tutor - Administrador</label>
                                                            </div>
                                                        </fieldset>
                                                    </label>
                                                </div>

                                                <!-- Formulario modal para crear un alumno -->
                                                <div class="row justify-content-center" id="crearAlumno">
                                                    <form action="aniadirUsuario" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="tipoU" value="Alumno">
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *DNI:
                                                                <input type="text" class="form-control form-control-sm" name="dni" pattern="{9}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Nombre:
                                                                <input type="text" class="form-control form-control-sm" name="nombre"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Apellidos:
                                                                <input type="text" class="form-control form-control-sm" name="apellidos"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Domicilio:
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" />
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="text" class="form-control form-control-sm" name="email" />
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Teléfono:
                                                                <input type="text" class="form-control form-control-sm" name="telefono"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Móvil:
                                                                <input type="text" class="form-control form-control-sm" name="movil"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Iban:
                                                                <input type="text" class="form-control form-control-sm" name="iban" />
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Ciclo:
                                                                <select name="selectCiclo">

                                                                    <?php
                                                                    foreach ($listaCiclos as $value1) {
                                                                        ?>
                                                                        <option value="<?php echo $value1['id_curso'] ?>">
                                                                            <?php echo $value1['id_curso'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <input type="submit" class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Formulario modal para crear un administrador -->
                                                <div class="row justify-content-center" id="crearAdmin">
                                                    <form action="aniadirUsuario" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="tipoU" value="Administrador">
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *DNI:
                                                                <input type="text" class="form-control form-control-sm" name="dni" pattern="{9}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Nombre:
                                                                <input type="text" class="form-control form-control-sm" name="nombre"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Apellidos:
                                                                <input type="text" class="form-control form-control-sm" name="apellidos"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Domicilio:
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" />
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="text" class="form-control form-control-sm" name="email" />
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Teléfono:
                                                                <input type="text" class="form-control form-control-sm" name="telefono"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Móvil:
                                                                <input type="text" class="form-control form-control-sm" name="movil"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <input type="submit" class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Formulario modal para crear un tutor -->
                                                <div class="row justify-content-center" id="crearTutor">
                                                    <form action="aniadirUsuario" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="tipoU" value="Tutor">
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *DNI:
                                                                <input type="text" class="form-control form-control-sm" name="dni" pattern="{9}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Nombre:
                                                                <input type="text" class="form-control form-control-sm" name="nombre"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Apellidos:
                                                                <input type="text" class="form-control form-control-sm" name="apellidos"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Domicilio:
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" />
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="text" class="form-control form-control-sm" name="email" />
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Teléfono:
                                                                <input type="text" class="form-control form-control-sm" name="telefono"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Móvil:
                                                                <input type="text" class="form-control form-control-sm" name="movil"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Ciclo:
                                                                <select name="selectCiclo">

                                                                    <?php
                                                                    foreach ($listaCiclosSinTutor as $value1) {
                                                                        ?>
                                                                        <option value="<?php echo $value1->id_curso; ?>">
                                                                            <?php echo $value1->id_curso; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <input type="submit" class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Formulario modal para crear un tutor administrador -->
                                                <div class="row justify-content-center" id="crearTutorAdmin">
                                                    <form action="aniadirUsuario" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="tipoU" value="TutorAdministrador">
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *DNI:
                                                                <input type="text" class="form-control form-control-sm" name="dni" pattern="{9}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Nombre:
                                                                <input type="text" class="form-control form-control-sm" name="nombre"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Apellidos:
                                                                <input type="text" class="form-control form-control-sm" name="apellidos"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Domicilio:
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" />
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="text" class="form-control form-control-sm" name="email" />
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Teléfono:
                                                                <input type="text" class="form-control form-control-sm" name="telefono"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Móvil:
                                                                <input type="text" class="form-control form-control-sm" name="movil"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Ciclo:
                                                                <select name="selectCiclo">

                                                                    <?php
                                                                    foreach ($listaCiclosSinTutor as $value1) {
                                                                        ?>
                                                                        <option value="<?php echo $value1->id_curso; ?>">
                                                                            <?php echo $value1->id_curso; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <input type="submit"  class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
                                                        </div>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaUsuarios as $value) {
                            ?>
                        <form action="gestionarTablaUsuarios" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" id="fotoUrl" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md " name="dni" value="<?php echo $value->dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="domicilio" value="<?php echo $value->domicilio; ?>" required/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" required pattern="[9]{1}[0-9]{8}" title="Introduzca un teléfono válido"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="movil" value="<?php echo $value->movil; ?>" required pattern="[6-7]{1}[0-9]{8}"  title="Introduzca un teléfono válido"/></td>
                                <td>
                                    <select class="sel" name="selectRol">
                                        <option value="1" <?php if ($value->rol_id == 1) { ?>selected<?php } ?>>Administrador</option>
                                        <option value="2" <?php if ($value->rol_id == 2) { ?>selected<?php } ?>>Tutor</option>
                                        <option value="3" <?php if ($value->rol_id == 3) { ?>selected<?php } ?>>Alumno</option>
                                        <option value="4" <?php if ($value->rol_id == 4) { ?>selected<?php } ?>>Tutor-Administrador</option>
                                    </select>
                                </td>

                                <?php if ($value->rol_id == 3) {
                                    ?>
                                    <td><button type="submit"class="btn editar" name="editar" /></td>
                                <?php } else {
                                    ?>
                                    <td>
                                        <button type="submit"class="btn editar" name="editar" />
                                             <!-- </td><td>-->
                                        <button type="submit" class="btn eliminar" name="eliminar" />
                                    </td>
                                    <?php
                                }
                                ?>

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

<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $listaUsuarios->links()}}
    </div>
</div>
@endsection