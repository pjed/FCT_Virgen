@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar alumnos
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarAlumnos">Alumnos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de alumnos</h2>
        </div>
    </div>

    <!-- Buscador Alumnos-->
    <div class="row">
        <div class="col-sm-9 col-md-9"></div>
        <div class="col-sm-3 col-md-3">
            <form action="buscarAlumnos" method="POST">
                {{ csrf_field() }}
                <input type="text" id="keywords" name="keywords" placeholder="nombre, apellido, correo" size="30" maxlength="30">
                <button type="submit" class="buscar btn btn-primary" name="search"></button>
            </form>
        </div>
    </div>

    <!-- Tabla de alumnos -->
    <div class="row">
        <div class="col-sm col-md">
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
                            <th>Iban</th>
                            <th>Ciclo</th>
                            <th>
                                <!-- Añadir Alumno -->
                                <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                                </button> 
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">      
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">                            
                                                <h3 class="text-center">Añadir Alumno</h3>
                                                <!-- Formulario modal para crear un alumno -->
                                                <div class="row justify-content-center" id="crearAlumno">
                                                    <form action="gestionarAlumnos" method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *DNI:
                                                                <input type="text" class="form-control form-control-sm" name="dni" pattern="[0-9]{8}[A-Za-z]{1}" required/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Nombre:
                                                                <input type="text" class="form-control form-control-sm" name="nombre" required/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Apellidos:
                                                                <input type="text" class="form-control form-control-sm" name="apellidos" required/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                *Domicilio:
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" required />
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Móvil:
                                                                <input type="text" class="form-control form-control-sm" name="movil" pattern="[6-7]{1}[0-9]{8}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Teléfono:
                                                                <input type="tel" class="form-control form-control-sm" name="telefono" pattern="[9]{1}[0-9]{8}"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="email" class="form-control form-control-sm" name="email" required/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Iban:
                                                                <input type="text" class="form-control form-control-sm" name="iban" pattern="^ES\d{22}$"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Ciclo:
                                                                <select name="selectCiclo">
                                                                    <?php foreach ($listaCiclos as $value1) { ?>
                                                                        <option value="<?php echo $value1->id; ?>"><?php echo $value1->id; ?></option>
                                                                    <?php } ?>
                                                                </select>
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
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($buscarA != null)
                        <?php foreach ($buscarA as $value) { ?>
                        <form action="gestionarAlumnos" method="POST">
                            {{ csrf_field() }}
                            <tr class="bg-success">
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $value->dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="domicilio" value="<?php echo $value->domicilio; ?>"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" pattern="[9]{1}[0-9]{8}" title="Introduzca un teléfono válido"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="movil" value="<?php echo $value->movil; ?>" required pattern="[6-7]{1}[0-9]{8}"  title="Introduzca un teléfono válido"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="iban" value="<?php echo $value->iban; ?>" pattern="^ES\d{22}$"/></td>
                                <td>
                                    <select class="sel" name="selectCiclo">
                                        <?php foreach ($listaCiclos as $value1) { ?>
                                            <option value="<?php echo $value1->id; ?>" <?php if ($value1->id == $value->curso) { ?>selected<?php } ?>><?php echo $value1->id; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn editar" name="editar" ></button>
                                    <button type="submit" class="btn eliminar" name="eliminar" ></button>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                    @else
                    <?php foreach ($listaAlumnos as $value) { ?>
                        <form action="gestionarAlumnos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $value->dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="domicilio" value="<?php echo $value->domicilio; ?>"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" pattern="[9]{1}[0-9]{8}" title="Introduzca un teléfono válido"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="movil" value="<?php echo $value->movil; ?>" required pattern="[6-7]{1}[0-9]{8}"  title="Introduzca un teléfono válido"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="iban" value="<?php echo $value->iban; ?>" pattern="^ES\d{22}$"/></td>
                                <td>
                                    <select class="sel" name="selectCiclo">
                                        <?php foreach ($listaCiclos as $value1) { ?>
                                            <option value="<?php echo $value1->id; ?>" <?php if ($value1->id == $value->curso) { ?>selected<?php } ?>><?php echo $value1->id; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn editar" name="editar" ></button>
                                    <button type="submit" class="btn eliminar" name="eliminar" ></button>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($buscarA != null)
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $buscarA->links()}}
    </div>
</div>
@else
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $listaAlumnos->links()}}
    </div>
</div>
@endif
@endsection

