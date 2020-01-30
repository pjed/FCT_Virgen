<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <script src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Course CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_general.css')}}" media="screen" />
    </head>

    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <header class="fixed-top bg-dark">  
            <ul class="list-group  list-group-flush">
                <div class="row">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <li class="bg-dark list-group-item">
                            <a href="#">
                                <img id="logotipo" src="{{asset ('imagenes/logo.png')}}" alt="logotipo">
                            </a>
                        </li>
                    </div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <li class="bg-dark list-group-item">
                            <a href="#">Nombre de la aplicacion</a>
                        </li>
                    </div>
                </div>
            </ul>
        </header>
        <main>
            @yield('contenido')
        </main>
        <footer>   
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-sm-1 col-md-2 col-lg-2">
                        <li class="footer list-group-item">
                            <a class="nav-link" href="http://www.cifpvirgendegracia.com/">
                                <img id="logoInstituto" src="{{asset ('images/logoInstituto.png')}}" alt="logotipo instituto">
                            </a>
                        </li>
                    </div>
                    <div class="col-sm-1 col-md-7 col-lg-7">
                        <li class="footer list-group-item">
                            <p class="text-center">
                                2 DAW 2019 - 2020
                            </p>
                        </li>
                    </div>
                    <div class="col-sm-1 col-md-3 col-lg-3">
                        <li class="footer list-group-item">
                            <p class="text-center">
                                Marina Estefanía Flores Fernández
                                <br>
                                Pedro Javier Espinosa Duque
                                <br>
                                Manuel Ruiz González
                            </p>
                        </li>
                    </div>
                </div>
            </ul>
        </footer>
    </body>
</html>