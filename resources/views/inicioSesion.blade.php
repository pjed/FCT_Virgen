<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Course CSS -->
        <link rel="stylesheet" type="text/css" href="css/css_index.css" media="screen" />
        <script src="jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <div class="container">
            <div class="row">
                <div class="col">
                    <header>
                        <h1>Iniciar Sesión</h1>
                    </header>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <main>                      
                        <form name="inicioSesion" action="inicioSesion" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Usuario:</label>
                                <input type="email"class="form-control form-control-sm form-control-md form-control-lg" id="usuario" name="usuario" placeholder="usuario@x.x" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca un correo"><br>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Contraseña:</label>
                                <input type="password" class="form-control form-control-sm form-control-md form-control-lg" id="pwd" name="pwd" placeholder="Contraseña" data-toggle="tooltip" data-placement="left" data-html="true" title="Introduca una contraseña"><br>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="aceptar" name="aceptarIndex" value="Aceptar">
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>     
    </body>
</html>
