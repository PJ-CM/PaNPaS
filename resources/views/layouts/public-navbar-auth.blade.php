
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
                            <a class="nav-link js-scroll-trigger @if($_SERVER['PATH_INFO'] == '/users/dashboard') active @endif" href="/users/dashboard" title="Ir a tu página principal">Inicio</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger @if($_SERVER['PATH_INFO'] == '/seguidos') active @endif" href="{{ route('user_seguidos') }}" title="Ir a la sección de Seguidos">
                                Seguidos <span class="badge badge-info text-white" title="Total de seguidos">{{ count(Auth::user()->follows) }}</span>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger @if($_SERVER['PATH_INFO'] == '/seguidores') active @endif" href="{{ route('user_seguidores') }}" title="Ir a la sección de Seguidores">
                                Seguidores <span class="badge badge-info text-white" title="Total de seguidores">{{ count(Auth::user()->followers) }}</span>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger @if($_SERVER['PATH_INFO'] == '/usuarios') active @endif" href="{{ route('user_usuarios') }}" title="Ir a la sección de Usuarios">Usuarios</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger @if($_SERVER['PATH_INFO'] == '/recetas') active @endif" href="{{ route('user_recetas') }}" title="Ir a la sección de Recetas">Recetas</a>
                        </li>
                        {{--
                            Deberá ser un DropdownMenu con las opciones de:
                                >> ir al escritorio/dashboard del usuario
                                >> cerrar sesión
                                >> ¿alguna más?
                        --}}
                        <li class="nav-item p-3 dropdown">
                            <a class="btn btn-primary text-uppercase dropdown-toggle text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Tu Cuenta"><img id="avatar-ico" src="{{ Auth::user()->avatar }}" class="fa fa-user"> {{ Auth::user()->username }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user_perfil', Auth::user()->username) }}" title="Acceder al Perfil">Perfil</a>
                                <a class="dropdown-item" href="{{ route('user_panel_logout') }}" title="Cerrar Sesión">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
