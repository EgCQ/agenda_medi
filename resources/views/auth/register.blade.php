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
        #btn_close{
            padding:0.5rem;
            float:none;
        }
    </style>
@endsection


@section('nav')
    @extends('navbar.navbar')
@endsection

@section('content')
@if ($message = Session::get('error'))
    <div class="alert alert-warning alert-block m-0" id="">
        <div style="display:flex;" class="align-items-center">
            <strong class="p-2">{{ $message }}</strong>
            <button type="button" class="btn btn-danger close" id="btn_close" data-dismiss="alert">×</button>
        </div>
    </div>

@endif

{{-- <div class="alert alert-warning alert-block m-0" id="">
    <div style="display:flex;" class="align-items-center">
            <strong class="p-2">Hola</strong>
        <button type="button" class="btn btn-danger close" id="btn_close" data-dismiss="alert">×</button>

    </div>

    </div> --}}
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <main class="main d-flex w-100 pt-4" style="flex-wrap: nowrap; justify-content:center; height: 85vh;">
        <div class="d-flex w-75 justify-content-between" style="">
            <div class="bg-white p-4">
                <h1>Hola mundo</h1>
                <h3>¿Ya tienes una cuenta?, inicia sesión aquí.</h3>
                <a href="{{ route('login') }}" class="btn_login"><h3 class="btn_reg">Acceder</h3></a>

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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" style="width: 100%" value="{{ old('name') }}" id="name" placeholder="Escribe tus nombres">
                        </div>
                        <div style="width: 50%">
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" style="width: 100%" id="lastname" value="{{ old('lastname') }}" placeholder="Escribe tus apellidos">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center px-4">
                        @error('name')
                            <span class="d-block invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('lastname')
                            <span class="d-block invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex m-2">
                        <div class="m-2">
                            <i class="fas fa-at"></i>
                        </div>
                        <div class="w-100">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" style="width: 100%" name="email" id="email" value="{{ old('email') }}" placeholder="Ingresa un correo electrónico">
                            @error('email')
                                <span class="d-block invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex m-2">

                        <div class="m-2">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="w-100">
                            <input type="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror"  style="width: 100%" name="password" id="pass" placeholder="Escribe una contraseña" autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex m-2">
                        <div class="m-2">
                            <i class="fas fa-key"></i>
                        </div>
                        <input id="password" type="password" value="{{old('password_confirmation')}}" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" style="width: 100%" name="password_confirmation" placeholder="Escribe una contraseña">
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
