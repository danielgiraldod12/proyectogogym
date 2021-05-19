<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script type="text/javascript" src="js/app.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
    <link rel="stylesheet" href="{{asset('css/form-steps.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="/image/logo.ico"/>
</head>
<body>
<!-- header cabecera -->
<header>
    <a href="{{route("home")}}" class="logo">Go<span>Gym</span></a>
    <div class="menu"></div>
    <ul>
        <li><a href="{{route("home")}}">Inicio</a></li>
        <li><a href="{{route("home")}}#IMC">Imc</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="{{route("home")}}#contactenos">Contáctenos</a></li>
        <li><a href="{{ route('register') }}">Registrarse</a></li>
        <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
    </ul>
</header>

<div class="baner">
    @yield('content')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    window.addEventListener('scroll', function () {
        var header = document.querySelector('header');
        header.classList.toggle('sticky', window.scrollY > 0);
    });
</script>
<script src="{{asset('js/form-steps.js')}}" type="text/javascript"></script>

</body>
</html>
