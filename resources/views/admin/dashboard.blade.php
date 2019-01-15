@extends('layouts.admin.main')

@section('head_content')
        {{--<meta name="description" content="Parte ADMIN.">--}}
        {{--
            :: CSRF Token ::
            Descomentar la siguiente línea, solamente, si hiciera falta
        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

        <title>{{ config('app.name', 'PaNPaS') }} :: ADMIN</title>

        {{--Tras este comentario, añadir enlace a otra(s) hoja(s) si hiciera falta--}}
@endsection

@section('content')

                <transition name="fade" mode="out-in">
                    <!-- el componente coincidente con la ruta será renderizado aquí -->
                    <router-view></router-view>
                </transition>

@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')

        <script src="{{ asset('admin/js/app_admin.js') }}"></script>
        {{--<!--
            AdminLTE for demo purposes
                >> NECESARIO para la barra de cambio de colores -->
        <script src="js/demo.js"></script>--}}

@endsection
