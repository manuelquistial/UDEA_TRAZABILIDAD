<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Lang::get('strings.menu_superior.titulo') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Js -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/580972a967.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo_udea.svg') }}" width="200" height="50" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <h6 class="col titulo-h">{{ Lang::get('strings.menu_superior.titulo') }}</h6>
                </ul>
                @auth
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('presolicitud') }}">{{ Lang::get('strings.menu_superior.presolicitud') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('consulta_usuario') }}">{{ Lang::get('strings.menu_superior.transaccion') }}</a>
                </li>
                @if(Auth::user()->hasEtapa(3))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('correos') }}">{{ Lang::get('strings.menu_superior.correos') }}</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="far fa-bell"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('edit_usuario') }}">{{ Lang::get('strings.menu_superior.opciones.perfil') }}</a>
                        @if(Auth::user()->hasRole("Administrador")) 
                        <a class="dropdown-item" href="{{ route('usuarios') }}">{{ Lang::get('strings.menu_superior.opciones.configuracion') }}</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">{{ Lang::get('strings.menu_superior.opciones.cerrar_sesion') }}</a>
                    </div>
                </li>
                @endauth
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center" id="content">
                @yield('etapasView')
                @yield('configuracionView')
                @yield('tipoTransaccionView')
                @yield('general')
            </div>
            <footer class="my-4 pt-2 text-muted text-center text-small border-top">
                <p class="mb-1">© 2017-2018 Company Name</p>
                <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
                </ul>
            </footer>
        </div>
        @yield('modal')
        @yield('scripts')
    </body>
</html>