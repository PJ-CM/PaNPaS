
        {{-- Navigation --}}
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top" title="{{ config('app.name', 'PaNPaS') }} logo - inicio de la aplicación">{{ config('app.name', 'PaNPaS') }}</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger" href="#services" title="Ir a la sección de Servicios">Servicios</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger" href="#ranking" title="Ir a la sección de Ranking">Ranking</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger" href="#clients" title="Ir a la sección de Clientes">Clientes</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link js-scroll-trigger" href="#contact" title="Ir a la sección de Contacto">Contacto</a>
                        </li>
                        {{--<li class="nav-item-login-registro p-2">
                            <a class="nav-link js-scroll-trigger" href="#about" title="Iniciar sesión">Login</a>
                        </li>
                        <li class="nav-item-login-registro p-2">
                            <a class="nav-link js-scroll-trigger" href="#about" title="Crear cuenta de usuario">Registro</a>
                        </li>--}}
                        <li class="nav-item p-3">
                            <a class="btn btn-primary text-uppercase js-scroll-trigger" href="#" data-target="#loginModal" data-toggle="modal" title="Iniciar sesión"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="btn btn-primary text-uppercase js-scroll-trigger" href="#" data-target="#registerModal" data-toggle="modal" title="Crear cuenta de usuario"><i class="fa fa-user-plus"></i> Registro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
