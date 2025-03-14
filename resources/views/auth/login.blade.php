@extends('sitio.layout')

@section('content')
<style type="text/css">
.form-control.has-error {
    border-color: #dc3545;
}
.has-error .help-block{
    color: #dc3545;
}

body{
    background: url(https://image.freepik.com/free-photo/female-student-uses-keyboard-type-computer_112699-553.jpg);
    background-size: contain;
    background-position: top;
}

</style>
<section class="registration-area">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-lg-6 mx-auto">
            
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h3 class="text-dark my-3 text-center">Iniciar Sesión</h3>
                    @if (session('confirmation-success'))
                        <div class="alert alert-success my-3">
                            {{ session('confirmation-success') }}
                        </div>
                    @endif
                    @if (session('confirmation-danger'))
                        <div class="alert alert-danger my-3">
                            {!! session('confirmation-danger') !!}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ request()->email ? request()->email : old('email') }}" required autofocus placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required autofocus placeholder="Contraseña">
                                @if ($errors->has('password'))
                                        <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                <label class="label-checkbox100" for="ckb1">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="mu-btn mu-primary">
                                    <i class="fas fa-sign-in-alt"></i> Entrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class=" mx-3 my-0">¿No eres miembro aún? <a href="/register">Regístrate</a></p>
                </div>
                <div class="card-footer text-center">
                    <p class=" mx-3 my-0">¿Olvidaste tu contraseña? <a href="{{route('password.request')}}">Recuperar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection