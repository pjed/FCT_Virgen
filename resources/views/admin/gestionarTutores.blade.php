@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar tutores
@endsection

@section('css')       
<link rel="stylesheet" type="text/css" href="{{asset ('css/css_activo.css')}}" media="screen" />
@endsection

@section('contenido') 
<div class="container-fluid">  
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="gestionarUsuarios">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarTutores">Tutores</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md">
            <h2 class="text-center">Gestión de tutores</h2>
        </div>
    </div>

    <!-- Buscador Tutores-->
    <div class="row">
        <div class="col-sm-9 col-md-9"></div>
        <div class="col-sm-3 col-md-3">
            <form action="buscarTutores" method="POST">
                {{ csrf_field() }}
                <input type="text" id="keywords" name="keywords" placeholder="nombre, apellido, correo" size="30" maxlength="30">
                <button type="submit" class="buscar btn btn-primary" name="search"></button>
            </form>
        </div>
    </div>

    <!-- Tabla de tutores -->
    <div class="row">
        <div class="col-sm col-md">
            <div class="table-responsive">
                <table class="table table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>      
                            <th></th>          
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Domicilio</th>
                            <th>Móvil 1</th>
                            <th>Móvil 2</th>
                            <th>Ciclo</th>
                            <th>
                                <!-- Añadir Tutor -->
                                <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#modalAniadir">
                                </button> 
                                <!-- Modal -->
                                <div class="modal fade" id="modalAniadir" tabindex="-1" role="dialog" aria-hidden="true">      
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">                            
                                                <h3 class="text-center">Añadir Tutor</h3>
                                                <!-- Formulario modal para crear un tutor -->
                                                <div class="row justify-content-center" id="crearTutor">
                                                    <form action="gestionarTutores" method="POST">
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
                                                                <input type="text" class="form-control form-control-sm" name="domicilio" required/>
                                                            </label>                
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Móvil 1:
                                                                <input type="tel" class="form-control form-control-sm" name="telefono" pattern="[6-7,9]{1}[0-9]{0,8}"/>
                                                            </label>
                                                            <label class="col-sm text-center">
                                                                Móvil 2:
                                                                <input type="tel" class="form-control form-control-sm" name="movil" pattern="[6-7,9]{1}[0-9]{0,8}"/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                *Email:
                                                                <input type="email" class="form-control form-control-sm" name="email" required/>
                                                            </label>
                                                        </div>
                                                        <div class="row justify-content-center form-group">
                                                            <label class="col-sm text-center">
                                                                Ciclo:
                                                                <select name="selectCiclo">
                                                                    <?php foreach ($listaCiclosSinTutor as $value1) { ?>
                                                                        <option value="<?php echo $value1->id_curso; ?>"><?php echo $value1->id_curso; ?></option>
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
                        @if($buscarT != null)
                        <?php foreach ($buscarT as $value) { ?>
                        <form action="gestionarTutores" method="POST">
                            {{ csrf_field() }}
                            <tr class="bg-success">
                                <?php if ($value->activo == 0) { ?>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="acti custom-control-input" name="activo"/>
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                <?php } else if ($value->activo == 1) { ?>
                                    <td>
                                        <label class="custom-control custom-checkbox">                                                    
                                            <input type="checkbox" class="acti custom-control-input" name="activo" checked/>
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                <?php } ?>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $value->usuarios_dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="domicilio" value="<?php echo $value->domicilio; ?>" required/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" pattern="[6-7,9]{1}[0-9]{0,8} title="Introduzca un teléfono válido"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="movil" value="<?php echo $value->movil; ?>" pattern="[6-7,9]{1}[0-9]{0,8}  title="Introduzca un teléfono válido"/></td>
                                <td>
                                    <select name="selectCiclo">
                                        <option value="<?php echo $value->cursos_id_curso ?>" selected><?php echo $value->cursos_id_curso ?></option>

                                        <?php foreach ($listaCiclosSinTutor as $value1) { ?>
                                            <option value="<?php echo $value1->id_curso; ?>"><?php echo $value1->id_curso; ?></option>
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
                    <?php foreach ($listaTutores as $value) { ?>
                        <form action="gestionarTutores" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <?php if ($value->activo == 0) { ?>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="acti custom-control-input" name="activo"/>
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                <?php } else if ($value->activo == 1) { ?>
                                    <td>
                                        <label class="custom-control custom-checkbox">                                                    
                                            <input type="checkbox" class="acti custom-control-input" name="activo" checked/>
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                <?php } ?>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $value->usuarios_dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>"/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="domicilio" value="<?php echo $value->domicilio; ?>" required/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" maxlength=9  title="Introduzca un teléfono válido"/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="movil" value="<?php echo $value->movil; ?>" maxlength=9  title="Introduzca un teléfono válido"/></td>
                                <td>
                                    <select name="selectCiclo">
                                        <option value="<?php echo $value->cursos_id_curso ?>" selected><?php echo $value->cursos_id_curso ?></option>

                                        <?php foreach ($listaCiclosSinTutor as $value1) { ?>
                                            <option value="<?php echo $value1->id_curso; ?>"><?php echo $value1->id_curso; ?></option>
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
@if($buscarT != null)
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $buscarT->links()}}
    </div>
</div>
@else
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $listaTutores->links()}}
    </div>
</div>
@endif
@endsection