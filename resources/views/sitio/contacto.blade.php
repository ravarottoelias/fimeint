@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe</title>
    {{-- <meta name="description" content=""> --}}
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
							<div class="row ">
								<div class="col-md-4"></div>
								<div class="col-md-4 col-xs-12 px-3 py-3">
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
								<div class="col-md-4"></div>
							</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->
@stop