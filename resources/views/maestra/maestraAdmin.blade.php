<?php
$rol1 = session()->get('rol');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf_token" content="{{ csrf_token() }}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet"> 

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

        <!-- Course CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_general.css')}}" media="screen" />       
        <link rel="stylesheet" type="text/css" href="{{asset ('css/bootstrap.min.css')}}" media="screen" />  
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_gestionar.css')}}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{asset ('css/css_menuVertical.css')}}" media="screen" />
        @yield('css')

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

        <!-- Javascript -->
        <script src="{{asset ('js/jquery-3.2.1.slim.min.js')}}"></script>
        <script src="{{asset ('js/popper.min.js')}}"></script>
        <script src="{{asset ('js/bootstrap.min.js')}}"></script>
        <script src="{{asset ('js/jquery-3.3.1.min.js')}}"></script>
        @yield('javascript')
    </head>
    <body>
        <div class="wrapper">
            <nav id="sidebar" class="bg-dark">
                <ul class="list-unstyled components">
                    <li>
                        <a href="#">
                            <img class="logotipo" src="{{asset ('images/logo.svg')}}" alt="logotipo">
                        </a>
                    </li>
                    <li>
                        <a  href="bienvenidaAd">Home</a>
                    </li>
                    <li>
                        <a href="#GestionarBBDD" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gestionar BBDD</a>
                        <ul class="collapse list-unstyled" id="GestionarBBDD">
                            <li><a href="consultarGastosAnteriores">Gastos Anteriores</a></li>
                            <li><a href="importarDatos">Importar Datos</a></li>
                        </ul>   
                    </li>
                    <li>
                        <a href="extraerDocA">Generar Documentos</a> 
                    </li>
                    <li>
                        <a href="gestionarCursos">Gestionar Cursos</a>
                    </li>
                    <li>
                        <a href="consultarGastos">Consultar Gastos</a>  
                    </li>
                    <li>
                        <a href="#GestionarUsuarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gestionar Usuarios</a>
                        <ul class="collapse list-unstyled" id="GestionarUsuarios">
                            <li><a href="gestionarTutores">Tutores</a> </li>
                            <li><a href="gestionarAlumnos">Alumnos</a> </li>
                            <li><a href="gestionarUsuarios">Usuarios</a> </li>
                        </ul>
                    </li> 
                    @if ($rol1==4)
                    <li>
                        <a href="#CambiarRol" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cambiar de rol</a>
                        <form name="cambiarRol" action="cambiarRol" method="POST">
                            {{ csrf_field() }}
                            <ul class="collapse list-unstyled" id="CambiarRol">
                                <li><input type="submit" name="tutor" value="Tutor"></li>
                                <li><input type="submit" name="administrador" value="Administrador"></li>
                            </ul>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
            <div  id="content">
                <!-- Page Content Holder --> 
                <header>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button class="navbar-toggler navbar-btn" type="button" id="sidebarCollapse" data-toggle="collapse" >
                                    <span class="navbar-toggler-icon"></span>  
                                </button>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <form name="perfil" action="perfilAd1"  method="post">
                                        {{ csrf_field() }}  
                                        <?php
                                        $usuario = session()->get('usu');

                                        foreach ($usuario as $value) {
                                            $foto = $value['foto'];
                                        }
                                        ?>

                                        <button type="submit" class="perfil" name="perfil">
                                            <img alt="perfil" class="miniatura_perfil" src="<?php echo $foto ?>"/>
                                        </button>
                                    </form>
                                </li>
                                <li>  
                                    <form name="cerrarSesion" action="cerrarSesion"  method="post">
                                        {{ csrf_field() }}  
                                        <button type="submit" class="cerrarSesion" name="cerrarSesion" value=""></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <main>
                    @yield('contenido')
                </main>
                <footer class="footer bg-dark container">  
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
                            <div class="row h-100 justify-content-center align-items-center">
                                <p class="text-center">
                                    Marina Estefanía Flores Fernández
                                    <br>Pedro Javier Espinosa Duque<br>
                                    Manuel Ruiz González
                                </p>
                            </div>
                        </div>
                        <div class="col-1 container">
                            <div class="row h-100 justify-content-center align-items-center">
                                <p class="text-center">2 - DAW <br>2019 - 2020</p>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="row h-100 justify-content-center align-items-center">
                                <button type="button" class="btn" id="info"  data-toggle="modal" data-target="#exampleModal">
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
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
            </div>
        </div>
        <!-- jQuery CDN -->
  <!--<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>-->
        <!-- Bootstrap Js CDN -->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <script type="text/javascript">
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
        </script>
    </body>
</html>