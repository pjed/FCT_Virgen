@extends('maestra.maestraAdmin')

@section('titulo') 
Gestionar tutores
@endsection

@section('contenido') 

<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar Usuarios</a></div>
                <div class="breadcrumb-item active"><a href="gestionarTutores">Tutores</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de tutores</h2>
        </div>
    </div>

    <!-- Tabla de tutores -->
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
                            <th>Teléfono</th>
                            <th>Ciclo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaTutores as $value) {
                            ?>
                        <form action="gestionarTablaTutores" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $value->foto; ?>"/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name="dni" value="<?php echo $value->usuarios_dni; ?>" readonly/>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="nombre" value="<?php echo $value->nombre; ?>" required/></td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name="apellidos" value="<?php echo $value->apellidos; ?>" required/></td>
                                <td><input type="email" class="form-control form-control-sm form-control-md" name="email" value="<?php echo $value->email; ?>" required/></td>
                                <td><input type="tel" class="form-control form-control-sm form-control-md" name="telefono" value="<?php echo $value->telefono; ?>" title="Introduzca un teléfono válido" required pattern="[6-9]{1}[0-9]{8}"/></td>
                                <td>
                                    <select name="selectCiclo">

                                        <option value="<?php echo $value->cursos_id_curso ?>" selected>
                                            <?php echo $value->cursos_id_curso ?>
                                        </option>

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
                                </td>

                                <td>
                                    <button type="submit" class="btn editar" name="editar" ></button>
                                    <button type="submit" class="btn eliminar" name="eliminar" ></button>
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
</div>

<div class="row">
    <div class="col-sm col-md col-lg">
        {{ $listaTutores->links()}}
    </div>
</div>
@endsection