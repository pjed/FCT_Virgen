@extends('maestraAlumno')
@section('contenido') 
<div class="container-fluid">  
    <div class="row">
        <div class="col-sm col-md col-lg">
            <h2 class="text-center">Gestión de gatos</h2>
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
                        <form action="gestionGastos" method="POST">
                            {{ csrf_field() }}
                            <tr>
                                <td>

                                </td>
                                <td><button type="submit" id="editar" class="btn" name="editar" /></td>
                                <td><button type="submit" id="eliminar" class="btn" name="eliminar" /></td>
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
@endsection