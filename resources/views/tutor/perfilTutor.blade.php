@extends('maestra.maestraTutor')

@section('titulo') 
Perfil
@endsection

@section('contenido') 
<h1 class="text-center">Perfil Usuario</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8 container">     
            <div class="row">
                <form name="perfil" action="perfilT" method="POST">
                    {{ csrf_field() }}
                    <div class="col-sm-4 col-md-4 col-lg-4 float-left">
                        <img class="borde_logo" id="foto" src="{{asset ('images/defecto.jpeg')}}" alt="foto perfil">
                        <input type="file" id="subir" name="subir"><br>
                        <input type="submit" class="btn btn-primary" name="perfil" value="Actualizar Foto">
                    </div>
                    <div class="form-group">
                        <?php
                        $usuario = session()->get('usu');
                        $domicilio = null;
                        $password = null;
                        $telefono = null;
                        $movil = null;
                        $iban = null;

                        foreach ($usuario as $value) {
                            $domicilio = $value['domicilio'];
                            $password = $value['pass'];
                            $telefono = $value['tel'];
                            $movil = $value['movil'];
                        }
                        ?>
                        <div class="col-sm-4 col-md-4 col-lg-4 float-right">
                            <label>Domicilio</label><input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio ?>" placeholder="Domicilio"><br>
                            <label>Contraseña</label><input type="text" id="password" name="pass" value="<?php echo $password ?>" placeholder="Contraseña"><br>
                            <label>Teléfono</label><input type="number" id="telefono" name="telefono" value="<?php echo $telefono ?>" placeholder="Telefono"><br>
                            <label>Móvil</label><input type="number" id="movil" name="movil" value="<?php echo $movil ?>" placeholder="Movil"><br>
                            <label>IBAN</label><input type="text" id="iban" name="iban" value="<?php echo $iban ?>" placeholder="IBAN"><br>

                            <input type="submit" class="btn btn-primary" name="perfil" value="Actualizar Perfil">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection