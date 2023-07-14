@extends('layout.layout_user')
@section('title', 'Agenda tu cita medica')

@section('css')
    <link rel="stylesheet" href="{{ (asset('css/pacient_platform.css')) }}">
@endsection

@section('nav')
    @extends('navbar.navbar')
@endsection

@section('content')
<main class="main d-flex w-100 pt-1" style="flex-wrap: nowrap; justify-content:center; height: 85vh;">
    <div class="d-flex justify-content-between" id="main-class" style="width:90%;">
        <form action="{{ route('submit_cita_medica') }}" method="post" class="bg-white w-100" style="height: fit-content;">
            @csrf
            <section class="bg-white w-100 d-flex" style="height: fit-content;"  id="section">
                <div class="w-75 p-4 conts">
                    <h2>Generar cita medica</h2>
                    <article>
                        <h3>Area medica</h3>

                        <select name="area" class="form-control not_appareance" id="area">
                            <option value="">Seleccionar área medica</option>
                            {{-- @if(isset($response->records)) --}}
                                @foreach ($departamentos as $departamento)
                                    <option value="{{$departamento->id}}">{{ $departamento->nombre_area }}</option>
                                @endforeach
                            {{-- @endif --}}
                        </select>
                    </article>
                    <article>
                        <h3>Doctores</h3>
                        {!! Form::select('doctor_area_medicas', ['placeholder'=>'Seleccionar medico'],
                        null, ['id'=>'medico', 'class' =>'form-control not_appareance', 'disabled']) !!}
                    </article>
                </div>
                <div class="div_table">
                    <div class="d-flex p-4 align-items-center justify-content-between">
                        <h3 class="m-0">Escoger horario</h3>
                        <div class="d-flex flex-column" style="width: 35%">
                            <div class="d-flex justify-content-between">
                                <canvas style="width: 25px; height: 25px; background-color: gray; margin-bottom: 0.5rem;"></canvas><h4  class="m-0">Disponible</h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <canvas style="width: 25px; height: 25px; background-color: green; margin-bottom: 0.5rem;"></canvas><h4 class="m-0">Agendado</h4>

                            </div>
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <canvas style="width: 25px; height: 25px; background-color: red;"></canvas><h4 class="m-0" >Ocupado</h4>

                            </div>
                        </div>

                    </div>

                    <div id="table" class="w-100 px-4 d-flex">

                        <div class="" id="num_hora">
                            <div class="bg-dark p-1 text-white" style="padding-left: 1rem !important;">
                                <h5 class="m-0">Horas</h5>
                            </div>

                        </div>
                        <div id="semana" class="w-100">
                            <div id="dias" class="d-flex text-center" style="width:100%">

                            </div>
                            <div id="horario">
                            </div>
                        </div>

                    </div>
                </div>

            </section>
            <div class="p-2">
                <button type="submit" class="form-control btn btn-success">Solicitar cita médica</button>

            </div>

        </form>

        <aside class="bg-black p-3" style="width:40%;">
            <h4>
                Historial de mis citas medicas
            </h4>
            <div id="div_historial_cita" class="table-striped p-1 rounded">
                <div class="d-flex w-100 justify-content-between bg-secondary p-1">
                    <span>Doctor</span>
                    <span>Area</span>
                </div>

            </div>
        </aside>
    </div>

    <script>
    // $.get("/view_cita_medica", function (response) {
    //     $('#div_historial_cita').append("<a>Hola mundo</a>");

    // });
    const isObjectEmpty = (objectName) => {
        return Object.keys(objectName).length === 0
    }
    var url = "http://127.0.0.1:8000/view_cita_medica";
    var div_historial_cita = document.getElementById('div_historial_cita');
    fetch(url)
        .then(function(response) {
            return response.json();
        })
        .then((response) => {
            response.forEach(element => {

                console.log(element);
                var ela = document.createElement("a");
                var elspan = document.createElement("span");
                var elspan2 = document.createElement("span");

                div_historial_cita.append(ela);
                ela.append(elspan);
                ela.append(elspan2);

                ela.setAttribute('href', url);
                ela.classList.add('d-flex', 'w-100', 'justify-content-between', 'bg-white', 'text-decoration-none', 'text-black', 'p-1');
                elspan.innerText = element.name;
                elspan2.innerText = element.nombre_area;

            });

        });
    $('#area').change(function(event) {

        if (event.target.value) {
            $.get("/get_doctors_departament/"+event.target.value+"", function(response) {
                // console.log(response);
                var medico = document.getElementById("medico");
                medico.disabled = false;
                $('#medico').empty(); //limpiar componente medico
                if (isObjectEmpty(response)) {
                    $('#medico').append("<option>Seleccionar medico</option>");
                    medico.disabled = true;
                }
                for (let i = 0; i < response.length; i++) {

                    $('#medico').append("<option>Seleccionar medico</option>");
                    console.log(response[i].id, response[i].name);
                    $('#medico').append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
                }
            });
        }

    });

    // $('#area').change(event => {
    //     $.get("/get_doctors_departament/${event.target.value}", function (res, area) {
    //         $('#medico').empty();
    //         res.forEach(element => {
    //             $('#medico').append("<option value='${element.id}'>${element.id_doctor}</option>");
    //         });
    //     });
    // });

    </script>
    <script src="{{ asset('js/js1.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</main>
@endsection
