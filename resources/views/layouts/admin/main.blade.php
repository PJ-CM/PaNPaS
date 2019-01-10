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
            @include('layouts.admin.main-navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('layouts.admin.main-sidebar')
            <!-- /.main-sidebar -->

            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->

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

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

        </div>
        <!-- ./wrapper -->

        @yield('footer_scripts_content')
    </body>
</html>
