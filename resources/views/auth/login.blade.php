@extends('layout.layout_guest')

@section('title', 'Agenda tu cita médica - Inicia sesión')

@section('css')
    <link rel="stylesheet" href="{{ (asset('css/login.css')) }}">
@endsection

@section('nav')
    @extends('navbar.navbar')
@endsection
{{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

@section('content')
<form action="{{ route('login.store') }}" method="POST">

    <main class="main d-flex w-100 pt-4" style="flex-wrap: nowrap; justify-content:center; height: 85vh;">
            @csrf
            <div class="d-flex w-75 justify-content-between" style="">
                <div class="bg-white p-4">
                    <h1>Hola mundo</h1>
                    <h3>Si no tienes una cuenta, registrate aquí.</h3>
                    <div class="div_btn_register">
                        <a href="{{ route('register.index') }}" class="btn_register">
                            <h3 class="btn_reg">Crear cuenta</h3>
                        </a>
                    </div>
                </div>
                <div class="bg-primary" style="width: 100%">
                    <div class="d-flex w-100">
                        <h2 class="m-4">Login</h2>
                    </div>
                    <div class="d-flex w-100">
                        <div class="my-4 mx-3">
                            <i class="fas fa-at"></i>
                        </div>
                        <input type="email" class="form-control w-100 m-1" name="email" id="email" placeholder="Ingresa un correo electrónico" required>
                    </div>
                    <div class="d-flex w-100">
                        <div class="my-4 mx-3">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" class="form-control w-100 m-1" name="password" id="password" placeholder="Escribe una contraseña" required>
                    </div>
                    <div class="d-flex w-100">
                        <a href="{{ route('register.index') }}" class="my-4 mx-5 text-white text-decoration-none btns">
                            <h5 class="btn_reg">Olvidé mi contraseña</h5>
                        </a>
                    </div>
                    <div class="w-100 p-2">
                        <button type="submit" class="btn btn-success form-control">Entrar</button>
                    </div>
                </div>


            </div>
    </main>
</form>


@endsection
