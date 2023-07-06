@extends('layout.layout_user')
@section('title', 'Departamento')

@section('nav')
@extends('navbar.navbar')
@endsection

@section('content')
<main class="d-flex w-75 w-100 pt-4" id="app" style="flex-wrap: wrap; justify-content:center; height: 85vh;">
    <form action="{{ route('doctor_area.add') }}" onsubmit="notRefresh()" id="form" class="w-75" method="POST">
        <section class="w-100 bg-white justify-content-between" style="border-radius: 15px; border: 1px solid gray;">
            @csrf
            <article class="p-3 w-100" style="border-bottom: 1px solid gray; margin-right:1rem;">
                <div class="d-flex justify-content-between">
                    <h3>Departamento de {{ $area_medica->nombre_area }}</h3>
                </div>
                <div class="d-flex">
                    <h4 class="mt-2">Descripción:</h4>
                    <div class="w-100">
                        <p style="margin: 0.75rem">{{ $area_medica->descripcion }}</p>
                    </div>

                </div>
            </article>
            <article class="p-3 w-100">
                <div>
                    <h3>Agregar doctor al departamento</h3>
                </div>
                <div>
                    <select class="mt-3 form-control mb-3" style="appearance: auto;"  name="id_doctor">
                        <option value="0">Seleccionar usuario</option>
                        <option v-for="usuario in listUser" :value="[usuario.id]">
                            @{{ usuario.name }}
                        </option>
                    </select>
                    <input type="hidden" name="id_area_medica" id="id_area" value="{{ $area_medica->id }}">
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-primary form-control">Agregar</button>
                </div>
            </article>
        </section>
    </form>
    <aside class="bg-white p-4" style="width: 20%; margin-left:1rem; border-radius: 15px; border: 1px solid gray;">
        <div>
            <h5 class="">Doctores vigentes</h5>
            <div v-if="isEmpty">
                <p>
                    No hay doctores registrados en este departamentos
                </p>
            </div>
            <div v-else>
                <div v-for="doctor in listDoctor" class="d-flex justify-content-between">
                    <div>
                        <p >@{{ doctor.name }}</p>
                    </div>
                    <button class="btn btn-danger" v-on:click="deleteDoctor(doctor.id)" style="width:30px; height: 30px; display:flex; justify-content: center;"><i class="fas fa-trash"></i></button>
                </div>
            </div>

        </div>
    </aside>
</main>

<script>
    var app = new Vue({
        el: '#app'
        , data: {
            listDoctor: [

            ],
            listUser: [

            ],
            empty: false,
            formData: {
            },
        },

        methods: {
            getDoctorList: function() {
                var id = document.getElementById('id_area').value;
                var url = "http://127.0.0.1:8000/doctor_area/"+id;

                fetch(url)
                    .then(function(response) {
                        return response.json();
                    })
                    .then((response) => {
                        this.listDoctor = response;
                    });
            },
            getUserList: function() {
                var url = "http://127.0.0.1:8000/usuario_doctor";
                fetch(url)
                    .then(function(response) {
                        return response.json();
                    })
                    .then((response) => {
                        this.listUser = response;
                    });
            },

            deleteDoctor: function (doctor) {

                axios.delete("http://127.0.0.1:8000/doctor_area_eliminado/"+doctor)
                    .then(function(response) { console.log(response) })
                    .catch(error => { console.log(error.response);});
                this.getDoctorList();
                this.getUserList();
                },
        },
        created: function() {
            // `this` hace referencia a la instancia vm

            this.getDoctorList();
            this.getUserList();

        }
        , computed: {
            isEmpty: function() {
                return jQuery.isEmptyObject(this.listDoctor);
            }
        }
    , });

</script>

@endsection
