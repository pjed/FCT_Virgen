@extends('maestra.maestraAdmin')

@section('titulo') 
Consultar Gastos por curso
@endsection

@section('contenido') 
<h2 class="text-center">Bienvenido/a Administrador/a</h2>
<div class="row container-fluid">

    <div class="col-lg-5 col-sm-12 container panel_informativo_bd">
        <div class="row justify-content-center align-items-center">
        <p>Administracion de Base de Datos</p>
            <ol>
                <li>Hay que pulsar en Gestion BBDD > Crear BBDD</li>
                <li>Hay que obtener los datos de delphos de las siguientes tablas (de nuestro centro):
                    <ul>
                        <li>Alumnos</li>
                        <li>Materias</li>
                        <li>Matriculas</li>
                        <li>Profesores</li>
                        <li>Unidades</li>
                    </ul>
                </li>
                <li>Hay que convertir los datos de csv pulsar en Gestion BBDD > Convertir csv a .sql</li>
                <li>Para importar los datos pulsar en Gestion BBDD > Importar los datos</li>
            </ol>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 container panel_informativo">
        <div class="row justify-content-center align-items-center">
            <p>Que puedo hacer:</p>
            <ol>
                <li>Gestionar todos los usuarios, pudiendo consultar, modificar y eliminar datos</li>
                <li>Gestionar todos los cursos, pudiendo consultar, modificar y eliminar datos</li>
                <li>Gestionar agrupando solo por tutores, pudiendo consultar, modificar y eliminar datos</li>
                <li>Gestionar agrupando solo por alumnos, pudiendo consultar, modificar y eliminar datos</li>
                <li>
                    Puede exportar los documentos en .excel y .pdf
                    <ul>
                        <li>Memoria de alumnos FCT (excel)</li>
                        <li>Memoria de alumnos FP DUAL (excel)</li>
                        <li>Recibí de FCT (pdf)</li>
                        <li>Recibí de FP DUAL (pdf)</li>
                    </ul>

                </li>
                <li>En el perfil puede cambiar su contraseña y nombre de usuario</li>
                <li>Puede cambiar de rol si tiene más de un rol</li>
            </ol>
        </div>
    </div>

</div>

@endsection