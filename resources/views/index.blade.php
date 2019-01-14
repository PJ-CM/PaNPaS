@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tu panadería con facilidad. Conserva y comparte tus recetas.">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PaNPaS') }}</title>
@endsection

@section('content')

        @include('layouts.public-navbar-ini')

        {{-- Header --}}
        <header class="masthead" style="
            --bg-url: url(../images/header-home.jpg);
            --bg-attach: fixed;
            --bg-size: cover;
            --bg-x: center;
            --bg-y: center;
        ">
            <div>
                <h2>{{ config('app.name', 'PaNPaS') }}</h2>
                <span>Gestiona tu panadería con facilidad</span>
                <span>Conserva y comparte tus recetas</span>
            </div>
        </header>

        {{-- Servicios --}}
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Servicios</h2>
                        <h3 class="section-subheading text-muted">Descubre qué podemos ofrecerte</h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x" title="Icono de galleta">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-cookie fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Gestiona tu Panadería</h4>
                        <p class="text-muted">Facilita la gestión de tu negocio.<br>Organiza bien tu almacén.</p>
                    </div>
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x" title="Icono de libro abierto">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-book-open fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Comparte Recetas</h4>
                        <p class="text-muted">Crea recetas para compartirlas con otros.<br>Guardarlas, sino, en tu recitario privado.</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x" title="Icono de estrella">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-star fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Vota</h4>
                        <p class="text-muted">Valora las recetas de otros usuarios.<br>Las 3 más votadas tendrán un premio.</p>
                    </div>
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x" title="Icono de dedos en v">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fab fa-angellist fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Ranking</h4>
                        <p class="text-muted">Con las Votaciones habrá un ranking<br>¿Conseguirás llegar al primer puesto?</p>
                    </div>
                </div>
            </div>
        </section>
 {{-- Ranking Grid --}}
        <section class="bg-light" id="ranking">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Ranking</h2>
                        <h3 class="section-subheading text-muted">Visualiza las recetas más destacadas</h3>
                    </div>
                </div>
                <div class="row">

                    @foreach($recetas as $receta)

                    {{-- Modal X --}}
                            <div class="ranking-modal modal fade" id="rankingModal1" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="close-modal" data-dismiss="modal">
                                            <div class="lr">
                                                <div class="rl"></div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-8 mx-auto">
                                                    <div class="modal-body">
                                                        <!-- Project Details Go Here -->
                                                        <h2 class="text-uppercase">Bollos Suizos</h2>
                                                        <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario3</a></p>
                                                        <img class="img-fluid d-block mx-auto" src="images/recetas/bollos-suizos.jpg" alt="Bollos Suizos">
                                                        <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                                        <table class="mx-auto mb-5">
                                                            <tr>
                                                                <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                                                <td style="width: 50%;" class="text-left px-2">Enero 2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right px-2">Categoría:</td>
                                                                <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Pastelería</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right px-2">Votos:</td>
                                                                <td class="text-left px-2">5</td>
                                                            </tr>
                                                        </table>

                                                        <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                                            <i class="fas fa-times" title="Icono de Cerrar"></i>
                                                            Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    {{-- Parte del Ranking --}}
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal1">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{$receta->imagen}}" alt="Bollos Suizos">
                        </a>
                        <div class="ranking-caption">
                            <h4>{{$receta->titulo}}</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">{{$receta->user->username}}</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-gold" title="Estrella de Oro"></i> {{$receta->votos}}
                            </h5>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </section>

