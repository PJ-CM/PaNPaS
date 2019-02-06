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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>


        <script type="text/javascript">

                 var listaFavs = {!!json_encode(Auth::user()->favoritos)!!};

                $(document).ready(function(){
                    searchRecetas();
                });





             function searchRecetas(){
                var buscador = $("input[name=buscador]");

                if(buscador.val().length > 0){ //si el buscador está relleno
                    $.ajax({
 
                    type:"post",
                    url:"/ajax/getSearchRecetas/" + buscador.val(),
                    dataType: "json",
                    success: function(recetas){
                        console.log(recetas);
                        listarRecetas(recetas);
                    }
                    });               
                } else { //si el buscador está vacío
                    $.ajax({
 
                    type:"POST",
                    url:"/ajax/getRecetas",
                    dataType: "json",
                    success: function(recetas){
                        console.log(recetas);
                        listarRecetas(recetas);

                    }    

                });
                }
            }


            function fav (id)  {

                var url = "/ajax/fav/" + id;

                $.ajax({
 
                    type:"POST",
                    url: url,
                    dataType: "json",
                    success: function(favoritos){
                        listaFavs = favoritos;
                        console.log(favoritos);
                        searchRecetas();

                    }    
            });
            }
            



            function unfav (id)  {

                var url = "/ajax/unfav/" + id;

                $.ajax({
 
                    type:"POST",
                    url: url,
                    dataType: "json",
                    success: function(favoritos){
                        //listaFavs = favoritos;
                        listaFavs = {!!Auth::user()->favoritos!!};
                        console.log(favoritos);
                        searchRecetas();

                    }    
            });
            }




           function listarRecetas(recetas){

                $("#listaRecetas").html("");

                for(var i=0; i < recetas.length; i++ ){

                    if(tieneFav(recetas[i].id)){ // si está en favs
                        $("#listaRecetas").html( $("#listaRecetas").html() + '\
                         <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 ranking-item"> \
                        <a class="ranking-link" href="/receta/' + recetas[i].titulo + '"> \
                            <div class="ranking-hover" title="Preparar ' + recetas[i].titulo + '"> \
                                <div class="ranking-hover-content">\
                                    <i class="fas fa-plus fa-3x"></i>\
                                </div>\
                            </div>\
                            <img class="img-fluid" src="' + recetas[i].imagen + '" title="' + recetas[i].titulo + '">\
                        </a>\
                        <div class="ranking-caption">\
                            <h4>\
                                ' + recetas[i].titulo + '\
                            </h4>\
                            <p class="text-muted">por <a href="/' + recetas[i].user.username +'" title="Ver perfil de ' + recetas[i].user.username + '" class="link-marco">' + recetas[i].user.username + '</a></p>\
                            <h5 class="stars-votos" title="' + recetas[i].titulo +' tiene ' + recetas[i].users.length + ' votos">\
                                {{-- Si el usuario no coincide con el de la receta --}}\
                                    <a onclick="unfav(' + recetas[i].id + ');"><i class="fas fa-star fa-lg" title="Quitar Voto" style="color: red; cursor: pointer;"></i> </a>\
                                    ' + recetas[i].users.length +'\
                            </h5>\
                        </div>\
                    </div>\
                        ');
                    } else { // si no está en favs
                        $("#listaRecetas").html( $("#listaRecetas").html() + '\
                         <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 ranking-item"> \
                        <a class="ranking-link" href="/receta/' + recetas[i].titulo + '"> \
                            <div class="ranking-hover" title="Preparar ' + recetas[i].titulo + '"> \
                                <div class="ranking-hover-content">\
                                    <i class="fas fa-plus fa-3x"></i>\
                                </div>\
                            </div>\
                            <img class="img-fluid" src="' + recetas[i].imagen + '" title="' + recetas[i].titulo + '">\
                        </a>\
                        <div class="ranking-caption">\
                            <h4>\
                                ' + recetas[i].titulo + '\
                            </h4>\
                            <p class="text-muted">por <a href="/' + recetas[i].user.username +'" title="Ver perfil de ' + recetas[i].user.username + '" class="link-marco">' + recetas[i].user.username + '</a></p>\
                            <h5 class="stars-votos" title="' + recetas[i].titulo +' tiene ' + recetas[i].users.length + ' votos">\
                                {{-- Si el usuario no coincide con el de la receta --}}\
                                    <a onclick="fav(' + recetas[i].id + ');"><i class="fas fa-star fa-lg" title="Añadir Voto" style="color: #e3ca33; cursor: pointer;"></i> </a>\
                                    ' + recetas[i].users.length +'\
                            </h5>\
                        </div>\
                    </div>\
                        ');
                    }


                }

            }



            function tieneFav (id){ //devuelve true si lo tienes en favoritos
                
              
                
                for (var i = 0; i < listaFavs.length; i++){
                   
                    if (listaFavs[i].id == id){
                        return true;
                    } 
                }
                return false;
            }

        </script>

@endsection

@section('content')

        @include('layouts.public-navbar-auth')

        {{-- Header --}}
        {{--
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
                <span>Ingresa las tuyas. Vota las de otros usuarios</span>
            </div>
        </header>
        --}}

        {{-- Panel-de-Recetas --}}
        <section id="ranking">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <div id="secc-cabecera" class="card text-white">
                            <div class="d-flex justify-content-between m-1">
                                <h1 class="p-2">Recetas</h1>
                                <div class="p-2">
                                   
                                        <input class="form-control mr-sm-2" type="text" placeholder="Término..." name="buscador" oninput="searchRecetas();">
                                </div>
                                <div class="p-2"><button class="btn btn-info mt-2" data-toggle="modal" data-target="#recetaInsModal" title="Registrar una receta">Nueva</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($busqueda))
                <div class="row">
                    <div class="col-12 d-flex justify-content-between mb-2 align-middle">
                        <h2 class="p-2">{{ $tot_resultados == 1 ? $tot_resultados . ' Resultado' : $tot_resultados . ' Resultados' }} de la búsqueda... "{{ $busqueda }}"</h2>
                        <div id="filtro-elim" class="p-2"><a href="{{ route('user_recetas') }}" class="btn btn-info" title="Eliminar filtro">&times;</a></div>
                    </div>
                </div>
                @endif

                <div class="row" id="listaRecetas">

                </div>
            </div>
        </section>
        {{-- Panel-de-Usuarios --}}
@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
        {{-- MODAL INSERTAR-RECETA :: ini --}}
        <div class="modal fade" id="recetaInsModal" tabindex="-1" role="dialog" aria-labelledby="recetaInsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                {{-- Modal content :: ini --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="recetaInsModalLabel">Insertar Receta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="/insertarReceta" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        <div style="margin-bottom: 10px;">
                            <div class="col-lg-8" style="display: inline-block;">
                                <label><strong>Título</strong></label>
                                <input type="text" name="titulo" class="col-lg-12 w3-input" required>
                            </div>
                            <div class="col-lg-3" style="display: inline-block;">
                                <label><strong>Categoría</strong></label>
                                <select name="categoria" id="categoria-id" required>
                                    <option value="">Seleccionar</option>
                                    @foreach($_arr_categoria as $categ)
                                    <option value="{{ $categ }}">@php
                                        echo strtoupper($categ);
                                    @endphp</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                    </div>

                    <div class="modal-footer">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cerrar ventana modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btn_registro" title="Registrar receta">{{ __('Insertar') }}</button>
                        </span>
                    </div>
                    </form>
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
       
@endsection
