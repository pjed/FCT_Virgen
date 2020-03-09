<?php
$rol1 = session()->get('rol');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet"> 

        
        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
        
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_general.css')}}" media="screen" />         
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_gestionar.css')}}" media="screen" />

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

        <!-- Javascript -->
        <script src="{{asset ('js/jquery-3.2.1.slim.min.js')}}"></script>
        <script src="{{asset ('js/popper.min.js')}}"></script>
        <script src="{{asset ('js/bootstrap.min.js')}}"></script>
        <script src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
        @yield('javascript')
    </head>
    <body>
        <header>  
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="text-center col-2">
                    <a class="navbar-nav" href="#">
                        <img class="logotipo" src="{{asset ('images/logo.svg')}}" alt="logotipo">
                    </a>
                </div>

                <div class="col-8">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="bienvenidaT">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ExtraerDocT">Generar documentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="consultarGastosAlumno">Consultar Gastos Alumno</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Gestionar</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="gestionarEmpresa">Empresa</a>
                                    <a class="dropdown-item" href="gestionarResponsable">Responsable</a>
                                    <a class="dropdown-item" href="gestionarPracticas">Practicas</a>
                                </div>
                            </li>
                            @if ($rol1==4)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Cambiar de rol</a>
                                <div class="dropdown-menu">
                                    <form name="cambiarRol" action="cambiarRol" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="submit" class="btn" name="tutor" value="Tutor">
                                            <input type="submit" class="btn" name="administrador" value="Administrador">
                                        </div>
                                    </form>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-1 text-center">
                    <form name="perfil" action="perfilT1"  method="post">
                        {{ csrf_field() }}  
                        <div class="form-group">
                            <?php
                            $usuario = session()->get('usu');

                            foreach ($usuario as $value) {
                                $foto = $value['foto'];
                            }
                            ?>

                            <button type="submit" id="perfil" name="perfil">
                                <input type="image" alt="perfil" name="submit" class="miniatura_perfil" src="<?php echo $foto ?>"/>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-1 text-center">
                    <form name="cerrarSesion" action="cerrarSesion"  method="post">
                        {{ csrf_field() }}  
                        <div class="form-group">
                            <button type="submit" id="cerrarSesion" name="cerrarSesion" value=""></button>
                        </div>
                    </form>
                </div>
            </nav>
        </header>
        <main>            
            @yield('contenido')
        </main>
        <footer class="footer bg-dark container-fluid">  
            <nav class="nav">
                <div class="col-1 container">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" href="https://europa.eu/european-union/index_es">
                            <img class="borde_logo" src="{{asset ('images/union_europea_logo.png')}}" alt="logotipo union europea">
                        </a>
                    </div>
                </div>
                <div class="col-1 container">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" href="http://http://www.educa.jccm.es/es/fpclm/fp-dual">
                            <img class="borde_logo" src="{{asset ('images/fpdual.png')}}" alt="logotipo fp dual">
                        </a>
                    </div>
                </div>
                <div class="col-1 container">
                    <div class="row h-100 justify-content-center align-items-center">
                        <a class="col nav-link" href="http://www.cifpvirgendegracia.com/">
                            <img class="borde_logo" src="{{asset ('images/logoInstituto.png')}}" alt="logotipo instituto">
                        </a>
                    </div>
                </div>
                <div class="col-5">
                    <p class="text-center">
                        Marina Estefanía Flores Fernández
                        <br>Pedro Javier Espinosa Duque<br>
                        Manuel Ruiz González
                    </p>
                </div>

                <div class="col-1 container">
                    <div class="row h-100 justify-content-center align-items-center">
                        <p class="text-center">2 - DAW <br>2019 - 2020</p>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn" id="info"  data-toggle="modal" data-target="#exampleModal">
                    </button>
                    <!-- Modal -->
                    <div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h2 class="text-center">Derechos de los iconos</h2>
                                    <h3 class="text-center">Añadir:</h3><a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">User:</h3><a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Delete: </h3><a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Confirm:</h3><a href="https://www.flaticon.com/authors/roundicons" title="Roundicons">Roundicons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Search:</h3><a href="https://www.flaticon.com/authors/those-icons" title="Those Icons">Those Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Edit:</h3><a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Logout: </h3><a href="https://www.flaticon.com/authors/those-icons" title="Those Icons">Those Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
                                    <h3 class="text-center">Ticket:</h3><a href="https://www.flaticon.com/authors/those-icons" title="Those Icons">Those Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                                    <h3 class="text-center">Informacion</h3><a href="https://www.flaticon.com/authors/those-icons" title="Those Icons">Those Icons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </nav>
        </footer>
    </body>
</html>