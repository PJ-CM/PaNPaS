<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="author" content="{{ config('app.name', 'PaNPaS') }} S.L.">

        @yield('head_content')

        <link href="{{ asset('admin/css/app_admin.css') }}" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            @include('layouts.admin.main-navbar-top')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('index') }}" class="brand-link" title="Ir a la página de inicio">
                    <img src="images/logo-admin-blanco.png" alt="PaNPaS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name', 'PaNPaS') }}</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="images/admin-icon.png" class="img-circle elevation-2" alt="Imagen de usuario">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Administrador</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    @include('layouts.admin.main-navbar-left')
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            {{--
                id="app", para indicar a VueJS dónde se cargará su parte
            --}}
            <div class="content-wrapper" id="app">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                @include('layouts.admin.main-right-sidebar')
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                @php
                    $anio_ini = 2018;
                    $anio_actual = date('Y');
                    $txt_anios_app = '';
                    if($anio_actual == $anio_ini) {
                        $txt_anios_app = $anio_ini;
                    }
                    else {
                        $txt_anios_app = $anio_ini . '-' . $anio_actual;
                    }
                @endphp

                <strong>Copyright &copy; ZubiriManteo|{{ config('app.name', 'PaNPaS') }} S.L. {{ $txt_anios_app }}.</strong>
                Todos los derechos reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versión</b> 1.0
                </div>
            </footer>

        </div>
        <!-- ./wrapper -->

        @yield('footer_scripts_content')
    </body>
</html>
