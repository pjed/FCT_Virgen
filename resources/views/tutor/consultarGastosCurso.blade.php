@extends('maestra.maestraTutor')

@section('titulo') 
Consultar Gastos por curso
@endsection

@section('contenido') 
<h2 class="text-center">Consultar Gastos por curso</h2>
<div class="row">
    <div class="col-sm col-md col-lg">
        <div class="table-responsive ">
            <table class="table table-striped  table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>         
                        <th>Curso</th>
                        <th>Nº alumnos</th>
                        <th>Total gastos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lu as $key) {
                        ?>
                    <form action="consultarGastoCurso" method="POST">
                        {{ csrf_field() }}
                        <tr>
                            <td><?php echo $key['total_gasto_curso']; ?>
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
@endsection