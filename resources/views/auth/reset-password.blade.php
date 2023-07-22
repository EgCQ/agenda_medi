@extends('layout.layout_guest')

@section('title', 'Agenda tu cita médica - Inicia sesión')

@section('css')
@endsection

@section('nav')
    @extends('navbar.navbar')
@endsection
@section('content')
    <main class="d-flex w-100 flex-column align-items-center justify-content-center" style="flex-wrap: nowrap; justify-content:center; height: 90vh;">

        <div class="w-50 m-2 text-center">
            <h3>Recuparaci&oacute;n de contraseña</h3>
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente díganos su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Se ha enviado un enlace a su correo para que puedas reestablecer tu contraseña.') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}" class="w-50">
                @csrf
            <div class="d-flex flex-column w-100 m-2">

                    <input type="hidden" name="token" value="{{ $token->route('token') }}">

                    <input type="email" class="form-control" name="email" :value="{{ old('email', $token->email) }}" placeholder="Correo" autofocus required>
                    <div class="d-flex w-100">
                        <input type="password" name="password" class="form-control" id="password" required placeholder="Contraseña">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required placeholder="Confirmar contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Reestablecer contraseña</button>

            </div>

        </form>
    </main>
@endsection
