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
        <script src="{{asset ('js/js_inicioSesion.js')}}"></script>

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
        <header class="bg-dark">  
            <nav class="nav">
                <div class="col-3">
                    <a class="nav-link text-center" href="#">
                        <img class="borde_logo" id="logotipo" src="{{asset ('images/logo.svg')}}" alt="logotipo">
                    </a>
                </div>
                <div class="container col-9">
                    <div class="row h-100 justify-content-center align-items-center">
                        <p class="titulo_app">CIFP - Virgen de Gracia - Gestión FCT</p>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            @yield('contenido')
        </main>
        <footer class="footer bg-dark container-fluid">  
            <nav class="nav">
                <div class="col-3 container text-center">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" id="logoInstituto" href="https://europa.eu/european-union/index_es">
                            <img class="borde_logo" id="logotipo_dual" src="{{asset ('images/union_europea_logo.png')}}" alt="logotipo union europea">
                        </a>
                    </div>
                </div>
                <div class="col-3 container text-center">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" id="logoInstituto" href="http://http://www.educa.jccm.es/es/fpclm/fp-dual">
                            <img class="borde_logo" id="logotipo_dual" src="{{asset ('images/fpdual.png')}}" alt="logotipo fp dual">
                        </a>
                    </div>
                </div>
                <div class="col-3 container text-center">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" id="logoInstituto" href="http://www.cifpvirgendegracia.com/">
                            <img id="logoInstituto" class="borde_logo" src="{{asset ('images/logoInstituto.png')}}" alt="logotipo instituto">
                        </a>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row content">
                        <div class="text-center">
                            <p>Marina Estefanía Flores Fernández</p>
                            <p>Pedro Javier Espinosa Duque</p>
                            <p>Manuel Ruiz González</p>
                        </div>
                    </div>
                </div>
                <div class="col-1 container text-center">
                    <div class="row h-100 justify-content-center align-items-center">
                            <p>2 - DAW <br>2019 - 2020</p>
                    </div>
                </div>
                </div>
            </nav>
        </footer>
    </body>
</html>