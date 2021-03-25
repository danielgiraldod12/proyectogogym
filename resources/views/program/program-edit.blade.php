@extends('adminlte::page')

@section('title', 'Datatables - Edit')

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
                <h1>Editar Programa</h1>
                <form id="form" onsubmit="editconf(event)"  method="POST" action="{{ route('updateprog', $id) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nombre programa</label>
                        <input value="{{$id->name_program}}" class="form-control" type="text" id="name_program" name="name_program" required >
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
