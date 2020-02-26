<?php
$listaUsuarios = Conexion::listarUsuarios();
$listaCiclos = Conexion::listarCiclos();
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
                    <caption class="text-center blanco">
                        Tabla de usuarios
                    </caption>
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
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">      
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">                            
                                                <h3 class="text-center">Añadir Usuario</h3>
                                                <form action="aniadirUsuario" method="POST">
                                                    {{ csrf_field() }}
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

                                                    <div class="row justify-content-center" id="crearAlumno">
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
                                                    </div>
                                                    <div class="row justify-content-center form-group">
                                                        <input type="submit" id="añadir" class="btn btn-sm btn-primary" name="aniadir" value="Añadir" />
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
                        foreach ($listaUsuarios as $value) {
                            ?>
                        <form action="gestionarTablaUsuarios" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="dni" value="<?php echo $value->dni; ?>" readonly/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="nombre" value="<?php echo $value->nombre; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="apellidos" value="<?php echo $value->apellidos; ?>"/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md form-control-lg" name="email" value="<?php echo $value->email; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md form-control-lg" name="domicilio" value="<?php echo $value->domicilio; ?>"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="telefono" value="<?php echo $value->telefono; ?>"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md form-control-lg" name="movil" value="<?php echo $value->movil; ?>"/></td>
                                <td>
                                    <select class="sel" name="selectRol">
                                        <option value="<?php echo $value->rol_id; ?>" <?php if ($value->rol_id == 1) { ?>selected<?php } ?>>Administrador</option>
                                        <option value="<?php echo $value->rol_id ?>" <?php if ($value->rol_id == 2) { ?>selected<?php } ?>>Tutor</option>
                                        <option value="<?php echo $value->rol_id ?>" <?php if ($value->rol_id == 3) { ?>selected<?php } ?>>Alumno</option>
                                        <option value="<?php echo $value->rol_id ?>" <?php if ($value->rol_id == 4) { ?>selected<?php } ?>>Tutor-Administrador</option>
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

<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $listaUsuarios->links()}}
    </div>
</div>
@endsection