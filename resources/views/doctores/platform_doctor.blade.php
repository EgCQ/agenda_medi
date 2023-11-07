@extends('layout.layout_user')
@section('title', 'Agenda tu cita medica')


@section('nav')
@extends('navbar.navbar')
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block m-0" id="">
        <div style="display:flex;" class="align-items-center">
            <strong class="p-2">{{ $message }}</strong>
            <button type="button" class="btn btn-danger close" id="btn_close" data-dismiss="alert">×</button>	
        </div>
    </div>

@endif
    @if ($form1)
        {{-- @foreach ($form1 as $item1)
            {{ $item1->descripcion }}
        @endforeach --}}
        <div class="">
            <div>
                <a href="{{ route('generate-report') }}" class="btn btn-primary">Generar PDF</a>
            </div>
            <div class="d-flex">
                <p>Formulario 1</p>
                <a href="{{ route('form1.viewOne') }}">Editar</a>
            </div>
            <div class="d-flex">
                <p>Formulario 2</p>
                <a href="{{ route('form2.viewOne') }}">Editar</a>

            </div>
            <div class="d-flex">
                <p>Formulario 3</p>
                <a href="{{ route('form3.viewOne') }}">Editar</a>

            </div>
        </div>

    @else
        <a href="{{ route('form1') }}" class="btn btn-info">Realizar primer diagnostico</a>
    @endif
</div>
@endsection
