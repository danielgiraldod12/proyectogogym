@extends('adminlte::page')

@section('title', 'Editar Fichas')

@section('content')
@if(Session::has('message'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <h1>Editar Ficha</h1>
            <form id="form" onsubmit="editconf(event)"  method="POST" action="{{ route('updatern', $id) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Num Ficha</label>
                <input value="{{$id->record_num}}" class="form-control" type="text" id="record_num" name="record_num" required >
            </div>
            <div class="form-group">
                <label>Programa</label>
                <!-- Condicional de una linea para que en el select este seleccionada la opcion
                que el usuario tenga guardada en la bd-->
                @php($selected = !empty($query->id_training_program) ? $query->id_training_program : '')
                <select class="form-control" type="text" id="id_training_program" name="id_training_program" required>
                    <!--Hago un foreach en el select para que me traiga los diferentes programas
                    que hay en la tabla programas y me los muestre como opciones -->
                    @foreach ($training_program as $id)
                    <option value="{{$id->id}}" {{$selected == $id->id ? 'selected' : ''}}>{{$id->name_program}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ACTUALIZAR</button><br><br>
            <p id="parrafo"></p>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/datatables.js')}}"></script>
@endsection
