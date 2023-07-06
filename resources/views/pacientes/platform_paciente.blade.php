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
        <form action="" method="post" class="bg-white w-100" style="height: fit-content;">
            <section class="bg-white w-100 d-flex" style="height: fit-content;"  id="section">
                <div class="w-75 p-4 conts">
                    <h2>Generar cita medica</h2>
                    <article>
                        <h3>Area medica</h3>

                        <select name="area" class="form-control not_appareance" id="area">
                            <option value="0">Seleccionar área medica</option>
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
                        null, ['id'=>'medico', 'class' =>'form-control not_appareance']) !!}
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
        </aside>
    </div>

    <script>
    $('#area').change(function(event) {
        $.get("/get_doctors_departament/"+event.target.value+"", function(response, area) {
            // console.log(response);

            $('#medico').empty(); //limpiar componente medico

            for (let i = 0; i < response.length; i++) {
                    if (response[i].length < 1) {
                        $('#medico').append("<option>Seleccionar medico</option>");

                    }
                    $('#medico').append("<option>Seleccionar medico</option>");

                    $('#medico').append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");


            }

        });
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