@php /*

        {{-- Ranking Grid --}} <!-- RANKING ORIGINAL -->
        <section class="bg-light" id="ranking">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Ranking</h2>
                        <h3 class="section-subheading text-muted">Visualiza las recetas más destacadas</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal1">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/bollos-suizos.jpg" alt="Bollos Suizos">
                        </a>
                        <div class="ranking-caption">
                            <h4>Bollos Suizos</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario3</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-gold" title="Estrella de Oro"></i> 5
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal2">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/magdalenas.jpg" alt="Magdalenas">
                        </a>
                        <div class="ranking-caption">
                            <h4>Magdalenas</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario1</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-silver" title="Estrella de Plata"></i> 3
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal3">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/pan.jpg" alt="Pan">
                        </a>
                        <div class="ranking-caption">
                            <h4>Pan</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario3</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-silver" title="Estrella de Plata"></i> 3
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal4">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/pan-de-semillas.jpg" alt="Pan de semillas">
                        </a>
                        <div class="ranking-caption">
                            <h4>Pan de semillas</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario1</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-bronze" title="Estrella de Bronce"></i> 1
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal5">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/panecillos.jpg" alt="Panecillos">
                        </a>
                        <div class="ranking-caption">
                            <h4>Panecillos</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario2</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-bronze" title="Estrella de Bronce"></i> 1
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 ranking-item">
                        <a class="ranking-link" data-toggle="modal" href="#rankingModal6">
                            <div class="ranking-hover">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="images/recetas/pastas.jpg" alt="Pastas">
                        </a>
                        <div class="ranking-caption">
                            <h4>Pastas</h4>
                            <p class="text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario2</a></p>
                            <h5 class="stars-votos">
                                <i class="fas fa-star fa-lg star-bronze" title="Estrella de Bronce"></i> 1
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        */
    @endphp


        {{-- Clientes --}}
        <section id="clients">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Nuestros Clientes</h2>
                        <h3 class="section-subheading text-muted">Empresas que mejoraron su gestión gracias al manejo de nuestra App</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/ogitxerri.png" alt="Ogi Txerri - logo">
                            </a>
                            <h4>Ogi Txerri</h4>
                            <p class="text-muted">Tu pan marrano</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="Ogi Txerri - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="Ogi Txerri - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="Ogi Txerri - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/bigopan.png" alt="Bigopan - logo">
                            </a>
                            <h4>Bigopan</h4>
                            <p class="text-muted">Un pan con bigotes</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="Bigopan - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="Bigopan - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="Bigopan - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/peterpan.png" alt="PeterPan - logo">
                            </a>
                            <h4>PeterPan</h4>
                            <p class="text-muted">Panes de Cuento</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="PeterPan - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="PeterPan - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="PeterPan - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/ruso.png" alt="Ruso - logo">
                            </a>
                            <h4>Ruso</h4>
                            <p class="text-muted">Directamente de Siberia</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="Ruso - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="Ruso - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="Ruso - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/pompan.png" alt="PomPan - logo">
                            </a>
                            <h4>PomPan</h4>
                            <p class="text-muted">Pón pan con lo que quieras</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="PomPan - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="PomPan - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="PomPan - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="client">
                            <a href="#" title="Acceder a su perfil">
                                <img class="mx-auto rounded-circle" src="images/clientes/troyano.png" alt="Troyano - logo">
                            </a>
                            <h4>Troyano</h4>
                            <p class="text-muted">A caballo y con sorpresa</p>
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Twitter">
                                        <i class="fab fa-twitter" title="Troyano - Twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Facebook">
                                        <i class="fab fa-facebook-f" title="Troyano - Facebook"></i>
                                    </a>
                                </li>
                                    <li class="list-inline-item">
                                    <a href="#" target="_blank" title="Visitar su Linkedin">
                                        <i class="fab fa-linkedin-in" title="Troyano - Linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contacto --}}
        <section id="contact">
            <form method="post" action="/enviarDatosContacto">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading text-uppercase">¿Te interesa?</h2>
                            <h3 class="section-subheading text-white">Contacta con nosotros para resolver todas tus dudas</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="contactForm" name="sentMessage" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Tu Nombre *" required="required" data-validation-required-message="Por favor, teclea tu nombre.">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Tu Email *" required="required" data-validation-required-message="Por favor, teclea tu correo electrónico." data-validation-validemail-message="No es un EMAIL válido">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" placeholder="Tu Mensaje *" required="required" data-validation-required-message="Por favor, teclea tu mensaje."></textarea>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12 text-center">
                                        <div id="success"></div>
                                        <!--<button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" title="Enviar formulario de consulta" type="submit">Enviar</button>-->
                                        <input type="submit" name="submit" class="btn btn-primary btn-xl text-uppercase">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </section>
@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
        {{-- Ranking Modals --}}

        {{-- Modal 1 --}}
        <div class="ranking-modal modal fade" id="rankingModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Bollos Suizos</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario3</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/bollos-suizos.jpg" alt="Bollos Suizos">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Enero 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Pastelería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">5</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal 2 --}}
        <div class="ranking-modal modal fade" id="rankingModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Magdalenas</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario1</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/magdalenas.jpg" alt="Magdalenas">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Febrero 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Pastelería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">3</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal 3 --}}
        <div class="ranking-modal modal fade" id="rankingModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Pan</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario3</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/pan.jpg" alt="Pan">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Marzo 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Panadería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">3</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal 4 --}}
        <div class="ranking-modal modal fade" id="rankingModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Pan de semillas</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario1</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/pan-de-semillas.jpg" alt="Pan de semillas">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Abril 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Panadería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">1</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal 5 --}}
        <div class="ranking-modal modal fade" id="rankingModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Panecillos</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario2</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/panecillos.jpg" alt="Panecillos">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Mayo 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Panadería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">1</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal 6 --}}
        <div class="ranking-modal modal fade" id="rankingModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2 class="text-uppercase">Pastas</h2>
                                    <p class="item-intro text-muted">por <a href="#" title="Ver perfil de este usuario o listado de recetas" class="link-marco">usuario2</a></p>
                                    <img class="img-fluid d-block mx-auto" src="images/recetas/pastas.jpg" alt="Pastas">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                    <table class="mx-auto mb-5">
                                        <tr>
                                            <td style="width: 50%;" class="text-right px-2">Fecha de Creación:</td>
                                            <td style="width: 50%;" class="text-left px-2">Junio 2017</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Categoría:</td>
                                            <td class="text-left px-2"><a href="#" title="Ver otras recetas de esta categoría" class="link-marco">Pastelería</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right px-2">Votos:</td>
                                            <td class="text-left px-2">1</td>
                                        </tr>
                                    </table>

                                    <button class="btn btn-primary" data-dismiss="modal" type="button" title="Cerrar ventana">
                                        <i class="fas fa-times" title="Icono de Cerrar"></i>
                                        Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Login / Registro Modals --}}
        @include('auth.modals.login_modal')
        @include('auth.modals.register_modal')

        {{-- jQuery, Bootstrap, jQuery Easing --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Otros --}}
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>
        <script src="js/agency.js"></script>

        {{-- Mostrando Modal Login/Registro si hubiera errores --}}
        @if (count($errors) > 0)
            {{-- $errors --}}
        <script type="text/javascript">
            $("#{{ old('modal') }}").modal('show');
        </script>
        @endif
@endsection
