@extends('sitio.layout')

@section('content')


    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="card mt-4">
                    <div class="card-body">

                        <h3 class="text-dark my-3 text-center"><i class="fas fa-key"></i> Recuperación de contraseña</h3>
                    	<p class="text-center">¡Busquemos tu cuenta! Ingresa el correo electrónico con el que te registraste.</p>

                        @if (session('status'))
                            <div class="alert alert-success">
                                <i class="fas fa-envelope"></i>  {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12 text-center">
                                    <button type="submit" class="mu-btn mu-primary">
                                        Siguiente
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

@stop
