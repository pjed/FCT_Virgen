@extends('maestra.maestraAdmin')

@section('titulo') 
Perfil
@endsection

@section('contenido') 
<?php

foreach ($usu as $value) {
    $domicilio = $value['domicilio'];
    $telefono = $value['tel'];
    $movil = $value['movil'];
    $iban = $value['iban'];
    $foto = $value['foto'];
}
?>
<h1 class="text-center">Perfil Usuario</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8 container">     
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-6">
                    <form name="foto" action="actualizarFoto" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="usuario" value="admin"/>
                        <img class="borde_logo imagen_perfil_tamano" id="foto" src="<?php echo $foto ?>" alt="foto perfil">
                        <input type="file" id="subir" name="subir"><br>
                        <input type="submit" class="btn btn-primary" name="perfil" value="Actualizar Foto">
                    </form>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <form name="perfil" action="perfilAd" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="domicilio">
                                Domicilio
                                <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio ?>" placeholder="Domicilio" required><br>
                            </label>
                            <label for="password1">
                                Contraseña
                                <input type="password" id="password1" name="pass" value="" placeholder="Contraseña"><br>
                            </label>
                            <label for="telefono">
                                Móvil 1
                                <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono ?>"  maxlength=9><br>
                            </label>
                            <label for="movil">
                                Móvil 2
                                <input type="tel" id="movil" name="movil" value="<?php echo $movil ?>"  maxlength=9><br>
                            </label>
                            <input type="submit" class="btn btn-primary" name="perfil" value="Actualizar Perfil">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection