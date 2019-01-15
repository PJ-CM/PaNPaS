
        {{-- Navigation --}}
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top navbar-shrink" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="{{ route('index') }}" title="{{ config('app.name', 'PaNPaS') }} logo - inicio de la aplicación">{{ config('app.name', 'PaNPaS') }}</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/users/dashboard') active @endif" href="/users/dashboard" title="Ir a tu página principal">Inicio</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/seguidos') active @endif" href="/seguidos" title="Ir a la sección de Seguidos">Seguidos<br>{{count(Auth::user()->follows)}}</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/seguidores') active @endif" href="/seguidores" title="Ir a la sección de Seguidores" ">Seguidores<br>{{count(Auth::user()->followers)}}</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/usuarios') active @endif" href="/usuarios" title="Ir a la sección de Usuarios">Usuarios</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/recetas') active @endif" href="/recetas" title="Ir a la sección de Recetas">Recetas</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/contacto') active @endif" href="#contacto" title="Ir a la sección de Contacto">Contacto</a>
                        </li>
                        {{--
                            Deberá ser un DropdownMenu con las opciones de:
                                >> ir al escritorio/dashboard del usuario
                                >> cerrar sesión
                                >> ¿alguna más?
                        --}}
                        <li class="nav-item p-3 dropdown">
                            <a class="btn btn-primary text-uppercase dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Tu Cuenta"><img src="{{Auth::user()->avatar}}" class="fa fa-user" style="width: 40px; height: 40px;"> {{Auth::user()->username}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Perfil</a>
                                <a class="dropdown-item" href="{{route('user_panel_logout')}}" title="Cerrar Sesión">   Logout</a>
                            </div>
                        </li>

                         
                    </ul>
                </div>
            </div>
        </nav>
