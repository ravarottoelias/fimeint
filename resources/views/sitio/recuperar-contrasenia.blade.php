@extends('sitio.layout')

@section('content')

<section class="main recuperar-contrasenia">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-lg-6 mx-auto">
            
            <div class="card border-primary mb-3">
                <div class="card-body">
                	<div class="mb-4">
                    	<h3 class="text-dark my-3 text-center">Recuperación de Cuenta</h3>
                    	<p class="text-center">¡Busquemos tu cuenta! Ingresa el correo electrónico con el que te registraste.</p>
                	</div>
                    <form class="form-horizontal" method="POST" action="{{ route('send_email_password_reset') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="col-md-12 col-md-offset-4 text-center">
                                <button id="btnSubmit" type="submit" class="mu-btn mu-primary">
                                    Siguiente <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class=" mx-3 my-0">¿No eres miembro aún? <a href="/register">Regístrate</a></p>
                </div>
                <div class="card-footer text-center">
                    <p class=" mx-3 my-0">¿Ya tenes una cuenta? <a href="{{route('login')}}">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection