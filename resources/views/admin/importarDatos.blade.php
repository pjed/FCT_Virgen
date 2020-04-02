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
                <div class="breadcrumb-item"><a href="#">Importar Datos</a></div>
            </div>
        </nav>
    </nav>

    <div class="container">
        <form name="formDeleteDB" action="DeleteDB"  method="post">
            {{ csrf_field() }}
            <input type="submit" name="deleteDB" id="deleteDB" value="Borrar DB"> 
        </form>
        <br>
        <h3>Subir Archivos</h3>
        <div class='content'>
            <form action="upload.php" class="dropzone" id="dropzonewidget">
                <script>
                    Dropzone.autoDiscover = false;
                    $(".dropzone").dropzone({
                        addRemoveLinks: true,
                        removedfile: function (file) {
                            var name = file.name;

                            $.ajax({
                                type: 'POST',
                                url: 'upload.php',
                                data: {name: name, request: 2},
                                sucess: function (data) {
                                    console.log('success: ' + data);
                                }
                            });
                            var _ref;
                            return (_ref = file.previewElement) != null _ref.parentNode.removeChild(file.previewElement) : void 0;
                        }
                    });
                </script>
            </form> 
        </div> 
        <p>Para borra los archivos csv del desplegable y del directorio donde se almacenan hay que hacer lo siguiente:</p>
        <p>- Una vez subidos y que en el cuadro de subir archivos se muestren</p>
        <p>- Pulsar sobre el botón Borrar Archivos CSV</p>
        <br>
        <form name="formBorrarArchivosCSV" action="BorrarArchivosCSV"  method="post">
            {{ csrf_field() }}
            <input type="submit" name="BorrarArchivosCSV" id="BorrarArchivosCSV" value="Borrar Archivos CSV"> 
        </form>
        <br>
        <form name="formImportarDatosCSV" action="ImportarDatosCSV"  method="post">
            {{ csrf_field() }}
            <input type="submit" name="ImportarDatosCSV" id="ImportarDatosCSV" value="Importar Datos CSV"> 
        </form>
    </div>
    @endsection