@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>

        <style type="text/css">
            .img{
                max-width:640px;
                max-height:480px;
                width: 350px;
                height: 350px;
            }
        </style>
@endsection

@section('content')

        @include('layouts.public-navbar-auth')

        {{-- Panel-de-Usuario --}}
        <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h1>{{$user->username}} @if (Auth::user()->follows->contains('username', $user->username))<a class="btn btn-primary right" href="/unfollow/{{$user->id}}">Dejar de Seguir</a> @else <a class="btn btn-primary right" href="/follow/{{$user->id}}">Seguir</a> @endif </h1></div>

                            <div class="card-body" style="float: left;">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                               <img src="{{$user->avatar}}" id="avatar" class="img">
                               <h1>{{$user->nombre}} {{$user->apellido}}</h1>

                               <!-- Recetas del Usuario Seleccionado -->
                               <br>
                                <h2 class="section-heading text-uppercase center">Recetas</h2>
    								{{-- Ranking Grid --}}
								        <section class="bg-light" id="ranking">
								            <div class="container">
								                <div class="row">
								                	@foreach($user->recetas as $receta)
								                    	<div class="col-md-4 col-sm-6 ranking-item">
									                        <a class="ranking-link" data-toggle="modal" href="/receta/{{$receta->titulo}}">
									                            <div class="ranking-hover">
									                                <div class="ranking-hover-content">
									                                    <i class="fas fa-plus fa-3x"></i>
									                                </div>
									                            </div>
									                            <img class="img-fluid" src="{{$receta->imagen}}" alt="Bollos Suizos">
									                        </a>
									                        <div class="ranking-caption">
									                            <h4>{{$receta->titulo}}</h4>
									                            
									                            <h5 class="stars-votos">
									                                <i class="fas fa-star fa-lg star-gold" title="Estrella de Oro"></i> {{$receta->votos}}
									                            </h5>
									                        </div>
								                    	</div>
								                    @endforeach
								        </section>
                               	<!-- FIN Refetas del Usuario Seleccionado -->

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
        {{-- jQuery, Bootstrap, jQuery Easing --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Otros --}}
        <script src="js/agency.js"></script>
@endsection
