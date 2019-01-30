@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>

        <style type="text/css">
            .avatar{
                width: 60px;
                height: 60px;
                float: left;
            }
        </style>


@endsection

@section('content')

        @include('layouts.public-navbar-auth')

        {{-- Panel-de-Usuario --}}
        <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card"  id="secc-cabecera">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">

                                {{-- comentarios de sus recetas --}}
                                <ul>
                                    @foreach (Auth::user()->recetas as $receta)                                    
                                        @foreach ($receta->comentarios as $comentario)
                                        <br>
                                            @if ($comentario->time > (time() - 1000))
                                               <li>
                                                <div class="comment-main-level">
                                                    <!-- Avatar -->
                                                    <div class="comment-avatar"><img src="{{ $comentario->user->avatar }}" alt="" class="avatar"></div>
                                                    <!-- Contenedor del Comentario -->
                                                    <div class="comment-box">
                                                        <div class="comment-head">
                                                            <h6 class="comment-name @if ($comentario->user_id == $receta->user_id) by-author @endif"><a href="/{{$comentario->user->username}}">{{$comentario->user->username}}</a></h6>
                                                            <span> hace {{ intval((time() - $comentario->time) / 60) }} minutos</span>
                                                            <a href="/receta/{{$receta->titulo}}"><div class="right btn btn-secondary">Ir a Receta</div></a>

                                                            {{--<i class="fa fa-reply"></i>
                                                            <i class="fa fa-heart"></i>--}}
                                                        </div>
                                                        <div class="comment-content">
                                                            {{$comentario->mensaje}}
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                        @endforeach
                                    @endforeach
                                </ul>
                                
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
