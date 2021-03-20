@extends('adminlte::page')

@section('title', 'Datatables - Edit')

@section('content')

    @if($id == $idLog)
        <div class="alert alert-warning" role="alert">
            No te recomendamos cambiar tus propios roles!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1>Asignar un Rol</h1>
            </div>
            <div class="card-body">
                <p class="h5">Nombre:</p>
                <p class="form-control">{{$user->name}}</p>

                <h2 class="h5">Listado de Roles</h2>
                {!! Form::model($user, ['route' => ['updateroles', $user->id], 'method' => 'put']) !!}
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach

                {!! Form::submit('Asignar un rol', ['class' => 'btn btn-primary mt-2'])!!}
                {!! Form::close() !!}
            </div>
        </div>



@endsection
