@extends('maestra.maestraTutor')

@section('titulo') 
Consultar Gastos por curso
@endsection

@section('contenido') 
<h2 class="text-center">Bienvenido/a Tutor/a</h2>

<div class="row container-fluid">
    <div class="col-12 container panel_informativo ">
        <div class="row h-100 justify-content-center align-items-center">
            <p>Que puedo hacer:</p>
            <ol>
                <li>Consultar gastos de comida y transporte por curso.</li>
                <li>Consultar gastos de comida y transporte por alumno.</li>
                <li>Puede modificar y exportar los documentos en .excel y .pdf</li>
                <ul>
                    <li>Memoria de alumnos FCT (excel).</li>
                    <li>Memoria de alumnos FP DUAL (excel).</li>
                    <li>Recibí de FCT (pdf).</li>
                    <li>Recibí de FP DUAL (pdf).</li>
                </ul>
                <li>Puede consultar, modificar y eliminar prácticas.</li>
                <li>Puede consultar, modificar y eliminar responsables.</li>
                <li>Puede consultar, modificar y eliminar empresas.</li>
                <li>En el perfil puede cambiar su contraseña y nombre de usuario.</li>
                <li>Puede cambiar de rol si tiene más de un rol.</li>
            </ol>
        </div>
    </div>
</div>

@endsection