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
            <nav class="nav">
                <a class="nav-link float-left" href="#">
                    <img id="logotipo" src="{{asset ('imagenes/logo.png')}}" alt="logotipo">
                </a>
                <a class="nav-link float-left" href="#">Nombre de la aplicacion</a>

            </nav>
        </header>
        <main>
            @yield('contenido')
        </main>
        <footer class="footer bg-dark container-fluid">  
            <nav class="nav row">
                <a class="col nav-link float-left text-center" id="logoInstituto" href="http://www.cifpvirgendegracia.com/">
                    <img id="logoInstituto" src="{{asset ('images/logoInstituto.png')}}" alt="logotipo instituto">
                </a>
                <p class="col nav-link float-left text-center">
                    2 DAW 2019 - 2020
                    </br>
                    Marina Estefanía Flores Fernández
                    </br>
                    Pedro Javier Espinosa Duque
                    </br>
                    Manuel Ruiz González
                </p>
            </nav>
        </footer>
    </body>
</html>