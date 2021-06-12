@extends('layouts.background')

@section('title' , 'GoGym! - Register')

@section('content')
<div class="register-box">
    @if(Session::has('message'))
        <strong style="color:orangered;">{{Session::get('message')}}</strong>
    @endif
    <form method="POST" action="{{ route('request-user') }}" id="form" onsubmit="sendForm()" ><br>
        @csrf
        <div id="step1">
            <div class="user-box"><br><br>
                <select type="text" id="typeOfIdentification" name="typeOfIdentification" required>
                    <option style="background-color: gray;" value="T.I" selected>T.I</option>
                    <option style="background-color: gray;" value="C.C">C.C</option>
                    <option style="background-color: gray;" value="Pasaporte">Pasaporte</option>
                    <option style="background-color: gray;" value="Carnet de Extranjeria">Carnet de Extranjeria</option>
                </select>
                <label>Tipo Documento</label>
            </div>

            <div class="user-box">
                <input type="text" id="identification_num" name="identification_num" required
                       onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                <label>Num. Documento</label>
            </div>

            <div class="user-box">
                <input type="text" id="name" name="name" required
                       onkeypress="return (event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode == 32)">
                <label>Nombre</label>
            </div>

            <div class="user-box">
                <input type="email" id="email" name="email" required
                       onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode ==64 || event.charCode ==46 )">
                <label>Correo electronico</label>
            </div>

            <button class="mt-2" onclick="firstStep(event)">Siguiente
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div id="step2" class="d-none">
            <div class="user-box"><br><br>
                <select type="text" id="id_record_num" name="id_record_num" required>
                    @foreach($record_nums as $record_num)
                        <option style="background-color: gray;" value="{{$record_num->id}}">{{$record_num->record_num}}</option>
                    @endforeach
                </select>
                <label>Ficha</label>
            </div>

            <div class="user-box"><br><br>
                <select type="text" id="id_training_program" name="id_training_program" required>
                    @foreach($training_programs as $program)
                        <option style="background-color: gray;" value="{{$program->id}}">{{$program->name_program}}</option>
                    @endforeach
                </select>
                <label>Programa</label>
            </div>

            <div class="user-box"><br><br>
                <select type="text" id="id_training_center" name="id_training_center" required>
                    @foreach($training_centers as $center)
                        <option style="background-color: gray;"  value="{{$center->id}}">{{$center->name_center}}</option>
                    @endforeach
                </select>
                <label>Centro</label>
            </div>

            <button class="mt-2" onclick="secondStep(event)">Atras
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>

            <button class="mt-2" form="form">REGISTRAR
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

{{--        <div class="user-box">--}}
{{--            <input type="password" id="password" name="password" required--}}
{{--                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122)">--}}
{{--            <label>Contraseña</label>--}}
{{--        </div>--}}

{{--        <div class="user-box">--}}
{{--            <input type="password" id="password_confirmation" name="password_confirmation" required--}}
{{--                   onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122)">--}}
{{--            <label for="password_confirmation" value="">Confirmar Contraseña</label>--}}
{{--        </div>--}}


</form>



</div>
@endsection
