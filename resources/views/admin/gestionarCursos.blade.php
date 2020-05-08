@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar Cursos
@endsection

@section('javascript') 
<script src="{{asset ('js/admin/js_gestionarCurso.js')}}"></script>
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item active"><a href="gestionarCursos">Gestionar Cursos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestionar Cursos</h2>
        </div>
    </div>

    <!-- Buscador Cursos-->
    <div class="row">
        <div class="col-sm-9 col-md-9"></div>
        <div class="col-sm-3 col-md-3">
            <form action="buscarCursos" method="POST">
                {{ csrf_field() }}
                <input type="text" id="keywords" name="keywords" placeholder="ciclo, descripcion, familia" size="30" maxlength="30">
                <button type="submit" class="buscar btn btn-primary" name="search"></button>
            </form>
        </div>
    </div>

    <!-- Tabla de Cursos -->
    <div class="row">
        <div class="col-sm col-md">
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>                
                            <th>Curso</th>
                            <th>Descripción</th>
                            <th>Año Académico</th>
                            <th>Familia</th>
                            <th>Horas</th>
                            <th>
                                <!-- Añadir -curso -->
                                <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">      
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">                          
                                                <h3 class="text-center">Añadir Cursos</h3>
                                                <form action="gestionarCursos" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="row justify-content-center form-group">
                                                        <label class="col-sm text-center">
                                                            Grupo:
                                                            <input type="text" class="form-control form-control-sm form-control-md id" name="id" required/>
                                                        </label>
                                                    </div>
                                                    <div class="row justify-content-center form-group">
                                                        <label class="col-sm text-center">
                                                            Descripción:
                                                            <input type="text" class="form-control form-control-sm form-control-md descripcion" name="descripcion" required/>
                                                        </label>           
                                                        <label class="col-sm text-center" >
                                                            Año Académico:
                                                            <input type="text" class="form-control form-control-sm form-control-md anioAcademico"  name="anioAcademico" placeholder="2019/2020" required/>
                                                        </label>
                                                    </div>
                                                    <div class="row justify-content-center form-group">
                                                        <label class="col-sm text-center">
                                                            Familia:
                                                            <input type="text" class="form-control form-control-sm form-control-md familia"  name="familia" required/>
                                                        </label>
                                                        <label class="col-sm text-center" >
                                                            Total de horas:
                                                            <input type="number" class="form-control form-control-sm form-control-md horas"  name="horas"  required/>
                                                        </label>
                                                    </div>
                                                    <div class="row justify-content-center form-group">
                                                        <input type="submit" class="btn btn-sm btn-primary" name="aniadir" value="añadir" />
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
                        @if($buscarC != null)
                        <?php foreach ($buscarC as $key) { ?>
                        <form action="gestionarCursos" method="POST">
                            {{ csrf_field() }}
                            <tr class="bg-success">
                                <td><input type="text" class="form-control form-control-sm" name="id" value="<?php echo $key->id; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="descripcion" value="<?php echo $key->descripcion; ?>"  required/></td>
                                <td><input type="text" class="form-control form-control-sm" name="anioAcademico" value="<?php echo $key->anioAcademico; ?>" placeholder="2019/2020"></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="familia" value="<?php echo $key->familia; ?>"/></td>
                                <td><input type="number" class="form-control form-control-sm" name="horas" value="<?php echo $key->horas; ?>"/></td>
                                <td>
                                    <button type="submit" class="btn editar" name="editar" ></button>
                                    <button type="submit" class="btn eliminar" name="eliminar" ></button>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                    @else
                    <?php foreach ($l1 as $key) { ?>
                        <form action="gestionarCursos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" name="id" value="<?php echo $key->id; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="descripcion" value="<?php echo $key->descripcion; ?>"  required/></td>
                                <td><input type="text" class="form-control form-control-sm" name="anioAcademico" value="<?php echo $key->anioAcademico; ?>" placeholder="2019/2020"></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="familia" value="<?php echo $key->familia; ?>"/></td>
                                <td><input type="number" class="form-control form-control-sm" name="horas" value="<?php echo $key->horas; ?>"/></td>
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

@if($buscarC != null)
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $buscarC->links()}}
    </div>
</div>
@else
<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $l1->links()}}
    </div>
</div>
@endif
@endsection