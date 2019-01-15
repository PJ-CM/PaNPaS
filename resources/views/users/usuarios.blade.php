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
                	@foreach($users as $user)
                    	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
	                        <a class="ranking-link" data-toggle="modal" href="#rankingModal1">
	                            <div class="ranking-hover" title="Seguir a {{$user->username}}">
	                                <div class="ranking-hover-content">
	                                    <i class="fas fa-plus fa-3x"></i>
	                                </div>
	                            </div>
	                            <img class="img-fluid" src="{{$user->avatar}}" alt="Bollos Suizos">
	                        </a>
	                        <div class="ranking-caption">
	                            <h4 title="{{$user->username}}">{{$user->username}}</h4>

	                            <h5 class="stars-votos" style="">
	                                <i class="fas fa-lg fas fa-sign-out-alt" title="{{$user->username}} está siguiendo a  {{count ($user->follows)}} usuarios"></i > {{ count($user->follows) }}  
	                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	                                <i class="fas fa-lg fas fa-sign-in-alt" title="{{$user->username}} tiene {{count($user->followers)}} seguidores"></i > {{ count($user->followers) }}
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
