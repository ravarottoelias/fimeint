@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe</title>
    {{-- <meta name="description" content="Derka y Vargas Concesionario Oficial Toyota en Chaco. Venta de 0KM, Usados Certificados Toyota, Usados Multimarcas. Servicios de Posventa. Plan de Ahorro 100% financiado"> --}}
@stop

@section('mark-up-facebook')
@stop

@section('styles')

@stop


@section('content')

	<!-- Start Breadcrumb -->
	<div id="mu-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb" role="navigation">
					  <ol class="breadcrumb mu-breadcrumb">
					    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
					    <li class="breadcrumb-item active" aria-current="page">Contacto</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

		<!-- Start Contact -->
		<section id="mu-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-contact-area py-4">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>Hola!</h2>
										<p>¿Alguna pregunta? Háganos saber a través de cualquiera de nuestros medios.</p>
									</div>
								</div>
							</div>
							<!-- Start Contact Content -->
							<div class="row">
								<div class="col-md-6 col-xs-12">

									<div class="mu-contact-form-area">
										<div id="form-messages"></div>
										<form method="post" action="{{ route('submit_form_contact') }}" class="mu-contact-form">
											{{ csrf_field() }}
											<div class="form-group">  
												<span class="fa fa-user mu-contact-icon"></span>              
												<input type="text" class="form-control" placeholder="Nombre" name="name" required>
												<span class="text-danger">
													{{  $errors->first('name') }}
												</span>
											</div>

											<div class="form-group">  
												<span class="fa fa-envelope mu-contact-icon"></span>              
												<input type="email" class="form-control" placeholder="Ingrese su email" name="email" required>
												<span class="text-danger">
													{{  $errors->first('email') }}
												</span>
											</div>    

											<div class="form-group"> 
												<span class="fa fa-phone mu-contact-icon"></span>                
												<input type="text" class="form-control" placeholder="Teléfono de contacto" name="telefono" required>
												<span class="text-danger">
													{{  $errors->first('telefono') }}
												</span>
											</div>

											<div class="form-group">
												<span class="fa fa-pencil-square-o mu-contact-icon"></span> 
												<textarea class="form-control" placeholder="Mensaje" name="message" required></textarea>
												<span class="text-danger">
													{{  $errors->first('name') }}
												</span>
											</div>
											<div class="form-group">
												<div class="g-recaptcha" 
											         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
											    </div>
												@if ($errors->has('g-recaptcha-response'))
												    <span class="text-danger">
												        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
												    </span>
												@endif
											</div>
											<button type="submit" class="mu-send-msg-btn"><span>Enviar</span></button>
							        	</form>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 px-3 py-3"></div>
								<div class="col-md-4 col-xs-12 px-3 py-3">
									<!-- Start single service -->
										<div class="mu-single-service my-2">
											<div class="mu-single-service-icon"><i class="fas fa-location-arrow"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">Dirección</h3>
												<p class="text-justify">Hipólito Yrigoyen 645, Resistencia, Chaco</p>
											</div>
										</div>
									<!-- End single service -->
									<!-- Start single service -->
										<div class="mu-single-service my-2">
											<div class="mu-single-service-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">Teléfono</h3>
												<p class="text-justify"> <i class="fab fa-whatsapp pr-1"></i> +54 9 362 437-3386</p>
												<p class="text-justify"> <i class="fa fa-phone pr-1" ></i> (0362) 4429786</p>
											</div>
										</div>
									<!-- End single service -->
									<!-- Start Whatsapp -->
										<a class="mu-single-service my-2" href="https://api.whatsapp.com/send?phone=543624373386">
											<div class="mu-single-service-icon" style="background-color: #65bc54"><i class="fab fa-whatsapp"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">Whatsapp</h3>
												<p class="text-justify text-dark">Enviar mensaje de Whatsapp</p>
											</div>
										</a>
									<!-- End Whatsapp -->
									<!-- Start single service -->
										<div class="mu-single-service my-2">
											<div class="mu-single-service-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">DIRECCIÓN DE EMAIL</h3>
												<p class="text-justify">info@fimeint.org</p>
											</div>
										</div>
									<!-- End single service -->
									<!-- Start single service -->
										<div class="mu-single-service my-2">
											<div class="mu-single-service-icon"><i class="fas fa-share-alt"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">REDES SOCIALES</h3>
												<p class="text-justify">
													<a style="color: #666666" target="_blank" href="https://www.facebook.com/fundacioninstituto.demediacionfime/"><i class="fab fa-facebook-f"></i> Facebook</a>
												</p>
												<p class="text-justify">
													<a style="color: #666666" target="_blank" href="https://www.instagram.com/fime_institutodemediacion/"><i class="fab fa-instagram"></i> fime_institutodemediacion</a>
												</p>
											</div>
										</div>
									<!-- End single service -->
									<!-- Start single service -->
										<div class="mu-single-service my-2">
											<div class="mu-single-service-icon"><i class="far fa-clock"></i></div>
											<div class="mu-single-service-content">
												<h3 class="text-justify">HORARIOS DE ATENCIÓN</h3>
												<p class="text-justify">Lunes a Viernes: 8:30 a 16:30 hs</p>
											</div>
										</div>
									<!-- End single service -->
								</div>
							</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->


		<!-- Google map -->
		<div id="mu-google-map">
			<figure><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.4567322110615!2d-58.98073394637761!3d-27.455036824628152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94450cf0257aa673%3A0xc5862df9f3030cdf!2sFundacion+Instituto+de+Mediacion!5e0!3m2!1ses-419!2sar!4v1557880015521!5m2!1ses-419!2sar" width="100%" height="450" allowfullscreen=""></iframe></figure>
		</div>
@stop