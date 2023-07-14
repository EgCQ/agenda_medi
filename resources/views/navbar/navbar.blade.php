{{-- <style>
    #logout{
        font-size: 19px;

    }
    .text-hover-white{
        font-size: 19px;
    }
    .text-hover-white:hover{
        color: white !important;
        transition: 0.5s;
        font-size: 19px;
    }
</style> --}}
{{-- <nav class="d-flex w-100 p-2 bg-danger justify-content-between position-sticky" style="top:0; height:50px;"> --}}
    {{-- @if (Route::has('login')) --}}
        {{-- <div class="mx-4 d-flex">
            <a href="{{ route('/') }}" class="text-decoration-none text-black text-hover-white" style="margin-right: 1rem;">Inicio</a>
            @auth
                <div class="mx-3">
                    <a href="{{ route('home') }}" class="text-decoration-none text-black text-hover-white">Plataforma</a>
                </div>
                <div class="mx-3">
                    <a href="{{ route('agregar_departamento') }}" class="text-decoration-none text-black text-hover-white">Areas medicas</a>
                </div>
            @endauth
        </div> --}}
        {{-- <div class="d-flex">
            @auth
                <div class="mx-3">
                    <a href="#" class="text-decoration-none text-black text-hover-white">Ir a mi perfil</a>
                </div>
                <form action="{{ route('logout') }}" style="--bs-btn-padding-x:0rem !important; --bs-btn-padding-y:0rem !important;" method="post">
                    @csrf
                    <div class="mx-3">
                        <button  type="submit" class="text-decoration-none text-black text-hover-white" style="background-color: transparent; border: none;">Cerrar sesión</button>
                    </div>
                </form>


            @else

            <div class="mx-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-black text-hover-white">Log in</a>

            </div>
            <div class="mx-3">
                <a href="{{ route('register.index') }}" class="text-decoration-none text-black text-hover-white">Register</a>
            </div>
            @endauth

        </div>
    </nav> --}}

<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="navbar-brand" href="{{ route('/') }}">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Plataforma</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('agregar_departamento') }}">
          Areas medicas
        </a>
      </li>
    </ul>
            @auth
            <div class="mx-3">
                <a href="#" class="text-decoration-none btn btn-secondary">Ir a mi perfil</a>
            </div>
            <form action="{{ route('logout') }}" method="post" class="w-0 m-0 mx-3">
                @csrf
                    <button  type="submit" class="btn btn-outline-light">Cerrar sesión</button>
            </form>
            @else
            <div class="mx-3">
                <a href="{{ route('login') }}" class="text-decoration-none btn btn-success">Log in</a>
            </div>
            <div class="mx-3">
                <a href="{{ route('register.index') }}" class="text-decoration-none btn btn-primary">Register</a>
            </div>
            @endauth


  </div>
</nav>
