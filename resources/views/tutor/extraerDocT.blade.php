@extends('maestra.maestraAdmin')

@section('titulo') 
Extraer Documentos
@endsection

@section('contenido') 
<div class="row">
    <div class="col-sm col-md col-lg">
        <h2 class="text-center">Extraer Documentos</h2>

        <form action="extraerDocT" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label>
                    Grupo:      
                    <input type="text" id="grupo" class="form-control form-control-sm form-control-md form-control-lg" name="grupo" value=""/>
                </label>
            </div>
            <div class="form-group ">
                <label>
                    Tutor:      
                    <input type="text" id="tutor" class="form-control form-control-sm form-control-md form-control-lg" name="tutor" value=""/>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Recibí (PDF):      
                    <input type="text" id="recibiFCT" class="btn btn-primary" name="recibiFCT" value="Anexo V Recibí FCT"/><a href="">FCT</a>
                    <input type="text" id="recibiFPDUAL" class="btn btn-primary" name="recibiFPDUAL" value="Anexo XV Recibí FP DUAL"/><a href="">FP DUAL</a>
                </label>
            </div>
            <div class="form-group">
                <label>
                    Memoria alumnos (EXCEL):      
                    <input type="submit" id="memoriaAlumnos" class="btn btn-primary" name="memoriaAlumnos" value="Memoria alumnos"/>
                </label>
            </div>
        </form>
    </div>
</div>  
@endsection