@extends('maestra.maestraAdmin')

@section('titulo') 
Consultar Gastos por curso
@endsection

@section('contenido') 
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Consultar Gastos por curso</h2>
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="gestionarUsuarios" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                            </td>
                            <td>
                                <button type="submit" class="btn editar" name="editar"></button>
                            <!--</td><td>-->
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
@endsection