@extends('maestra.maestraAdmin')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
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

    <!--    <h2 class="text-center">Subir Archivos</h2>
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
        </script>-->

    <div class="container">

        <form name="formDeleteDB" action="DeleteDB"  method="post">
            {{ csrf_field() }}
            <input type="submit" name="deleteDB" id="deleteDB" value="Borrar DB"> 
        </form>

        <h3>Subir Archivos</h3>
        <form method="post" action="{{url('dropzone-image-upload')}}" enctype="multipart/form-data" 
              class="dropzone" id="dropzone">
            @csrf
        </form>   
        <script type="text/javascript">
            Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function (file) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time + file.name;
                        },
                        acceptedFiles: ".sql",
                        timeout: 5000,
                        addRemoveLinks: true,
                        removedfile: function (file)
                        {
                            var name = file.upload.filename;
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                                type: 'POST',
                                url: '{{ url("uploads") }}',
                                data: {filename: name},
                                success: function (data) {
                                    console.log("Fichero borrado satisfactoriamente!!");
                                },
                                error: function (e) {
                                    console.log(e);
                                }});
                            var fileRef;
                            return (fileRef = file.previewElement) != null ?
                                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        },
                        success: function (file, response)
                        {
                            console.log(response);
                        },
                        error: function (file, response)
                        {
                            return false;
                        }
                    };
        </script>
    </div>
    @endsection