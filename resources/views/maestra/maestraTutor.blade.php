<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Course CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_general.css')}}" media="screen" />
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
                    <header class="nav">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <img src="" alt="logotipo">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="">Logo</a>
                            </li>
                            <!--                            <li class="nav-item">
                                                            <a class="nav-link active" href="">Cambiar de rol</a>
                                                        </li>-->
                            <li class="nav-item justify-content-end">
                                <form name="perfil" action="perfil"  method="post">
                                    {{ csrf_field() }}  
                                    <div class="form-group">
                                        <button type="submit" id="perfil" name="perfil" value=""></button>
                                    </div>
                                </form>
                            </li>
                            <li class="nav-item justify-content-end">
                                <form name="cerrarSesion" action="cerrarSesion"  method="post">
                                    {{ csrf_field() }}  
                                    <div class="form-group">
                                        <button type="submit" id="cerrarSesion" name="cerrarSesion" value=""></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </header>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <nav  class="nav">
                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link active" href="">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">Documentos</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Modificar</a>
                                    <a class="dropdown-item" href="">Extraer</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">Consultar Gastos</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Alumno</a>
                                    <a class="dropdown-item" href="">Curso</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">Importar Alumnos</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            @yield('contenido')
            <div class="row">
                <div class="col">
                    <footer class="nav">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <img src="" alt="logotipo instituto">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    2 DAW 2019 - 2020
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Marina Estefania Flores Fernandez
                                    Pedro Javier Espinosa
                                    Manuel Ruis Gonzalez
                                </a>
                            </li>
                        </ul>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>