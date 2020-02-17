@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar Cursos
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
    <!-- Añadir -curso -->
    <div class="row justify-content-center">
        <div class="col-sm-4 col-md-4">
            <button type="button" class="btn" id="aniadir"  data-toggle="modal" data-target="#exampleModal1">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">      
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">                          
                                <h3>Añadir Cursos</h3>
                                <form action="gestionarCursos" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="text-center" >
                                            Grupo:
                                            <input type="text" class="form-control form-control-sm form-control-md" name="id"/>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center" >
                                            Descripcion:
                                            <input type="text" class="form-control form-control-sm form-control-md" name="descripcion"/>
                                        </label>                    
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center" >
                                            Año Academico:
                                            <input type="text" class="form-control form-control-sm form-control-md" name="anioAcademico"/>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center" >
                                            Familia:
                                            <input type="text" class="form-control form-control-sm form-control-md" name="familia"/>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center" >
                                            Total de horas:
                                            <input type="number" class="form-control form-control-sm form-control-md" name="horas"/>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="añadir" class="btn btn-sm btn-primary" name="aniadir" value="añadir" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </button> 
        </div>
    </div> 

    <!-- Tabla de Cursos -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <div class="table-responsive ">
                <table class="table table-striped  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>                
                            <th>Curso</th>
                            <th>Descripcion</th>
                            <th>AnioAcademico</th>
                            <th>Familia</th>
                            <th>Horas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($l1 as $key) {
                            ?>
                        <form action="gestionarCursos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="id" value="<?php echo $key->id; ?>" /></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="descripcion" value="<?php echo $key->descripcion; ?>" /></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="anioAcademico" value="<?php echo $key->anioAcademico; ?>" /></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="familia" value="<?php echo $key->familia; ?>" /></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="horas" value="<?php echo $key->horas; ?>" /></td>

                                <td><button type="submit" id="editar" class="btn" name="editar" /></td>
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
        {{ $l1->links()}}
    </div>
</div>
@endsection