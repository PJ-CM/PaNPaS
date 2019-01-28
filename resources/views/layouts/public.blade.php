<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ config('app.name', 'PaNPaS') }} S.L.">

        @yield('head_content')


        {{-- CSS compilado en /public --}}
        {{--
            ==> Forma normal de llamar al archivo compilado
        <link href="/css/app.css" rel="stylesheet">
            ==> Forma de llamar al archivo compilado con ASSET()
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            ==> Forma de llamar al archivo compilado con MIX() considerando versión del archivo
            tras aplicar .version() al final del MIX() en el archivo de la compilación de archivos
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
            --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body id="page-top">
        <div id="app">

        @yield('content')

        {{-- Footer --}}
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
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
                        <span class="copyright">Copyright &copy; ZubiriManteo|{{ config('app.name', 'PaNPaS') }} S.L. {{ $txt_anios_app }}</span>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline social-buttons">
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="Visitar nuestro Twitter">
                                    <i class="fab fa-twitter" title="{{ config('app.name', 'PaNPaS') }} - Twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="Visitar nuestro Facebook">
                                    <i class="fab fa-facebook-f" title="{{ config('app.name', 'PaNPaS') }} - Facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="Visitar nuestro Linkedin">
                                    <i class="fab fa-linkedin-in" title="{{ config('app.name', 'PaNPaS') }} - Linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline quicklinks">
                            <li class="list-inline-item">
                                <a href="#" title="Ver archivo de Política de Privacidad">Política de Privacidad</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" title="Ver archivo de Términos de Uso">Términos de Uso</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        </div>
        @yield('footer_scripts_content')
    </body>
</html>
