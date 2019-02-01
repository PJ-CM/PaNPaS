@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Viendo el listado de nuestros usuarios registrados en PaNPaS.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
        <link type="text/js" href="{{ URL::asset('js/app.js') }}">



        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>

        <style type="text/css">
            .ranking-link {
                color: red;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                updateUsuarios();
            });


            function searchUsuarios(){
                var buscador = $("input[name=buscador]");

                if(buscador.val().length > 0){
                    $.ajax({
 
                    type:"post",
                    url:"/ajax/getSearchUsuarios/" + buscador.val(),
                    dataType: "json",
                    success: function(users){
                        console.log(users);
                        listarUsuarios(users);
                    }
                    });               
                } else {
                    updateUsuarios();
                }
            }

            function updateUsuarios(){
                
                $.ajax({
 
                    type:"POST",
                    url:"/ajax/getUsuarios",
                    dataType: "json",
                    success: function(users){

                        listarUsuarios(users);

                    }    

                });
            }

            
            function listarUsuarios(users){
                $("#ListaUsuario").html("");
                for (var i = 0; i < users.length; i++){

                            if(users[i].username != "{{Auth::user()->username}}" ){ //si no soy yo


                                 $("#ListaUsuario").html($("#ListaUsuario").html() + '\
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">\
                                    <a class="ranking-link" href="/unfollow/' + users[i].id + '">\
                                        <div class="ranking-hover seguido" title="Dejar de seguir a ' + users[i].username + '">\
                                            <div class="ranking-hover-content">\
                                                <i class="fas fa-minus fa-3x"></i>\
                                            </div>\
                                        </div>\
                                        <img class="img-fluid" src=" ' + users[i].avatar +' + " alt="Avatar de ' + users[i].username + ' ">\
                                    </a>\
                                    <div class="ranking-caption">\
                                        <h4>\
                                            <a href="/' + users[i].username +'" class="link-marco" title="Acceder al perfil de ' + users[i].username + '">' + users[i].username + '</a>\
                                        </h4>\
                                        <h5 class="stars-votos">\
                                            <i class="fas fa-lg fas fa-sign-out-alt" title=" ' + users[i].username + ' está siguiendo a ' + users[i].follows.length + ' + usuarios" style="color: green;"></i > ' + users[i].follows.length + '\
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                                            <i class="fas fa-lg fas fa-sign-in-alt" title="' + users[i].username + ' tiene ' + users[i].followers.length + ' seguidores" style="color: blue;"></i> ' + users[i].followers.length + '\
                                        </h5>\
                                    </div>\
                                </div>');
                                
                            }     
                        } 
            }

            //lista de los usuarios que sigues, nombre del usuario
            function siguiendo (listaFollows, nombre){ //devuelve true si lo estás siguiendo o false si no

                var auth = "{{Auth::user()->username}}";

                for (var i = 0; i < listaFollows.length; i++){
                    if (listaFollows[i].username == nombre){
                        alert(auth + "sigue a " + nombre);
                        return true;
                    }else {
                        return false;
                    }
                }

            }


        </script>


@endsection

@section('content')

        @include('layouts.public-navbar-auth')

        {{-- Header --}}
        {{--
        <header class="masthead" style="
            --bg-url: url(../images/header-usuarios.jpg);
            --bg-attach: fixed;
            --bg-size: cover;
            --bg-x: 65%;
            --bg-y: center;
        ">
            <div>
                <h2>{{ config('app.name', 'PaNPaS') }}</h2>
                <span>Conoce a todos nuestros usuarios</span>
                <span>Házte seguidor de tus favoritos</span>
            </div>
        </header>
        --}}

        {{-- Panel-de-Usuarios --}}
        <section id="ranking">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <div id="secc-cabecera" class="card text-white">
                            <div class="d-flex justify-content-between m-1">
                                <h1 class="p-2">Usuarios</h1>
                                <div class="p-2">
                                    <form class="form-inline mt-2" action="" method="post">
                                        <input class="form-control mr-sm-2" type="text" placeholder="Término..." name="buscador" oninput="searchUsuarios()">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($busqueda))
                <div class="row">
                    <div class="col-12 d-flex justify-content-between mb-2 align-middle">
                        <h2 class="p-2">Resultado de la búsqueda... "{{ $busqueda }}"</h2>
                        <div id="filtro-elim" class="p-2"><a href="{{ route('user_usuarios') }}" class="btn btn-info" title="Eliminar filtro">&times;</a></div>
                    </div>
                </div>
                @endif

                <div class="row" id="ListaUsuario">
            {{-- TARJETA DE UN USUARIO
                @foreach($users as $user)
            
                    @if (Auth::user()->follows->contains('username', $user->username))
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                        <a class="ranking-link" href="/unfollow/{{ $user->id }}">
                            <div class="ranking-hover" title="Dejar de seguir a {{ $user->username }}">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-minus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ $user->avatar }}" alt="Avatar de {{ $user->username }}">
                        </a>
                        <div class="ranking-caption">
                            <h4>
                                <a href="/{{ $user->username }}" class="link-marco" title="Acceder al perfil de {{ $user->username }}">{{ $user->username }}</a>
                            </h4>
                            <h5 class="stars-votos">
                                <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user->username }} está siguiendo a {{ count ($user->follows) }} usuarios" style="color: green;"></i > {{ count($user->follows) }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user->username }} tiene {{ count($user->followers) }} seguidores" style="color: blue;"></i > {{ count($user->followers) }}
                            </h5>
                        </div>
                    </div>

                    @else
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
                        <a class="ranking-link" href="/follow/{{ $user->id }}">
                            <div class="ranking-hover" title="Seguir a {{ $user->username }}">
                                <div class="ranking-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ $user->avatar }}" alt="Avatar de {{ $user->username }}">
                        </a>
                        <div class="ranking-caption">
                            <h4>
                                <a href="/{{ $user->username }}" class="link-marco" title="Acceder al perfil de {{ $user->username }}">{{ $user->username }}</a>
                            </h4>
                            <h5 class="stars-votos">
                                <i class="fas fa-lg fas fa-sign-out-alt" title="{{ $user->username }} está siguiendo a {{ count ($user->follows) }} usuarios"></i > {{ count($user->follows) }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fas fa-lg fas fa-sign-in-alt" title="{{ $user->username }} tiene {{ count($user->followers) }} seguidores"></i > {{ count($user->followers) }}
                            </h5>
                        </div>
                    </div>

                    @endif

                @endforeach
            --}}
                </div>
            </div>{{-- CABECERA --}}
        </section>
        {{-- Panel-de-Usuarios --}}
@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
        {{-- jQuery, Bootstrap, jQuery Easing --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Otros --}}
        <script src="{{ asset('js/agency.js') }}"></script>
@endsection
