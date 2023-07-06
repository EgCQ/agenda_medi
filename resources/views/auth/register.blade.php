@extends('layout.layout_guest')

@section('title', 'Agenda tu cita médica - Crea una cuenta')

@section('css')
    <style>
        .btn_login{
            transition: 0.6s all;
            text-decoration-style:double; 
            color:red;
        }
        .btn_login:hover{
            transition: 0.6s all !important;
            color: black !important;
            text-decoration-style: wavy !important;
        }
        /* .btn_reg:hover{
            transition: 0.5s all;
            color: black;
        } */
    </style>
@endsection


@section('nav')
    @extends('navbar.navbar')
@endsection

@section('content')
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <main class="main d-flex w-100 pt-4" style="flex-wrap: nowrap; justify-content:center; height: 85vh;">
        <div class="d-flex w-75 justify-content-between" style="">
            <div class="bg-white p-4">
                <h1>Hola mundo</h1>
                <h3>¿Ya tienes una cuenta?, inicia sesión aquí.</h3>
                <a href="{{ route('login') }}" class="btn_login"><h3 class="btn_reg">Entrar</h3></a>

            </div>
            <div style="display:flex; width:100%; justify-content:space-evenly;">
                <div class="w-100 bg-primary">
                    <div class="d-flex w-100">
                        <h2 class="m-4">Crea tu cuenta</h2>
                    </div>
                    <div class="d-flex m-2">
                        <div class="m-2">
                            <i class="fas fa-user"></i>
                        </div>
                        <div style="width: 50%; margin-right:0.5rem">
                            <input type="text" class="form-control" name="name" style="width: 100%" id="name" placeholder="Escribe tus nombres">
                        </div>
                        <div style="width: 50%">
                            <input type="text" class="form-control" name="lastname" style="width: 100%" id="lastname" placeholder="Escribe tus apellidos">
                        </div>
                    </div>
                    <div class="d-flex m-2">
                        <div class="m-2">
                            <i class="fas fa-at"></i>
                        </div>
                        <input type="email" class="form-control" style="width: 100%" name="email" id="email" placeholder="Ingresa un correo electrónico">
                    </div>
                    <div class="d-flex m-2">
                        <div class="m-2">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="password" class="form-control" style="width: 100%" name="password" id="pass" placeholder="Escribe una contraseña">
                    </div>
            
                    <div class="m-2">
                        <button type="submit" class="btn btn-success form-control">Registrar</button>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
</form>
@endsection