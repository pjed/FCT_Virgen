@extends('maestra.maestraAdmin')
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset ('css/dropzone.css')}}"/>   
<script src="{{asset ('js/dropzone.js')}}"></script>
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
                <div class="breadcrumb-item"><a href="#">Importar Datos</a></div>
            </div>
        </nav>
    </nav>

    <h2 class="text-center">Subir Archivos</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open([ 'route' => [ 'dropzone.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
                <div>
                    <h4>Arrastrar los archivos para añadirlos a la subida</h4>
                    <h5>Archivos permitidos unicamente .sql</h5>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 5, //MB
            acceptedFiles: ".sql",
            addRemoveLinks: true,
        };
    </script>
</div>
@endsection