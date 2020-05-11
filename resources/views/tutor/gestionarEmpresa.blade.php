@extends('maestra.maestraTutor')

@section('titulo') 
Gestionar Empresa
@endsection

@section('javascript') 
<script src="{{asset ('js/tutor/js_gestionarEmpresa.js')}}"></script>
@endsection

@section('contenido') 
<!-- Migas de pan -->
<nav class="row">
    <nav class="col">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
            <div class="breadcrumb-item"><a href="gestionarEmpresa">Gestionar Empresa</a></div>
        </div>
    </nav>
</nav>

<!-- Título página -->
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Gestionar Empresa</h2>
    </div>
</div>

<!-- Buscador Empresas-->
<div class="row">
    <div class="col-sm-9 col-md-9"></div>
    <div class="col-sm-3 col-md-3">
        <form action="buscarEmpresas" method="POST">
            {{ csrf_field() }}
            <input type="text" id="keywords" name="keywords" placeholder="CIF, nombre, localidad" size="30" maxlength="30">
            <button type="submit" class="buscar btn btn-primary" name="search"></button>
        </form>
    </div>
</div>

<!-- Gestionar Empresa -->
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
                        <th>Dirección</th>
                        <th>Localidad</th>
                        <th>Horario</th>
                        <th>Nueva</th>
                        <th>
                            <!-- Añadir Empresa -->
                            <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                            </button> 
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">      
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">                            
                                            <h3 class="text-center">Añadir Empresas</h3>
                                            <form action="gestionarEmpresa" method="POST">
                                                {{ csrf_field() }}
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        CIF de la empresa:
                                                        <input type="text" class="form-control form-control-sm CIF" name="CIF" pattern="{9}" required/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Nombre de la empresa:
                                                        <input type="text" class="form-control form-control-sm nombreEmpresa" name="nombreEmpresa" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Dirección de la empresa:
                                                        <input type="text" class="form-control form-control-sm direccion" name="direccion" required/>
                                                    </label>                
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Localidad:
                                                        <input type="text" class="form-control form-control-sm localidad" name="localidad" required/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Horario:
                                                        <input type="text" class="form-control form-control-sm horario" name="horario"/>
                                                    </label>
                                                </div>
                                                <div class="row justify-content-center form-group">
                                                    <label class="col-sm text-center">
                                                        Dni del representante:
                                                        <input type="text" class="form-control form-control-sm dniRepresentante" name="dniRepresentante"  pattern="{9}"/>
                                                    </label>
                                                    <label class="col-sm text-center">
                                                        Nombre del representante:
                                                        <input type="text" class="form-control form-control-sm nombreRepresentante" name="nombreRepresentante"/>
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
                    @if($buscarE != null)
                    <?php foreach ($buscarE as $key) { ?>
                    <form action="gestionarEmpresa" method="POST">
                        {{ csrf_field() }}
                        <tr class="bg-success"> 
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key->id; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="CIF" value="<?php echo $key->cif; ?>" required/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreEmpresa" value="<?php echo $key->nombre; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="dniRepresentante" value="<?php echo $key->dni_representante; ?>" pattern="{9}"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreRepresentante" value="<?php echo $key->nombre_representante; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="direccion" value="<?php echo $key->direccion; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="localidad" value="<?php echo $key->localidad; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="horario" value="<?php echo $key->horario; ?>"/></td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md" name="nueva" <?php if ($key->nueva == 1) { ?>checked<?php } ?>/></td>
                            <td>
                                <button type="submit" class="btn editar" name="editar"></button>
                                <button type="submit" class="btn eliminar" name="eliminar" ></button>
                            </td>
                        </tr>
                    </form>
                <?php } ?>
                @else
                <?php foreach ($lu as $key) { ?>
                    <form action="gestionarEmpresa" method="POST">
                        {{ csrf_field() }}
                        <tr> 
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key->id; ?>"/>
                                <input type="text" class="form-control form-control-sm form-control-md" name="CIF" value="<?php echo $key->cif; ?>" required/>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreEmpresa" value="<?php echo $key->nombre; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="dniRepresentante" value="<?php echo $key->dni_representante; ?>" pattern="{9}"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="nombreRepresentante" value="<?php echo $key->nombre_representante; ?>"/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="direccion" value="<?php echo $key->direccion; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="localidad" value="<?php echo $key->localidad; ?>" required/></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name="horario" value="<?php echo $key->horario; ?>"/></td>
                            <td><input type="checkbox" class="form-control form-control-sm form-control-md" name="nueva" <?php if ($key->nueva == 1) { ?>checked<?php } ?>/></td>
                            <td>
                                <button type="submit" class="btn editar" name="editar"></button>
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

@if($buscarE != null)
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $buscarE->links()}}
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