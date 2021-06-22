@extends('layouts.background')
@section('title','GoGym|Calendario')

@push('head')
    <link href='{{asset('fullcalendar/main.css')}}' rel='stylesheet' />
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}" class="src">
    <script src='{{asset('fullcalendar/main.js')}}'></script>
    <script src='{{asset('fullcalendar/locales/es.js')}}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                timeZone : 'local',
                events: @json($eventos),
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endpush

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="card">
            <div class="card-header"><h1 class="titulo_calendario"><span>Cale</span>ndario</h1></div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection
