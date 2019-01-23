
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
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/users/dashboard') active @endif" href="/users/dashboard" title="Ir a tu página principal"><h6>Inicio</h6></a>
                        </li>
                        <li class="nav-item p-2" style="text-align: center;">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/seguidos') active @endif" href="/seguidos" title="Ir a la sección de Seguidos"><h6>Seguidos<br><h4>{{count(Auth::user()->follows)}}</h4></h6></a>
                        </li>
                        <li class="nav-item p-2" style="text-align: center;">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/seguidores') active @endif" href="/seguidores" title="Ir a la sección de Seguidores" "><h6>Seguidores<br><h4>{{count(Auth::user()->followers)}}</h4></h6></a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/usuarios') active @endif" href="/usuarios" title="Ir a la sección de Usuarios"><h6>Usuarios</h6></a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger center @if($_SERVER['PATH_INFO'] == '/recetas') active @endif" href="/recetas" title="Ir a la sección de Recetas"><h6>Recetas</h6></a>
                        </li>
                        {{--
                            Deberá ser un DropdownMenu con las opciones de:
                                >> ir al escritorio/dashboard del usuario
                                >> cerrar sesión
                                >> ¿alguna más?
                        --}}
                        <li class="nav-item p-3 dropdown" style="float: right;">
                            <a class="btn btn-primary text-uppercase dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Tu Cuenta"><img src="{{Auth::user()->avatar}}" class="fa fa-user" style="width: 40px; height: 40px;"> {{Auth::user()->username}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('user_perfil', Auth::user()->username)}}">Perfil</a>
                                <a class="dropdown-item" href="{{route('user_panel_logout')}}" title="Cerrar Sesión">   Logout</a>
                            </div>
                            
                        </li>

                         
                    </ul>
                </div>
            </div>
        </nav>
