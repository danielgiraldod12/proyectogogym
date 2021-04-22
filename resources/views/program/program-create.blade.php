@extends('adminlte::page')

@section('title', 'Crear Programa')

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
                <h1>Crear Programa</h1>
                <form method="POST" action="{{ route('crearprog') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label>Nombre Programa</label>
                            <input class="form-control" type="text" id="name_program" name="name_program" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">REGISTRAR</button><br><br>
                </form>
            </div>
        </div>
    </div>
@endsection

