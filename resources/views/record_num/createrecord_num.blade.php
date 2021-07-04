@extends('adminlte::page')

@section('title', 'Crear Fichas')

@section('content')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
@endsection

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
            <h1>Crear Ficha</h1>
            <form method="POST" action="{{ route('crearrn') }}">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label>Num Ficha</label>
                        <input class="form-control" type="text" id="record_num" name="record_num" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                    </div>
                </div>
                <div class="form-group">
                    <label>Programa</label>
                    <select id="program" class="form-control" type="text" id="id_training_program" name="id_training_program" required>
                        <!--Hago un foreach en el select para que me traiga los diferentes programas
                        que hay en la tabla programas y me los muestre como opciones -->
                        @foreach ($queryPrograma as $id)
                        <option value="{{$id->id}}">{{$id->name_program}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">REGISTRAR</button><br><br>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#program').select2();
    </script>
@endsection
