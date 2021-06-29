{{--@component('mail::message')--}}
{{-- Greeting --}}
{{--@if (! empty($greeting))--}}
{{--# {{ $greeting }}--}}
{{--@else--}}
{{--@if ($level === 'error')--}}
{{--# @lang('Whoops!')--}}
{{--@else--}}
{{--# @lang('Hello!')--}}
{{--@endif--}}
{{--@endif--}}

{{-- Intro Lines --}}
{{--@foreach ($introLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Action Button --}}
{{--@isset($actionText)--}}
{{--<?php--}}
{{--    switch ($level) {--}}
{{--        case 'success':--}}
{{--        case 'error':--}}
{{--            $color = $level;--}}
{{--            break;--}}
{{--        default:--}}
{{--            $color = 'primary';--}}
{{--    }--}}
{{--?>--}}
{{--@component('mail::button', ['url' => $actionUrl, 'color' => $color])--}}
{{--{{ $actionText }}--}}
{{--@endcomponent--}}
{{--@endisset--}}

{{-- Outro Lines --}}
{{--@foreach ($outroLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Salutation --}}
{{--@if (! empty($salutation))--}}
{{--{{ $salutation }}--}}
{{--@else--}}
{{--@lang('Regards'),<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endif--}}

{{-- Subcopy --}}
{{--@isset($actionText)--}}
{{--@slot('subcopy')--}}
{{--@lang(--}}
{{--    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
{{--    'into your web browser:',--}}
{{--    [--}}
{{--        'actionText' => $actionText,--}}
{{--    ]--}}
{{--) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>--}}
{{--@endslot--}}
{{--@endisset--}}
{{--@endcomponent--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        .container{
            width: 100%;
            height: 90%;
            background-color: #272422;
        }
        .titulo{
            text-align: center;
            width: 100%;
            height: 100%;
            padding-top: 10px;
        }
        .titulo h1{

            color: #FF7700;
        }
        .titulo h1 span{
            color: white;
        }


        .imagen{

            text-align: center;
            width: 100%;
            height: 100%;

        }
        .imagen img{
            width: 30%;
            height: 30%;
        }

        .mensaje{

            width: 100%;
            height: 100%;
            text-align: justify;
            padding: 0px 30px;

        }
        .mensaje strong{
            color: #FF7700;
        }
        .mensaje p{
            color: white;
            font-size: 1em;
        }

        @media screen and (max-width: 400px){
            .mensaje{
                font-size:10px;
            }

        }


    </style>
</head>
<body>

<div class="container">
    <div class="titulo">
        <h1>Restablecer Contraseña <span>Go</span>Gym</h1>
    </div>

    <p style="color: white;">Solicitud de restablecer contraseña, si no lo solicitastes tu, deberias ignorar este correo.</p>

    @isset($actionText)
    <?php
        switch ($level) {
            case 'success':
            case 'error':
                $color = $level;
                break;
            default:
                $color = 'primary';
        }
    ?>

    @component('mail::button', ['url' => $actionUrl, 'color' => $color])
    {{ 'Restablecer Contraseña' }}
    @endcomponent
    @endisset


    <div class="imagen">
        <img src="{{asset('img/sena.png')}}" alt="">
    </div>


</div>

</body>
</html>
