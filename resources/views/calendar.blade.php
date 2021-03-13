<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link href='{{asset('fullcalendar/main.css')}}' rel='stylesheet' />
    <script src='{{asset('fullcalendar/main.js')}}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone : 'local',
                events:[

                    { title: <?php echo json_encode($title) ?>, start: new Date(<?php echo json_encode($date) ?>)},
                    { title:'All Day Event', start:new Date(2021, 3, 5)},
                    { title:'Long Event', start:new Date(2021, 4, 22), end:new Date(2021, 4, 23)}
                ],
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
