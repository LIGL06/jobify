@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Hemos enviado el link a tu correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor revisa tu correo electrónico por un link de verificación.') }}
                    {{ __('Sino lo has recibido') }}, <a href="{{ route('verification.resend') }}">{{ __('click aquí para reenviar') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
