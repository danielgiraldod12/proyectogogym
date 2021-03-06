@extends('adminlte::page')

@section('title', 'Editar Evento')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <h1>Editar Eventos</h1>
            <form id="form" onsubmit="editconf(event)"  method="POST" action="{{ route('updateevents', $id) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Titulo del evento</label>
                <input value="{{old('title',$id->title)}}" class="form-control" type="text" id="title" name="title" required >
                <br>
                @error('title')
                <small style="color: red; font-size: 15px">*{{$message}}</small>
                <br>
                <br>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha del evento</label>
                <input value="{{old('date',$id->date)}}" class="form-control" type="date" id="date" name="date" required >
                <br>
                @error('date')
                <small  style="color: red; font-size: 15px">*{{$message}}</small>
                <br>
                <br>
                @enderror
            </div>
            <div class="form-group">
                <label>Descripcion del evento</label>
                <textarea  class="form-control " type="textarea" id="description" name="description" maxlength="50" required cols="3" rows="3">{{old('description',$id->description)}}</textarea>
                <br>
                @error('description')
                <small  style="color: red; font-size: 15px;">*{{$message}}</small>
                <br>
                <br>
                @enderror
            </div>
            <div class="form-group">
                <label>Estado del evento</label>
                <!-- Condicional de una linea para que en el select este seleccionada la opcion
                que el usuario tenga guardada en la bd-->
                @php($selected =!empty($id->state) ? $id->state : '')
                <select class="form-control" type="text" id="state" name="state" required>
                    <option id="Activo" value="Activo" {{$selected=="Activo" ? 'selected':''}}>Activo</option>
                    <option id="Desactivado" value="Desactivado" {{$selected=="Desactivado" ? 'selected':''}} style="font-weight: bold">Desactivado</option>
                </select>
                <br>
                @error('state')
                <small  style="color: red; font-size: 15px">*{{$message}}</small>
                <br>
                <br>
                @enderror
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        var selectedState = $('#{{$id->state}}').val();

        $('#state').select2().val(selectedState).trigger('change');
    </script>
@endsection
