<?php
use App\Auxiliar\Conexion;
?>
@extends('maestra.maestraAlumno')

@section('titulo') 
Gestionar gastos transporte
@endsection

@section('contenido') 
<div class="container-fluid">  

    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAl">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gestionar gastos</a></div>
                <div class="breadcrumb-item active"><a href="gestionarGastosTransporte">Transporte</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestionar gastos transporte</h2>
        </div>
    </div>
    @if ($tipo == 1)
    <?php $gastosAlumno = Conexion::listarGastosTransportesColectivosPagination($dniAlumno);?>
    <!-- Tabla de gastos transporte colectivo del usuario -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered illo">
                    <caption class="text-center blanco">
                        Tabla de gastos de transporte colectivo
                    </caption>
                    <thead class="thead-dark">
                        <tr>
                            <th>Donde es</th>
                            <th>Nº dias</th>
                            <th>Foto</th>
                            <th>Importe</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($gastosAlumno as $key) {
                            ?>

                        <form name="form" action="gestionarGastosTransporte" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' readonly>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="ID" value='<?php echo $key->idColectivos; ?>' readonly>
                                    <input type="text" class="form-control form-control-sm form-control-md" name ="donde" value='<?php echo $key->donde; ?>' readonly>
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name ="n_diasC" value="<?php echo $key->n_diasC; ?>"></td>
                                <td>
                                    <?php echo '<img name="ticketGasto" src="data:image/jpeg;base64,' . base64_encode($key->foto) . '"/>';?>
                                    <input type="file" class="form-control form-control-sm form-control-md"  id="foto" name="foto">
                                </td>
                                <td><input type="text" class="form-control form-control-sm form-control-md" name ="precio" value='<?php echo $key->precio; ?>'></td>

                                <td><button type="submit" id="editar" class="btn" name="editarC" /></td>
                                <td><button type="submit" id="eliminar" class="btn" name="eliminarC" /></td>
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
@else
<?php $gastosAlumno = Conexion::listarGastosTransportesPropiosPagination($dniAlumno);?>
<!-- Tabla de gastos transporte propio del usuario -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered illo">
                <caption class="text-center blanco">
                    Tabla de gastos de transporte propio
                </caption>
                <thead class="thead-dark">
                    <tr>
                        <th>Donde es</th>
                        <th>Nº dias</th>
                        <th>KMS</th>
                        <th>Importe</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($gastosAlumno as $key) {
                        ?>
                    <form name="form" action="gestionarGastosTransporte" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>' readonly>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="ID" value='<?php echo $key->idPropios; ?>' readonly>
                                <input type="text" class="form-control form-control-sm form-control-md" name ="donde" value='<?php echo $key->donde; ?>' readonly>
                            </td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name ="n_diasP" value="<?php echo $key->n_diasP; ?>"></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name ="kms" value="<?php echo $key->kms; ?>"></td>
                            <td><input type="text" class="form-control form-control-sm form-control-md" name ="precio" value='<?php echo $key->precio; ?>'></td>
                            <td><button type="submit" id="editar" class="btn" name="editarP" /></td>
                            <td><button type="submit" id="eliminar" class="btn" name="eliminarP" /></td>
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
@endif
@endsection