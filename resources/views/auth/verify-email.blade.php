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
            <h3>Verificaci&oacute;n de correo</h3>
            {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibió el correo electrónico, con gusto le enviaremos otro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.') }}
            </div>
        @endif
        <div class="d-flex justify-content-around w-50 m-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button type="submit" class="btn btn-primary">Reenviar correo electr&oacute;nico</button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar sesi&oacute;n</button>

            </form>
        </div>
    </main>
@endsection
