@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>


        <style type="text/css">
            .avatar {
                max-width: 600px;
                width: 100%;
                height: auto;
                max-height: 600px;
            }
            .centrado {
                text-align: center;
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
                        <div class="card">
                            <div class="card-header">Perfil Privado</div>

                            <div class="card-body">
                                <h1>Modificar Avatar:</h1>
                                <form action="/user/guardarFotoPerfil" method="post" enctype="multipart/form-data" class="centrado">
                                	<img src="{{$user->avatar}}" class="avatar">
                                	<input type="file" name="newAvatar" class="btn btn-secondary"><input type="submit" name="sub_avatar" value="Cambiar" class="btn btn-primary">
                                </form>

                                <h1>Modificar Datos:</h1>
                                <form action="/user/actualizarDatos" method="post" enctype="multipart/form-data">
                                    <p class="col-lg-5 col-md-9">
                                        <label>Nombre de usuario:</label>   <input type="text" name="username" value="{{$user->username}}" class="w3-input">
                                    </p>
                                    <p class="col-lg-5 col-md-9">
                                        <label>Nombre:</label>              <input type="text" name="name" value="{{$user->name}}" class="w3-input">
                                    </p>
                                    <p class="col-lg-5 col-md-9">
                                     <label>Apellido:</label>               <input type="text" name="lastname" value="{{$user->lastname}}" class="w3-input">
                                    </p>
                                    <p class="col-lg-5 col-md-9">
                                        <label>Correo:</label>              <input type="text" name="email" value="{{$user->email}}" class="w3-input">
                                    </p>
                                    <input type="submit" name="sub_avatar", value="Actualizar" class="btn btn-primary right">
                                </form>
                                <form>
                                   <div class="row">
                                </form>
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
