@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Responsable
@endsection

@section('css') 
<link rel="stylesheet" type="text/css" href="{{asset ('css/css_gestionar.css')}}" media="screen" />
@endsection

@section('javascript') 
<script src="{{asset ('js/tutor/js_gestionarResponsable.js')}}"></script>
@endsection

@section('contenido') 

<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="gestionarResponsable">Gestionar Responsable</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Responsable</h2>
    </div>
</div>

<!-- Buscador Responsables-->
<div class="row">
    <div class="col-sm-9 col-md-9"></div>
    <div class="col-sm-3 col-md-3">
        <form action="buscarResponsables" method="POST">
            {{ csrf_field() }}
            <input type="text" id="keywords" name="keywords" placeholder="Nombre, apellido, email, nombre de empresa" size="30" maxlength="30">
            <button type="submit" class="buscar btn btn-primary" name="search"></button>
        </form>
    </div>
</div>

<!-- Gestionar Responsable -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Móvil</th>                        
                        <th>Empresa</th>
                        <th>
                            <!-- Añadir Responsable -->
                            <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">      
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">                        
                                            <h3 class="text-center">Añadir Responsables</h3>
                                            <form action="gestionarResponsable" method="POST">
                                                {{ csrf_field() }}
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        DNI*:
                                                        <input type="text" class="form-control form-control-sm dni"  name="dni" pattern="[0-9]{8}[A-Za-z]{1}" required/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Nombre*:
                                                        <input type="text" class="form-control form-control-sm nombre" name="nombre" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Apellidos*:
                                                        <input type="text" class="form-control form-control-sm apellido" name="apellido" required/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Email*:
                                                        <input type="email" class="form-control form-control-sm email" name="email" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Móvil*:
                                                        <input type="tel" class="form-control form-control-sm tel" name="tel"  pattern="[6-7]{1}[0-9]{8}" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Empresa*:
                                                        <select id="idEmpresa" name="idEmpresa" required>
                                                            <?php
                                                            foreach ($l1 as $k1) {
                                                                ?>
                                                                <option value="<?php echo $k1->id; ?>"><?php echo $k1->nombre_empresa; ?></option>
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
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($buscarR != null)
                    <?php foreach ($buscarR as $key) { ?>
                    <form action="gestionarResponsable" method="POST">
                        {{ csrf_field() }}
                        <tr class="bg-success">
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key['id']; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $key['dni']; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $key['nombre']; ?>" required></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="apellido" value="<?php echo $key['apellidos']; ?>" required/></td>
                            <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $key['email']; ?>" required/></td>
                            <td><input type="tel" class="form-control form-control-sm form-control-md" name="tel" value="<?php echo $key['telefono']; ?>" pattern="[0-9]{9}" required/></td>
                            <td>
                                <select class="sel" name="idEmpresa" required>
                                    <?php
                                    if ($key->empresa_id == null) {
                                        ?>
                                        <option value="0" selected >Ninguno</option>
                                        <?php
                                    }
                                    foreach ($l1 as $k1) {
                                        ?>
                                        <option value="<?php echo $k1->id; ?>" <?php if ($key->empresa_id == $k1->id) { ?> selected<?php } ?>><?php echo $k1->nombre_empresa; ?></option>
                                        <?php
                                    }
                                    ?>
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
                <?php foreach ($lu as $key) { ?>
                    <form action="gestionarResponsable" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key['id']; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $key['dni']; ?>" readonly/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $key['nombre']; ?>" required></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="apellido" value="<?php echo $key['apellidos']; ?>" required/></td>
                            <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $key['email']; ?>" required/></td>
                            <td><input type="tel" class="form-control form-control-sm form-control-md" name="tel" value="<?php echo $key['telefono']; ?>" pattern="[0-9]{9}" required/></td>
                            <td>
                                <select class="sel" name="idEmpresa" required>
                                    <?php
                                    if ($key->empresa_id == null) {
                                        ?>
                                        <option value="0" selected >Ninguno</option>
                                        <?php
                                    }
                                    foreach ($l1 as $k1) {
                                        ?>
                                        <option value="<?php echo $k1->id; ?>" <?php if ($key->empresa_id == $k1->id) { ?> selected<?php } ?>><?php echo $k1->nombre_empresa; ?></option>
                                        <?php
                                    }
                                    ?>
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
@if($buscarR != null)
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $buscarR->links()}}
    </div>
</div>
@else
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $lu->links()}}
    </div>
</div>
@endif
@endsection