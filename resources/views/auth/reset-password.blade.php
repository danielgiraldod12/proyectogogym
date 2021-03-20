@extends('./layouts.background')

@section('title', 'GoGym|Login')

@section('content')
    <div class="login-box">
        @error('email')
        <span class="invalid-feedback" role="alert">
                <strong style="color:orangered;">{{ $message }}</strong>
            </span><br>
        @enderror
        <form method="POST" action="{{route('password.update') }}">

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            @csrf
            <div class="user-box">
                <input type="text" id="email" name="email" value="{{$request->email}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122 || event.charCode ==64 || event.charCode ==46 )" required autofocus>
                <label>Correo electronico</label>
            </div>
            <div class="user-box">
                <input type="password" id="password" name="password" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122)">
                <label>Contraseña</label>
            </div>
            <div class="user-box">
                <input type="password" id="password_confirmation" name="password_confirmation" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode >=65 && event.charCode <=90 || event.charCode >=97 && event.charCode <=122)">
                <label>Confirmar Contraseña</label>
            </div>
            <div class="contentbtniniciar">
                <button type="submit" class="button-loggin" >Reestablecler
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
