        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">{{ __('Registro') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="Cerrar ventana modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="f_register" action="{{ route('register') }}" method="post">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{ __('Nombre de Usuario *') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="email-reg" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email *') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña *') }}" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirmar Contraseña *') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                @if (Route::has('login'))
                                    <a class="btn btn-link" data-dismiss="modal" data-toggle="modal" href="#loginModal" title="Ir a iniciar sesión">{{ __('Ya tengo una cuenta') }}</a>
                                @endif
                            </div>
                        </div>

                        {{--Opción de Inicio de sesión por Red Social--}}
                        <div class="row">
                            <div class="col-md-12 social-auth-links">
                                <p>- O -</p>
                                <a class="btn btn-block btn-social btn-twitter" title="Iniciar sesión con Twitter">
                                    <i class="fab fa-twitter"></i> Registrarse con Twitter
                                  </a>
                                <a href="#" class="btn btn-block btn-social btn-facebook" title="Iniciar sesión con Facebook">
                                    <i class="fab fa-facebook-f"></i> Registrarse con Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-social btn-github" title="Iniciar sesión con GitHub">
                                    <i class="fab fa-github"></i> Registrarse con GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="input-group-btn">
                            <input type="hidden" name="modal" value="registerModal">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cerrar ventana modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btn_registro" title="Efectuar registro">{{ __('Registro') }}</button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
