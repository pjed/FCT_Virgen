@extends('maestra.maestraAlumno')

@section('titulo') 
Perfil
@endsection

@section('contenido') 

<?php
$usuario = session()->get('usu');
$domicilio = null;
$telefono = null;
$movil = null;
$iban = null;
$foto = null;

foreach ($usuario as $value) {
    $domicilio = $value['domicilio'];
    $telefono = $value['tel'];
    $movil = $value['movil'];
    $iban = $value['iban'];
    $foto = $value['foto'];
    $email = $value['email'];
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
                        <input type="hidden" name="usuario" value="alumno"/>
                        <img class="borde_logo imagen_perfil_tamano" id="foto" src="<?php echo $foto ?>" alt="foto perfil">
                        <input type="file" id="subir" name="subir"><br>
                        <input type="submit" class="btn btn-primary" name="perfil" value="Actualizar Foto">
                    </form>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <form name="perfil" action="perfilAl" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="domicilio">
                                Correo
                                <input type="text" id="correo" disabled name="correo" value="<?php echo $email ?>"><br>
                            </label>
                            <label for="domicilio">
                                Domicilio
                                <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio ?>" placeholder="Domicilio" required><br>
                            </label>
                            <label for="password1">
                                Contraseña
                                <input type="password" id="password1" name="pass" value="" placeholder="Contraseña"><br>
                            </label>
                            <label for="telefono">
                                Teléfono
                                <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono ?>" placeholder="Telefono" required pattern="[9]{1}[0-9]{8}"><br>
                            </label>
                            <label for="movil">
                                Móvil
                                <input type="tel" id="movil" name="movil" value="<?php echo $movil ?>" placeholder="Movil" required pattern="[6-7]{1}[0-9]{8}"><br>
                            </label>
                            <label for="iban">
                                IBAN
                                <input type="text" id="iban" name="iban" value="<?php echo $iban ?>" placeholder="IBAN" required pattern="^ES\d{22}$"><br>
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