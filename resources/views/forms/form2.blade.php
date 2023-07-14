@extends('layout.layout_guest')

@section('title', 'Laravel')


@section('nav')
    @extends('navbar.navbar')
@endsection
{{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

@section('content')
<form action="{{ route('form2.store') }}" method="post">
    @csrf
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 85vh;">
        <h2>Segundo formulario</h2>

        <div class="d-flex w-100 justify-content-center">
            <label for="desc" class="px-3">Descripcion</label>

            <input type="text" name="descripcion" class="form-control w-25 px-3" id="desc" placeholder="Escribe tu comentario">

        </div>
                <div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>

@endsection
