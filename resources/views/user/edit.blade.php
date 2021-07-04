@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
@endsection

@section('content')
@routes
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
    <h1>Editar Usuario</h1>
    <form id="form" onsubmit="editconf(event)" method="POST" action="{{ route('update', $id) }}" >
    @csrf
    @method('put')
    <div class="form-group">
        <label>Tipo Documento</label>
        @php($selected =!empty($id->typeOfIdentification) ? $id->typeOfIdentification : '')
        <select class="form-control" type="text" id="typeOfIdentification" name="typeOfIdentification" required>
            <option value="T.I" {{ $selected=='T.I'  ? 'selected':''}}>T.I</option>
            <option value="C.C" {{ $selected=='C.C'  ? 'selected':''}}>C.C</option>
            <option value="Pasaporte" {{ $selected=='Pasaporte'  ? 'selected':''}}>Pasaporte</option>
            <option value="Carnet de Extranjeria" {{ $selected=='Carnet de Extranjeria'  ? 'selected':''}}>Carnet de Extranjeria</option>
        </select>
    </div>
    <div class="form-group">
        <label>Num. Documento</label>
        <input value="{{$id->identification_num}}" class="form-control" type="text" id="identification_num" name="identification_num" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57  event.charCode <=122)">
    </div>
    <div class="form-group">
        <label>Nombre</label>
        <input value="{{$id->name}}" class="form-control" type="text" id="name" name="name" required onkeypress="return (event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode >=32)">
    </div>
    <div class="form-group">
        <label>Correo electronico</label>
        <input value="{{$id->email}}" class="form-control" type="email" id="email" name="email" required required onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode ==64 || event.charCode ==46 )">
    </div>
    <div class="form-group">
        <label>Ficha</label>
        <!-- Condicional de una linea para que en el select este seleccionada la opcion
        que el usuario tenga guardada en la bd-->
        @php($selected = !empty($query->id_record_num) ? $query->id_record_num : '')
        <select class="form-control" type="text" id="record" name="id_record_num" required>
            <!--Hago un foreach en el select para que me traiga las diferentes fichas
            que hay en la tabla fichas y me las muestre como opciones -->
            @foreach ($record_nums as $record_num)
            <option id="record-{{$record_num->id}}" value="{{$record_num->id}}" {{$selected == $record_num->id ? 'selected' : ''}}>{{$record_num->record_num}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Programa</label>
        <!-- Condicional de una linea para que en el select este seleccionada la opcion
        que el usuario tenga guardada en la bd-->
        @php($selected = !empty($query->id_training_program) ? $query->id_training_program : '')
        <select id="program" class="form-control" type="text" id="id_training_program" name="id_training_program" required>
            <!--Hago un foreach en el select para que me traiga los diferentes programas
            que hay en la tabla programas y me los muestre como opciones -->
            @foreach ($training_programs as $training_program)
            <option id="program-{{$training_program->id}}" value="{{$training_program->id}}" {{$selected == $training_program->id ? 'selected' : ''}}>{{$training_program->name_program}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Centro</label>
        <!-- Condicional de una linea para que en el select este seleccionada la opcion
        que el usuario tenga guardada en la bd-->
        @php($selected = !empty($query->id_training_center) ? $query->id_training_center : '')
        <select id="center" class="form-control" type="text" id="id_training_center" name="id_training_center" required>
            <!--Hago un foreach en el select para que me traiga los diferentes centros
            que hay en la tabla centros y me los muestre como opciones -->
            @foreach ($training_centers as $training_center)
            <option id="center-{{$training_center->id}}" value="{{$training_center->id}}" {{$selected == $training_center->id ? 'selected' : ''}}>{{$training_center->name_center}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Contraseña</label>
        <input class="form-control" type="password" id="password" name="password" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122)">
    </div>
    <button type="submit" class="btn btn-primary" id="button">ACTUALIZAR</button><br><br>
    <p id="parrafo"></p>
</form>
</div>
</div>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('js/datatables.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    var selectedRecord = $('#record-{{$id->id_record_num}}').val();
    var selectedProgram = $('#program-{{$id->id_training_program}}').val();
    var selectedCenter = $('#center-{{$id->id_training_center}}').val();


    $('#record').select2().val(selectedRecord).trigger('change');
    $('#program').select2().val(selectedProgram).trigger('change');
    $('#center').select2().val(selectedCenter).trigger('change');

</script>
@endsection
