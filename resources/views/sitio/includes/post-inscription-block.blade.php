
@if( $curso->permitir_inscripcion == 1 )
<div class="container-stepwizard" id="container-stepwizard">
	<div class="wizard-header text-center">
		<h3 class="heading">Inscripción</h3>
		<p>Seguí los pasos para inscribirte al curso </p>
	</div>

	@if(Auth::user())
		@if(Auth::user()->estaInscriptoEn($data['curso']->id))
			@if(Auth::user()->estaInscriptoEn($data['curso']->id) && Auth::user()->realizoPago($data['curso']->id))
				<div class="stepwizard">
				    <div class="stepwizard-row py-3">
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
				            <p class="d-none d-sm-block">Cuenta</p>
				        </div>
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-pencil-alt"></i></button>
				            <p class="d-none d-sm-block">Inscripción</p>
				        </div>
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-money-check-alt"></i></button>
				            <p class="d-none d-sm-block">Pago</p>
				        </div>
				        {{-- ACTIVO --}}
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-primary btn-circle"><i class="fas fa-check"></i></button>
				            <p class="text-dark d-none d-sm-block">Felicitaciones</p>
				        </div>  
				    </div>
				    <div class="stepwizard-contenido d-flex justify-content-center">
				    	<div class="col-sm-12 col-md-12 text-center">
							<h3 class="text-success mt-3">Felicitaciones</h3>
							<p class="text-muted mb-4">Tu pago fue registrado y sera revisado a la brevedad.</p>
						</div>
					</div>
				</div>
			@else
				<div class="stepwizard">
				    <div class="stepwizard-row py-3">
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
				            <p class="d-none d-sm-block">Cuenta</p>
				        </div>
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-pencil-alt"></i></button>
				            <p class="d-none d-sm-block">Inscripción</p>
				        </div>
				        {{-- ACTIVO --}}
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-primary btn-circle"><i class="fas fa-money-check-alt"></i></button>
				            <p class="text-dark d-none d-sm-block">Pago</p>
				        </div>
				        <div class="stepwizard-step">
				            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-check"></i></button>
				            <p class="d-none d-sm-block">Felicitaciones</p>
				        </div>  
				    </div>
				    <div class="stepwizard-contenido d-flex justify-content-center">
				    	<div class="col-sm-12 col-md-12">
							<!-- SCRIPTS DE PAGO -->
							<div class="row form-group">
                            <div class="col">
                                <div class="alert alert-info" role="alert">
                                	<i class="fas fa-exclamation-circle"></i> <b>Atención.</b> Por favor una vez realizado el pago <b>haga click en el botón "Volver al sitio"</b> para que su pago quede registrado en nuestra plataforma. Gracias</div>
                            </div>
                        </div>
							@if($data['curso']->scriptsDePagos()->count()>0)
								<div class="pricing py-5">
								  <div class="container">
							    	{{-- <h3 class="text-light mb-5 text-center">Podes realizar el pago desde aquí</h3> --}}
								    <div class="row">
						    		  @foreach($data['curso']->scriptsDePagos()->get() as $sp)
								      <!-- Free Tier -->
								      <div class="col-lg-4 col-md-6 col-sm-12 my-3">
								        <div class="card mb-5 mb-lg-0">
								          <div class="card-body">
								            <h5 class="card-title text-muted text-uppercase text-center">{{$sp->titulo}}</h5>
								            {{-- <h6 class="card-price text-center">$0<span class="period"></span></h6> --}}
								            <hr>
							              	<p class="text-center">{{$sp->descripcion}}</p>
								            <div class="text-center">
								            {!! $sp->script !!}
								            	
								            </div>
								            {{-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> --}}
								          </div>
								        </div>
								      </div>
								      @endforeach
								    </div>
								  </div>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endif
		@else
			<div class="stepwizard">
			    <div class="stepwizard-row py-3">
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
			            <p class="d-none d-sm-block">Cuenta</p>
			        </div>
			        {{-- ACTIVO --}}
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-primary btn-circle"><i class="fas fa-pencil-alt"></i></button>
			            <p class="text-dark d-none d-sm-block">Inscripción</p>
			        </div>
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-money-check-alt"></i></button>
			            <p class="d-none d-sm-block">Pago</p>
			        </div>
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-check"></i></button>
			            <p class="d-none d-sm-block">Felicitaciones</p>
			        </div>  
			    </div>
			    <div class="stepwizard-contenido d-flex justify-content-center">
			    	<div class="col-sm-12 col-md-8">
			    		<form method="POST" action="{{ route('crear_inscripcion') }}">
			    			{{ csrf_field() }}
			    			<input type="hidden" name="curso_id" value="{{$curso->id}}">
			    			<div class="form-group">
							    <label style="font-size: 18px">¿Cómo te enteraste del curso?</label>
							    <div class="form-check ml-4">
								  <input class="form-check-input" id="facebook-option" type="radio" name="canal" value="facebook" required>
								  <label class="form-check-label" for="facebook-option">
								    Facebook 
								  </label>
								</div>
								<div class="form-check ml-4">
								  <input class="form-check-input" id="instagram-option" type="radio" name="canal" value="instagram">
								  <label class="form-check-label" for="instagram-option">
								    Instagram
								  </label>
								</div>
								<div class="form-check ml-4">
								  <input class="form-check-input" id="email-option" type="radio" name="canal" value="email">
								  <label class="form-check-label" for="email-option">
								    Email
								  </label>
								</div>
								<div class="form-check ml-4">
								  <input class="form-check-input" id="iadef-option" type="radio" name="canal" value="iadef">
								  <label class="form-check-label" for="iadef-option">
								    IADEF
								  </label>
								</div>
								<div class="form-check ml-4">
								  <input class="form-check-input" id="whatsapp-option" type="radio" name="canal" value="whatsapp">
								  <label class="form-check-label" for="whatsapp-option">
								    Whatsapp
								  </label>
								</div>
								<div class="form-check ml-4">
								  <input class="form-check-input" id="otro-option" type="radio" name="canal" value="otro">
								  <label class="form-check-label" for="otro-option">
								    Otro
								  </label>
								</div>
						  	</div>
							<div class="w-100 my-4 card">
								<button type="submit" class="btn btn-info">INSCRIBIRME</button>
								{{-- <a href="{{route('crear_inscripcion')}}?curso_id={{$curso->id}}" class="btn btn-info">INSCRIBIRME</a> --}}
							</div>
			    		</form>
					</div>
				</div>
			</div>
		@endif
	@else
		<div class="stepwizard">
			    <div class="stepwizard-row py-3">
			        {{-- ACTIVO --}}
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-primary btn-circle"><i class="fas fa-user"></i></button>
			            <p class="text-dark  d-none d-sm-block">Cuenta</p>
			        </div>
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-pencil-alt"></i></button>
			            <p class="d-none d-sm-block">Inscripción</p>
			        </div>
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-money-check-alt"></i></button>
			            <p class="d-none d-sm-block">Pago</p>
			        </div> 
			        <div class="stepwizard-step">
			            <button type="button" class="btn btn-default btn-circle"><i class="fas fa-check"></i></button>
			            <p class="d-none d-sm-block">Felicitaciones</p>
			        </div> 
			    </div>
			    <div class="stepwizard-contenido d-flex justify-content-center">
			    	<div class="col-sm-12 col-md-8">
			    		<h5 class="mb-4 text-center text-muted">Inicia Sesión para Inscribirte</h5>
				    	<form  class="form-horizontal login-alumno" method="POST" action="{{ route('login_alumno') }}">
		                    {{ csrf_field() }}
		                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                        <div class="col-md-12">
		                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
		                            @if ($errors->has('email'))
		                                <div class="text-danger">
		                                    <strong>{{ $errors->first('email') }}</strong>
		                                </div>
		                            @endif
		                        </div>
		                    </div>

		                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                        <div class="col-md-12">
		                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
		                            @if ($errors->has('password'))
		                                <div class="text-danger">
		                                    <strong>{{ $errors->first('password') }}</strong>
		                                </div>
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
		                            <button type="submit" class="btn btn-primary">
		                                <i class="fas fa-sign-in-alt"></i> Entrar
		                            </button>
		                        </div>
		                    </div>
		                </form>
		                <p class="text-muted mx-3 mt-4 text-center">¿No eres miembro aún? <a href="/register">Regístrate</a></p>
		            	<p class="text-muted mx-3 mt-4 text-center">¿Olvidaste tu contraseña? <a href="{{route('reset_password')}}">Recuperar</a></p>
		            </div>
			    </div>
		</div>	
	@endif
</div>	
@endif