@extends('layouts.public')

@section('head_content')
		<meta name="description" content="Viendo el listado de nuestros usuarios registrados en PaNPaS.">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

		<title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>
@endsection

@section('content')

		@include('layouts.public-navbar-auth')

        {{-- Header --}}
        <header class="masthead" style="
            --bg-url: url(../images/header-usuarios.jpg);
            --bg-attach: fixed;
            --bg-size: cover;
            --bg-x: center;
            --bg-y: center;
        ">
            <div>
                <h2>{{ config('app.name', 'PaNPaS') }}</h2>
                <span>Conoce a todos nuestros usuarios</span>
                <span>Házte seguidor de tus favoritos</span>
            </div>
        </header>

		{{-- Panel-de-Usuarios --}}
        <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1>Lista de Usuarios
                                    <form action="/buscarUsuario" method="post" class="right">
                                        <input type="text" name="buscador" class="btn btn-dark" placeholder="buscador...">
                                        <input type="submit" name="buscadorSubmit" class="btn btn-dark">
                                    </form>
                                </h1>

                                <div class="dropdown" style="float: right;">
                                    {{--<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$columna}} [{{$orden}}]
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/usuarios/username/asc">Nombre [ASC]</a>
                                        <a class="dropdown-item" href="/usuarios/username/desc">Nombre [DESC]</a>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="card-body">
                                {{-- Usuarios Grid --}}
                                <section class="bg-light" id="ranking">
                                    <div class="container">
                                    @if (isset($busqueda))
                                        <h1>Resultado de la búsqueda... "{{ $busqueda }}"</h1>
                                    @endif

                                        <div class="row">

                                            @foreach($users as $user)
                                            {{-- usuarios a los que sigues --}}

                                                @if (Auth::user()->follows->contains('username', $user->username))
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                                                    <a class="ranking-link" data-toggle="modal" href="/unfollow/{{ $user->id }}">
                                                        <div class="ranking-hover" title="Dejar de Seguir a {{ $user->username }}">
                                                            <div class="ranking-hover-content">
                                                                <i class="fas fa-minus fa-3x"></i>
                                                            </div>
                                                        </div>
                                                        <img class="img-fluid" src="{{ $user->avatar }}" alt="Avatar de {{ $user->username }}">
                                                    </a>
                                                    <div class="ranking-caption">
                                                        <h4 title="{{ $user->username }}"><a href="/{{ $user->username }}">{{ $user->username }}</a></h4>

                                                        <h5 class="stars-votos" style="">
                                                            <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user->username }} está siguiendo a  {{ count ($user->follows) }} usuarios" style="color: green;"></i > {{ count($user->follows) }}
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user->username }} tiene {{ count($user->followers) }} seguidores" style="color: blue;"></i > {{ count($user->followers) }}
                                                        </h5>
                                                    </div>
                                                </div>

                                                @else
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                                                    <a class="ranking-link" data-toggle="modal" href="/follow/{{ $user->id }}">
                                                        <div class="ranking-hover" title="Seguir a {{ $user->username }}">
                                                            <div class="ranking-hover-content">
                                                                <i class="fas fa-plus fa-3x"></i>
                                                            </div>
                                                        </div>
                                                        <img class="img-fluid" src="{{ $user->avatar }}" alt="Avatar de {{ $user->username }}">
                                                    </a>
                                                    <div class="ranking-caption">
                                                        <h4 title="{{ $user->username }}"><a href="/{{ $user->username }}">{{ $user->username }}</a></h4>

                                                        <h5 class="stars-votos" style="">
                                                            <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user->username }} está siguiendo a  {{ count ($user->follows) }} usuarios"></i > {{ count($user->follows) }}
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user->username }} tiene {{ count($user->followers) }} seguidores"></i > {{ count($user->followers) }}
                                                        </h5>
                                                    </div>
                                                </div>

                                                @endif

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
        {{-- jQuery, Bootstrap, jQuery Easing --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Otros --}}
        <script src="{{ asset('js/agency.js') }}"></script>
@endsection
