@extends('./layouts.background')

@section('title', 'GoGym|Login')

@section('content')


    <div class="login-box">
        @if (session('status'))
            <div style="color: orange;">
                <h4 style="color: orangered;">{{ session('status') }}</h4>
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="user-box">
                <input type="text" id="email" name="email" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode ==64 || event.charCode ==46 )">
                <label>Correo electronico</label>
            </div>

            <div class="contentbtniniciar">
                <button type="submit" class="button-loggin" >Reestablecer contraseña
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button><br><br>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/validacion.js')}}"></script>
@endsection
