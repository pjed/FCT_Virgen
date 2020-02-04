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
        <script src="{{asset ('js/js_crearGastoComida.js')}}"></script>
        <script src="{{asset ('js/js_crearGastoTransporte.js')}}"></script>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Course CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_general.css')}}" media="screen" />        
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_gestionar.css')}}" media="screen" />
        <script src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset ('js/crearGastoTransporte.js')}}"></script>
        <script src="{{asset ('js/crearGastoComida.js')}}"></script>
    </head>

    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <header class="fixed-top">  
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <a class="navbar-nav" href="#">
                    <img id="logotipo" src="{{asset ('images/logo.png')}}" alt="logotipo">
                </a>
                <a class="navbar-nav" href="#">Nombre de la aplicacion</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="bienvenidaAl">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear Gasto</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="crearGastoComida">Comida</a>
                                <a class="dropdown-item" href="crearGastoTransporte">Transporte</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Gestionar Gastos</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="gestionarGastosComida">Comida</a>
                                <a class="dropdown-item" href="gestionarGastosTransporte">Transporte</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <form name="perfil" action="perfilAl"  method="post">
                                {{ csrf_field() }}  
                                <div class="form-group">
                                    <button type="submit" id="perfil" name="perfil" value=""></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <form name="cerrarSesion" action="cerrarSesion"  method="post">
                    {{ csrf_field() }}  
                    <div class="form-group">
                        <button type="submit" id="cerrarSesion" name="cerrarSesion" value=""></button>
                    </div>
                </form>
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
