@extends('adminlte::page')

@section('title', 'Asistencias')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endsection

@section('content')
    @routes
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="asistencia">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre del Usuario</th>
                        <th scope="col">Id del Usuario</th>
                        <th scope="col">Ficha del Usuario</th>
                        <th scope="col">Creado por</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
<!-- CDNs y Script de datatables.net -->
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
    <script src="{{asset('js/ajax/confirmations.js')}}"></script>
    <script>
        $(document).ready(function () {
            window['table'] = $('#asistencia').DataTable({
                'ajax':'{{route('ajax.asist')}}',
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'id_user'},
                    {data: 'record_num'},
                    {data: 'createdBy'},
                    // {data: 'created_at'},
                    {data: item => `${parseDate(item.created_at)}`},
                    {data: item => `${parseHour(item.created_at)}`},
                    {
                        data(data){
                            return `@can('destroyasistencia')<button onclick="return deleteAsist(${data.id})" class="btn btn-outline-dark"><i class="fa fa-trash-alt"></i></button>@endcan`;
                    }
                    }
                ],
                responsive: true,
                fixedColumns: true,
                autowidth: false,
                language:
                    {url: 'i18n/datatables-spanish.json'},
                dom: 'Bfrtip',
                buttons: [ {
                    text: 'Excel',
                    action: function ( e, dt, button, config ) {
                        window.location = '{{route('asists.excel')}}';
                    }
                },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',


                        customize: function (doc) {
                            var tblBody = doc.content[1].table.body;

                            doc.styles.tableHeader.fillColor = 'orangered';

                            doc.content[1].layout = {
                                hLineWidth: function(i, node) {
                                    return (i === 0 || i === node.table.body.length) ? 2 : 1;},
                                vLineWidth: function(i, node) {
                                    return (i === 0 || i === node.table.widths.length) ? 2 : 1;},
                                hLineColor: function(i, node) {
                                    return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';},
                                vLineColor: function(i, node) {
                                    return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';}
                            };
                        }
                    },
                    'copy', 'csv', 'print'
                ]
            });

            function parseDate(date){
                var newDate = moment(date).format('DD/MM/YYYY');

                return newDate;
            }

            function parseHour(date){
                var newDate = moment(date).format('h:mm a');

                return newDate;
            }
        });


    </script>
@endsection
