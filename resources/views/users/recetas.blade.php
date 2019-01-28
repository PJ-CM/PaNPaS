@extends('layouts.public')

@section('head_content')
		<meta name="description" content="Explora todas las recetas disponibles en PaNPaS.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{--
            Esta hoja de estilos crea una BARRA de Desplazmiento Extra dentro de
            esta página.
            ¿Es necesaria para algo en especial o se puede eliminar?
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}

		<!-- CSS -->
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
		<!-- Default theme -->
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
		<!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
        {{-- El tema de Bootstrap no es necesario porque ya está incluido en la hoja de estilos principal (css/app.css) --}}
        {{--
		<!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>--}}

		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

		<title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>
@endsection

@section('content')

		@include('layouts.public-navbar-auth')

        {{-- Header --}}
        <header class="masthead" style="
            --bg-url: url(../images/header-recetas.jpg);
            --bg-attach: fixed;
            --bg-size: cover;
            --bg-x: center;
            --bg-y: center;
        ">
            <div>
                <h2>{{ config('app.name', 'PaNPaS') }}</h2>
                <span>Visualiza todas las recetas disponibles</span>
                <span>Ingresa tus recetas. Vota las de otros usuarios</span>
            </div>
        </header>

		{{-- Panel-de-Recetas --}}
		<section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1>Lista de Recetas
                            		<form action="/buscarReceta" method="post" class="right">
										<input type="text" name="buscador" class="btn btn-dark" placeholder="buscador...">
										<input type="submit" name="buscadorSubmit" class="btn btn-dark">
                                    </form>
                                    <a href="/insertarReceta" class="btn btn-primary" data-toggle="modal" data-target="#modalInsertar">Nueva Receta</a>
                                </h1>
                            </div>

                            <div class="card-body">
                            	{{-- Recetas Grid --}}
                                <section class="bg-light" id="ranking">
                                    <div class="container">
                                    @if (isset($busqueda))
                                        <h1>Resultado de la búsqueda... "{{ $busqueda }}"</h1>
                                    @endif

                                        <div class="row">

                                            @foreach($recetas as $receta)

                                                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 ranking-item">
                                                    <a class="ranking-link" data-toggle="modal" href="/receta/{{$receta->titulo}}">
                                                        <div class="ranking-hover" title="Preparar {{ $receta->titulo }}">
                                                            <div class="ranking-hover-content">
                                                                <i class="fas fa-plus fa-3x"></i>
                                                            </div>
                                                        </div>
                                                        <img class="img-fluid" src="{{ $receta->imagen }}" title="{{ $receta->titulo }}">
                                                    </a>
                                                    <div class="ranking-caption">
                                                        <h4 title="{{ $receta->titulo }}">{{ $receta->titulo }}</h4>
                                                        <p class="text-muted">por <a href="/{{$receta->user->username}}" title="Ver perfil de {{$receta->user->username}}" class="link-marco">{{$receta->user->username}}</a></p>

                                                        <h5 class="stars-votos" title="{{$receta->titulo}} tiene {{$receta->votos}} votos">
                                                            @if (Auth::user()->username != $receta->user->username)
                                                                {{-- Si el usuario no coincide con el de la receta --}}

                                                                @if(Auth::user()->favoritos->contains('id', $receta->id)) {{-- si ya la tiene en favoritos --}}
                                                                    <a href="unfav/{{$receta->id}}"><i class="fas fa fa-star fa-lg" title="Votar" style="color: red;"></i> </a>
                                                                @else {{-- si no la tiene en favoritos --}}
                                                                    <a href="fav/{{$receta->id}}"><i class="fas fa-star fa-lg" title="Votar"></i> </a>
                                                                @endif

                                                            @else
                                                                    <i class="fas fa-star fa-lg" title="No puedes votar una receta tuya"></i>
                                                            @endif
                                                            {{$receta->votos}}
                                                        </h5>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
        {{-- MODAL INSERTAR-RECETA :: ini --}}
        <div class="modal fade" id="modalInsertar" role="dialog">
            <div class="modal-dialog">

                {{-- Modal content :: ini --}}
                <div class="modal-content col-sm-12">
                    <div class="modal-header">
                        <h4 class="modal-title">Insertar Receta</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form action="/insertarReceta" method="post" enctype="multipart/form-data">
                            <p class="col-lg-12">
                                <label><strong>Título</strong></label>
                                <input type="text" name="titulo" class="col-lg-12 w3-input" required>
                            </p>
                            <p class="col-lg-12">
                                <label><strong>Descripción</strong></label>
                                <textarea name="descripcion" class="col-lg-12 w3-input" required></textarea>
                            </p>
                            <p class="col-lg-12">
                                <label><strong>Imagen</strong></label>
                                <input type="text" name="imagen" class="col-lg-12 w3-input" value="https://lorempixel.com/640/480/?14725" required>
                            </p>
                            <p class="col-lg-12">
                                <label><strong>Ingredientes</strong></label>
                                <textarea name="ingredientes" class="col-lg-12 w3-input" required></textarea>
                            </p>
                            <p class="col-lg-12">
                                <label><strong>Elaboración</strong></label>
                                <textarea name="elaboracion" class="col-lg-12 w3-input" required></textarea>
                            </p>

                            <input type="submit" name="sub_avatar", value="Actualizar" class="btn btn-primary right">
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                {{-- Modal content :: fin --}}

            </div>
        </div>
        {{-- MODAL INSERTAR-RECETA :: fin --}}

		{{-- jQuery, Bootstrap, jQuery Easing --}}
		<script src="{{ asset('js/app.js') }}"></script>

		{{-- Otros --}}
        <script src="{{ asset('js/agency.js') }}"></script>

		{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		 Librería de Notificaciones de alerta - JS :: ini --}}
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
					@if (isset($toast) != null)
						alertify.set('notifier','position', 'top-right');
						alertify.notify('Receta Insertada', 'success');
					@endif
				});
		</script>
		{{-- Librería de Notificaciones de alerta - JS :: fin --}}
@endsection
