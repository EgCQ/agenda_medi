@extends('layout.layout_user')
@section('title', 'Agregar nuevo departamento')

@section('nav')
@extends('navbar.navbar')
@endsection

<style>
    p#texto{
        text-align: center;
        color: white;
        cursor: pointer;
    }
    div#div_file{
        position: relative;
        background: rgb(0, 102, 255);
        width: 150px;
        padding-top: 0.5rem;
        padding-bottom: 0.1rem;
        cursor: pointer;
    }
    input#btn_enviar{
        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        opacity: 0;
        height: 100%;
        
    }
</style>
@section('content')
<main class="d-flex w-75 w-100 pt-4" style="flex-wrap: wrap; justify-content:center; height: 85vh;">
    <form action="{{ route('departamento_agregado') }}" class="w-75" method="POST">
        <div>
            <h2>Agregar nuevo departamento</h2>
        </div>
        <section class="d-flex w-100">
            @csrf

            <article>
                <div class="m-2 text-wrap" id="div_file">
                    <p id="texto">Subir foto</p>
                    <input type="file" name="archivos" id="btn_enviar">
                </div>

                <div>
                    <p class="mx-2">Opcional</p>
                </div>
            </article>
            <article class="w-100">
                <div class="m-2">
                    <input type="text" name="nombre_area" class="w-100 form-control" placeholder="Nombre de departamento" id="departamento">
                </div>
                <div class="m-2">
                    <textarea name="descripcion" placeholder="Descripcion del departamento" class="h-100 w-100 form-control" id="descripcion" name="descripcion"></textarea>
    
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-success form-control">Agregar</button>
                </div>
            </article>

        </section>

    </form>
    <section class="w-75">
        <div>
            <h3>Áreas médicas - Anexar nuevos doctores</h3>
        </div>
        <div class="d-flex">
            @if ($departamentos->isEmpty())
                <div class="product w-100" style="background-color:burlywood; height: 100% !important;">
                    <h3>
                        No hay resultados
                    </h3>
                </div>
            @else
                @foreach ($departamentos as $departamento)
                    <div class="mx-2">
                        <a class="btn btn-primary" href="{{ route('area_medica.view', ['id' => $departamento->id]) }}">
                            {{ $departamento->nombre_area }}
                        </a>
                    </div>
                @endforeach
            @endif        

        </div>

    </section>
</main>
@endsection