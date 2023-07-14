@extends('layout.layout_user')
@section('title', 'Agenda tu cita medica')


@section('nav')
@extends('navbar.navbar')
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <a href="{{ route('form1') }}" class="btn btn-info">Realizar primer diagnostico</a>
</div>
@endsection
