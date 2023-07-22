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
                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.') }}
            </div>
        @endif
        <div class="d-flex justify-content-around w-50 m-2">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="m-2">
                    <input type="email" class="form-control" name="email" :value="{{ old('email') }}" placeholder="Correo" autofocus required>
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-primary">Correo electr&oacute;nico enlace de reestablecimiento de contraseña</button>
                </div>
            </form>
        </div>
    </main>
@endsection
