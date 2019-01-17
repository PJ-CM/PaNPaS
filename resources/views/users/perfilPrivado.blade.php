@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>


        <style type="text/css">
            .avatar {
                width: 100%;
                height: auto;
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
                                <form action="/user/guardarFotoPerfil" method="post" enctype="multipart/form-data">
                                	<h1>Modificar Avatar:</h1>
                                	<img src="{{$user->avatar}}" class="avatar">
                                	<input type="file" name="newAvatar" ><input type="submit" name="sub_avatar">
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
