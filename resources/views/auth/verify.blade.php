@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="secc-cabecera" class="card-header text-white"><h1>{{ __('Verifica Tu Dirección de Correo') }}</h1></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('En este justo momento, se acaba de enviar un enlace al email empleado en el registro para verificar tu dirección de correo.') }}
                        </div>
                    @endif

                    <p>{{ __('Antes de proceder, por favor, revisa tu email para activar la verificación demandada.') }}</p>

                    <p>{{ __('Si no recibiste dicho email') }}, <a href="{{ route('verification.resend') }}" class="link-marco">{{ __('pulsa aquí para requerir uno nuevo') }}</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
