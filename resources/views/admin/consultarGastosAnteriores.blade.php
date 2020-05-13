@extends('maestra.maestraAdmin')
<!-- CSS -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/dropzone.css" rel="stylesheet" type="text/css">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/dropzone.js" type="text/javascript"></script>
@section('titulo') 
Importar Datos
@endsection

@section('contenido') 
<div class="container-fluid">
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaAd">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Gastos Anteriores</a></div>
            </div>
        </nav>
    </nav>

    <div class="container">
        <h3>Consultar Gastos Años Anteriores</h3>
        <form name="formCursos" action="consultarGastosAnteriores"  method="post">
            {{ csrf_field() }}
            Año Escolar: 
            <select name="curso">
                <?php
                if (isset($lista_cursos)) {
                    foreach ($lista_cursos as $curso) {
                        ?>
                        <option value="<?php echo $curso->cod; ?>"><?php echo $curso->descripcion; ?></option>
                        <?php
                    }
                }
                ?>
            </select><br><br>
            <input type="submit" id="verTabla" class="btn btn-primary" name="verTabla" value="Ver Gastos"/>

            <?php
            if (isset($tabla_gastos)) {
                if (count($tabla_gastos) == 0) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No existen gastos en el año academico seleccionado.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                  </div>';
                } else {
                    foreach ($tabla_gastos as $gastos) {
                        ?>
                        <option value="<?php echo $gastos->usuarios_dni; ?>"><?php echo $gastos->usuarios_dni; ?></option>
                        <?php
                    }
                }
            }
            ?>
        </form>
    </div>
    @endsection