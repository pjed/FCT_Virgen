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
    @if ($gastosAlumno != null)
    <!-- Tabla de gastos transporte colectivo del usuario -->
    <div id="colectivo" class="row justify-content-center">
        <div class="col-sm col-md-8">
            <div class="table-responsive">
                <h3 class="text-center">Colectivo</h3>
                <table class="table table-sm table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Donde es</th>
                            <th>Foto</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($gastosAlumno as $key) {
                            ?>

                        <form name="form" action="gestionarGastosTransporte" method="POST"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>'/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="ID" value='<?php echo $key->idColectivos; ?>'/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name ="donde" value='<?php echo $key->donde; ?>' readonly/>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name="fotoUrl" value="<?php echo $key->foto; ?>"/>
                                    <a  href="<?php echo $key->foto; ?>" target="_blank"> <?php echo '<img alt="ticketGasto" class="foto_small" src="' . $key->foto . '"/>'; ?></a>
                                    <input type="file" class="form-control form-control-sm form-control-md"  name="foto">
                                </td>
                                <td><input type="number" step="0.01" class="form-control form-control-sm form-control-md" name ="precio" value='<?php echo $key->precio; ?>'/></td>

                                <td>
                                    <button type="submit" class="btn editar" name="editarC" ></button>
                                         <!-- </td><td>-->
                                    <button type="submit" class="btn eliminar" name="eliminarC" ></button>
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
    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">
            {{ $gastosAlumno->links()}}
        </div>
    </div>
    @endif
    @if ($gastosAlumno1 != null)
    <!-- Tabla de gastos transporte propio del usuario -->
    <div id="propio" class="row">
        <div class="col-md-12">
            <h3 class="text-center">Propio</h3>
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Donde es</th>
                            <th>KMS</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($gastosAlumno1 as $key) {
                            ?>
                        <form name="form" action="gestionarGastosTransporte" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="idTransporte" value='<?php echo $key->idTransporte; ?>'/>
                                    <input type="hidden" class="form-control form-control-sm form-control-md" name ="ID" value='<?php echo $key->idPropios; ?>'/>
                                    <input type="text" class="form-control form-control-sm form-control-md" name ="donde" value='<?php echo $key->donde; ?>' readonly>
                                </td>
                                <td><input type="number" class="form-control form-control-sm form-control-md" name ="kms" value="<?php echo $key->kms; ?>"></td>
                                <td><input type="number"  step="0.01" class="form-control form-control-sm form-control-md" name ="precio" value='<?php echo $key->precio; ?>'></td>
                                <td>
                                    <button type="submit" class="btn editar" name="editarP"></button>
                                         <!-- </td><td>-->
                                    <button type="submit" class="btn eliminar" name="eliminarP" ></button>
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

    <div class="row justify-content-center">
        <div class="col-sm col-md col-lg">
            {{ $gastosAlumno1->links()}}
        </div>
    </div>
    @endif
</div>

@endsection