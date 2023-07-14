@extends('layout.layout_user')
@section('title', 'Agenda tu cita medica')


@section('nav')
@extends('navbar.navbar')
@endsection

@section('content')
<div class="d-flex justify-content-center flex-column align-items-center" style="height: 90vh;">
    <h3>¡Felicidades! Completaste con exito tus diagnosticos</h3>
    <a href="{{ route('home') }}" class="btn btn-info">Volver a la plataforma</a>
</div>
@endsection
