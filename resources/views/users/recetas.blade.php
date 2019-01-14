@extends('layouts.public')

@section('head_content')
		<meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

		<title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>
@endsection

@section('content')

		@include('layouts.public-navbar-auth')

		{{-- Panel-de-Usuario --}}

		{{-- Ranking Grid --}}
        <section class="bg-light" id="ranking">
            <div class="container">
                <div class="row">
                	@foreach($recetas as $receta)
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
	                            <p class="text-muted">por <a href="/{{$receta->user->username}}" title="Ver perfil de este usuario o listado de recetas" class="link-marco">{{$receta->user->username}}</a></p>
	                            <h5 class="stars-votos">
	                                <i class="fas fa-star fa-lg star-gold" title="Estrella de Oro"></i> {{$receta->votos}}
	                            </h5>
	                        </div>
                    	</div>
                    @endforeach
        </section>

@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
		{{-- jQuery, Bootstrap, jQuery Easing --}}
		<script src="{{ asset('js/app.js') }}"></script>

		{{-- Otros --}}
		<script src="js/agency.js"></script>
@endsection
