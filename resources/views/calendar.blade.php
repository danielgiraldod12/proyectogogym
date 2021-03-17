<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link href='{{asset('fullcalendar/main.css')}}' rel='stylesheet' />
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}" class="src">
    <script src='{{asset('fullcalendar/main.js')}}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone : 'local',
                events: @json($eventos),
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });

    </script>
</head>
<body>
<div id='calendar'></div>
</body>
</html>
