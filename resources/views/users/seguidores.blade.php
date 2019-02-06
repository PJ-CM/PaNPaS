@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>
@endsection

@section('content')

        @include('layouts.public-navbar-auth')

        {{-- Header --}}
        {{--
        <header class="masthead" style="
            --bg-url: url(../images/header-followers.jpg);
            --bg-attach: fixed;
            --bg-size: cover;
            --bg-x: center;
            --bg-y: center;
        ">
            <div>
                <h2>{{ config('app.name', 'PaNPaS') }}</h2>
                <span>Accede a todo lo referido</span>
                <span>a los usuarios que te siguen</span>
            </div>
        </header>
        --}}

        {{-- Panel-de-Seguidores --}}
        <section id="ranking">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <div id="secc-cabecera" class="card text-white">
                            <div class="d-flex justify-content-between m-1">
                                <h1 class="p-2">Seguidores</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                @foreach($user->followers as $user_f)
                {{-- usuarios a que siguen al usuario --}}

                    @if (Auth::user()->follows->contains('username', $user_f->username))
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                        <a class="ranking-link" href="/unfollow/{{ $user_f->id }}">
                            <div class="ranking-hover" title="Dejar de seguir a {{ $user_f->username }}">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-minus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ $user_f->avatar }}" alt="Avatar de {{ $user_f->username }}">
                        </a>
                        <div class="ranking-caption">
                            <h4>
                                <a href="/{{ $user_f->username }}" class="link-marco" title="Acceder al perfil de {{ $user_f->username }}">{{ $user_f->username }}</a>
                            </h4>
                            <h5 class="stars-votos">
                                <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user_f->username }} está siguiendo a {{ count ($user_f->follows) }} usuarios" style="color: green;"></i > {{ count($user_f->follows) }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user_f->username }} tiene {{ count($user_f->followers) }} seguidores" style="color: blue;"></i > {{ count($user_f->followers) }}
                            </h5>
                        </div>
                    </div>

                    @else
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                        <a class="ranking-link" href="/follow/{{ $user_f->id }}">
                            <div class="ranking-hover" title="Seguir a {{ $user_f->username }}">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ $user_f->avatar }}" alt="Avatar de {{ $user_f->username }}">
                        </a>
                        <div class="ranking-caption">
                            <h4>
                                <a href="/{{ $user_f->username }}" class="link-marco" title="Acceder al perfil de {{ $user_f->username }}">{{ $user_f->username }}</a>
                            </h4>
                            <h5 class="stars-votos">
                                <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user_f->username }} está siguiendo a {{ count ($user_f->follows) }} usuarios" style="color: grey;"></i > {{ count($user_f->follows) }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user_f->username }} tiene {{ count($user_f->followers) }} seguidores" style="color: grey;"></i > {{ count($user_f->followers) }}
                            </h5>
                        </div>
                    </div>

                    @endif

                @endforeach

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
