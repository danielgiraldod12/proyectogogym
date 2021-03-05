@extends('adminlte::page')

@section('title' , 'Datatables')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endsection

@section('content')
<!-- Condicional para que me muestre los alerts en caso de que el controlador le mande
algun mensaje -->
@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="usuarios">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo Identificacion</th>
                    <th scope="col">Num. Identificacion</th>
                    <th scope="col">Ficha</th>
                    <th scope="col">Programa</th>
                    <th scope="col">Centro</th>
                    <th scope="col">Acciones: </th>
                </tr>
            </thead>
                <tbody>
                @foreach ($datatables as $id) <!-- For each para rellenar la tabla usuarios -->
                    <tr>
                        <td>{{$id->id}}</td>
                        <td>{{$id->name}}</td>
                        <td>{{$id->email}}</td>
                        <td>{{$id->typeOfIdentification}}</td>
                        <td>{{$id->identification_num}}</td>
                        <td>{{$id->record_num}}</td>
                        <td>{{$id->name_program}}</td>
                        <td>{{$id->name_center}}</td>
                        <td>
                            <div class="container">
                                <div class="row">
                                <!-- Boton con la ruta para editar y con la variable id -->
                                @can('edit')
                                <button class="btn"><a href="{{route('edit', $id->id)}}"><i style="color: black;" class="fa fa-user-edit"></i></a></button>
                                @endcan
                                <!-- Boton con la ruta destroy y la variable id, solo que en esta ocasion
                                es necesario crearlo dentro de un nuevo form para asi poderle pasar el
                                metodo delete-->

                                    @can('destroy')
                                    <form action="{{route('destroy', $id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return deleteconf()" class="btn"><i class="fa fa-trash-alt"></i></button>
                                    </form>
                                    @endcan
                                    <button class="btn"><a href="{{route('dompdfuser', $id->id)}}"><i style="color: black" class="fa fa-download"></i></a></button>
                                    @can('createasistencia')
                                    <form action="{{route('createasistencia', $id)}}" method="POST">
                                        @csrf
                                        <button onclick="return asistconf()" class="btn"><i style="color: black" class="fa fa-book"></i></button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<!-- CDNs y Script de datatables.net -->
@section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
        <script src="{{asset('js/datatables.js')}}"></script>
        <script>
        $(document).ready(function() {
        $('#usuarios').DataTable( {
            responsive: true,
            fixedColumns: true,
            autowidth: false,
            language:
                {url: 'i18n/datatables-spanish.json'},
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
        </script>
@endsection
