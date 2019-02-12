        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Cerrar ventana modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="f_login" action="{{ route('login') }}" method="post">
                        @csrf
                    <div class="modal-body">

                        {{-- Cuando se intente acceder a zona restringida
                            sin iniciar sesión --}}
                        @if (session('noAuth'))
                        <div class="text-justify text-danger">
                            <span class="is-invalid" role="alert">
                                <strong>{{ __('Es obligatorio iniciar sesión para acceder a zona restringida.') }}</strong>
                            </span>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-8 offset-md-2">
                                <input id="email-log" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email *') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--<div class="col-md-8 offset-md-2">
                                <input id="nick-log" type="text" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ old('nick') }}" placeholder="{{ __('Nick de Usuario *') }}" required autofocus>

                                @if ($errors->has('nick'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span>
                                @endif
                            </div>--}}
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 offset-md-2">
                                <input id="pass-log" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña *') }}" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 text-right">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                @if (Route::has('register'))
                                    {{--<a class="btn btn-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>--}}
                                    <a class="btn btn-link" data-dismiss="modal" data-toggle="modal" href="#registerModal" title="Pulsar para registrarse">{{ __('Registrarse') }}</a>
                                @endif
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" title="Pulsar si se olvido la contraseña">
                                        {{ __('¿Olvido de contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{--Opción de Inicio de sesión por Red Social--}}
                        <div class="row">
                            <div class="col-md-12 social-auth-links">
                                <p>- O -</p>
                                <a class="btn btn-block btn-social btn-twitter" title="Iniciar sesión con Twitter">
                                    <i class="fab fa-twitter"></i> Iniciar sesión con Twitter
                                  </a>
                                <a href="#" class="btn btn-block btn-social btn-facebook" title="Iniciar sesión con Facebook">
                                    <i class="fab fa-facebook-f"></i> Iniciar sesión con Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-social btn-github" title="Iniciar sesión con GitHub">
                                    <i class="fab fa-github"></i> Iniciar sesión con GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="input-group-btn">
                            <input type="hidden" name="modal" value="loginModal">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cerrar ventana modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btn_ini_sesion" title="Iniciar sesión">Iniciar sesión</button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
