@extends('layout.layout_guest')

@section('title', 'Laravel')


@section('nav')
    @extends('navbar.navbar')
@endsection
@section('content')
<form action="" method="post">
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 85vh;">
        <h2>Primer formulario</h2>
        <div class="d-flex w-100 justify-content-center align-items-center">

            <label for="desc" class="px-3">Descripcion</label>
            @foreach ($form1 as $item1)
                <input type="text" name="descripcion" value="{{ $item1->descripcion }}" class="form-control w-25 px-3" id="desc" placeholder="Escribe tu comentario" disabled>
            @endforeach

        </div>
        <div class="d-flex justify-content-center">
            <button type="button" id="btn_edit" class="btn btn-primary m-2">Editar</button>
            <button type="reset" id="btn_cancel" class="btn btn-danger m-2" hidden>Cancelar</button>
            <button type="submit" id="btn_submit" class="btn btn-success m-2" hidden>Enviar</button>
        </div>
    </div>
</form>
<script>
    var btn_edit = document.getElementById("btn_edit");
    var desc = document.getElementById("desc");
    var btn_cancel = document.getElementById("btn_cancel");
    var btn_submit = document.getElementById("btn_submit");
    btn_edit.addEventListener("click", function(){

        btn_edit.hidden = true;
        desc.disabled = false;
        btn_cancel.hidden = false;
        btn_submit.hidden = false;
    });
    btn_cancel.addEventListener("click", function(){
        btn_edit.hidden = false;
        desc.disabled = true;
        btn_cancel.hidden = true;
        btn_submit.hidden = true;
    });

</script>

@endsection
