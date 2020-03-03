@extends('maestra.maestraAlumno')

@section('titulo') 
Gestionar gastos comida
@endsection

@section('contenido') 
<div class="container-fluid">  
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar gastos</a></div>
                <div class="breadcrumb-item active"><a href="gestionarGastosComida">Comida</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestionar gastos comida</h2>
        </div>
    </div>

    <!-- Tabla de gastos del usuario -->
    <div id="comida" class="row justify-content-center">
        <div class="col-sm-8 col-md-8">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered illo">
                    <thead class="thead-dark">
                        <tr>
                            <th>Importe</th>
                            <th>Fecha</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($gastosAlumno as $key) {
                            ?>

                        <form name="form" action="gestionarGastosComida" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idGasto" value='<?php echo $key->idGasto; ?>' readonly>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="ID" value='<?php echo $key->id; ?>' readonly>
                                    <input type="number" class="form-control form-control-sm form-control-md" name ="importe" value='<?php echo $key->importe; ?>' max="9">
                                </td>
                                <td><input type="date" class="form-control form-control-sm form-control-md"  name ="fecha" value="<?php echo $key->fecha; ?>"/></td>
                                <td>
                                    <a  href="<?php echo $key->foto; ?>" target="_blank"> <?php echo '<img name="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?></a>
                                    <input type="file" class="form-control form-control-sm form-control-md"  id="foto" name="foto">
                                </td>
                                <td><button type="submit" id="editar" class="btn" name="editar" />
                                    <!-- </td><td>-->
                                    <button type="submit" id="eliminar" class="btn" name="eliminar" /></td>
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
            {{ $gastosAlumno->links()}}
        </div>
    </div>
</div>
@endsection