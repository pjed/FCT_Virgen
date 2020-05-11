<?php
$l1 = Conexion::listaCursos();
?>
@extends('maestra.maestraAdmin')

@section('titulo') 
Consultar Gastos Alumnos
@endsection

@section('javascript') 
<script src="{{asset ('js/admin/js_consultarGastoAjax.js')}}"></script>
@endsection

@section('contenido') 
<div class="container">
    <!-- Migas de pan -->
    <nav class="row">
        <nav class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="bienvenidaT">Home</a></div>
                <div class="breadcrumb-item"><a href="consultarGastosAjax">Consultar Gastos</a></div>
            </div>
        </nav>
    </nav>

    <!-- Título página -->
    <div class="row">
        <div class="col-sm col-md">
            <h2 class="text-center">Consultar Gastos</h2>
        </div>
    </div>

    <!-- Seleccionar curso -->
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3">
            <div id="consultarGastosAjaxCiclo">
                <label class="text-center" for='ciclo'>
                    Ciclo:
                    <select id="ciclo" class="sel" name="ciclo">  
                        <?php
                        foreach ($l1 as $value) {
                            ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->id; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label> 
            </div>
        </div>
    </div>
    <!-- Seleccionar alumno -->
    <div class="row justify-content-center">
        <div class="col-sm-3 col-md-3">
            <div id="consultarGastosAjaxDniAlumno">
                <label class="text-center">
                    Alumno:
                    <select id="dniAlumno" class="sel" name="dniAlumno">                                    

                    </select>
                </label>
            </div>
        </div>
    </div>
    <div id="tablas">
    </div>
</div>
<!-- Modal  Editar Colectivo -->
<div class="modal fade" id="editarColectivo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center">Modificar Gasto Colectivo</h3>
                <form action="consultarGastos" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Donde:
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="idTransporteCol" name ="idTransporte">
                            <input type="text" class="form-control form-control-sm form-control-md" id="dondeCol" name="donde"/>
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="IDCol" name="ID"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Importe:
                            <input type="number" step="0.01" class="form-control form-control-sm" id="precioCol" name="precio"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Foto:
                            <div id="fotoCol">
                            </div>
                            <input type="file" class="form-control form-control-sm form-control-md" name="foto">
                        </label>
                    </div>
                    <div class="row justify-content-center form-group">
                        <input type="submit" class="btn btn-sm btn-primary" name="editarCol" value="Modificar" />
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Editar Propio -->
<div class="modal fade" id="editarPropio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center">Modificar Gasto Propio</h3>
                <form action="consultarGastos" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Donde:
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="idTransporteP" name ="idTransporte">
                            <input type="text" class="form-control form-control-sm form-control-md" id="dondeP" name="donde"/>
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="IDP" name="ID"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Importe:
                            <input type="number" step="0.01" class="form-control form-control-sm" id="precioP" name="precio"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            KM/s:                            
                            <input type="number" class="form-control form-control-sm form-control-md" id="kmsP" name ="kms">
                        </label>
                    </div>
                    <div class="row justify-content-center form-group">
                        <input type="submit" class="btn btn-sm btn-primary" name="editarP" value="Modificar" />
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Editar Comida -->
<div class="modal fade" id="editarComida" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center">Modificar Gasto Comida</h3>
                <form action="consultarGastos" method="POST">
                    {{ csrf_field() }} 
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Fecha:
                            <input type="date" class="form-control form-control-sm form-control-md" id="fechaCom" name="fecha"/>
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="idGasto" name ="idGasto">
                            <input type="hidden" class="form-control form-control-sm form-control-md" id="IDCom" name="ID"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Importe:
                            <input type="number" step="0.01" class="form-control form-control-sm" id="precioCom" name="importe"/>
                        </label>
                    </div>
                    <div class="form-group">                                 
                        <label class="col-sm text-center">
                            Foto:
                            <div id="fotoCom">
                            </div>
                            <input type="file" class="form-control form-control-sm form-control-md" name="foto">
                        </label>
                    </div>
                    <div class="row justify-content-center form-group">
                        <input type="submit" class="btn btn-sm btn-primary" name="editarCom" value="Modificar" />
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
@endsection