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
            <h1>Mensaje de <span>Go</span>Gym</h1>
        </div>

        <div class="mensaje">
            <p><strong>ASUNTO : </strong>{{$contacto['mensaje']}}</p>
            <p><strong>NOMBRE : </strong>{{$contacto['name']}}</p>
            <p><strong>CORREO : </strong>{{$contacto['correo']}}</p>
        </div>


        <div class="imagen">
            <img src="{{asset('img/sena.png')}}" alt="">
        </div>


    </div>

</body>
</html>
