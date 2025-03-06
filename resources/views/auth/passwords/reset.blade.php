@extends('sitio.layout')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="text-dark my-3 text-center"><i class="fas fa-key"></i> Nueva contraseña</h3>
                    	<p class="text-center">Crea tu nueva contraseña.</p>

                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>
    
                                <div class="col-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required readonly>
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Nueva contraseña</label>
    
                                <div class="col-12">
                                    <input id="password" type="password" class="form-control" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-12 control-label">Confirmar contraseña</label>
                                <div class="col-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-12">
                                    <button type="submit" class="mu-btn mu-primary">
                                        Confirmar
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

