<head>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>

<header>
    <a class="logo">Go<span>Gym</span></a>
</header>

<div class="container">
    <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover" style="width: 400px;overflow: hidden;border-radius: 1px;outline: black 2px;outline-style: groove;">
        <div class="px-2 py-2">
        <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
        Go<span>Gym!</span>
        <p><h2>Hola! Esta es la informacion del Usuario {{$datatables->name}} con numero de Identificacion {{$datatables->identification_num}}</h2></p>
        </p>
            <h3>Nombre: <span>{{$datatables->name}}</span></h3>
            <h3>Tipo Doc.: <span>{{$datatables->typeOfIdentification}}</span></h3>
            <h3>Num Doc: <span>{{$datatables->identification_num}}</span></h3>
            <h3>Email: <span> {{$datatables->email}}</span></h3>
            <h3>Ficha: <span>{{$datatables->record_num}}</span></h3>
            <h3>Programa: <span> {{$datatables->name_program}}</span></h3>
            <h3>Centro: <span>{{$datatables->name_center}}</span></h3>
            <h3>Rol: <span> {{$datatables->rol_name}}</span></h3>
        </div>
    </div>
</div>




