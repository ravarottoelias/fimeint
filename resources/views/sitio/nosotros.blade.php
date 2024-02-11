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
					    <li class="breadcrumb-item active" aria-current="page">Quiénes Somos</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

	<!-- Start main content -->
	<main>
		<div class="container mt-4 py-5">
			<div class="row mt-5">
				<div class="col-md-12 col-sm-12">
					<div class="jumbotron">
					  <h1 class="display-4"><i class="fas fa-exclamation-circle"></i> Sitio web en mantenimiento</h1>
					  <p class="lead">El sitio web se encuentra en mantenimiento disculpe las molestias. </p>
					  <hr class="my-4">
					  <p>Ante cualquier duda o consulta puede comunicarse con nosotros a través de cualquiera de nuestros medios.</p>
					  <a class="btn btn-primary btn-lg" href="/contacto" role="button">Contacto</a>
					</div>
				</div>
			</div>
		</div>
		
		

		<!-- Start Team -->
		{{-- <section id="mu-team">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-team-area">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>CONOCE AL EQUIPO</h2>
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa cum sociis.</p>
									</div>
								</div>
							</div>
							<!-- Start Team Content -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-team-content">
										<div class="row">
											<!-- start single item -->
											<div class="col-md-6">
												<div class="mu-single-team">
													<div class="mu-single-team-img">
														<img src="{{asset('images/lilian.png')}}" alt="img">
													</div>
													<div class="mu-single-team-content">
														<h3>VARGAS LILIAN EDITH</h3>
														<h5 class="my-1">Cargo..</h5>
														<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
														<span class="bg-color-gmail" href="#">
															<i class="far fa-envelope"></i>
														</span>
														<label>info@fimeint.org</label>
													</div>
												</div>
											</div>
											<!-- End single item -->
											<!-- start single item -->
											<div class="col-md-6">
												<div class="mu-single-team">
													<div class="mu-single-team-img">
														<img src="{{asset('images/daniel.jpg')}}" alt="img">
													</div>
													<div class="mu-single-team-content">
														<h3>MARTINEZ ZAMPA, DANIEL</h3>
														<h5 class="my-1">Cargo..</h5>
														<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
														<span class="bg-color-gmail" href="#">
															<i class="far fa-envelope"></i>
														</span>
														<label>dmartinezzampa@gmail.com </label>
													</div>
												</div>
											</div>
											<!-- End single item -->
											<!-- start single item -->
											<div class="col-md-6">
												<div class="mu-single-team">
													<div class="mu-single-team-img">
														<img src="{{asset('images/emilio.jpeg')}}" alt="img">
													</div>
													<div class="mu-single-team-content">
														<h3>DEL RIO VICTOR EMILIO</h3>
														<h5 class="my-1">Cargo..</h5>
														<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
														<span class="bg-color-gmail" href="#">
															<i class="far fa-envelope"></i>
														</span>
														<label>email@fime.org</label>
													</div>
												</div>
											</div>
											<!-- End single item -->
											<!-- start single item -->
											<div class="col-md-6">
												<div class="mu-single-team">
													<div class="mu-single-team-img">
														<img src="{{asset('images/cristina.jpeg')}}" alt="img">
													</div>
													<div class="mu-single-team-content">
														<h3>SEBA SONIA CRISTINA</h3>
														<h5 class="my-1">Cargo..</h5>
														<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
														<span class="bg-color-gmail" href="#">
															<i class="far fa-envelope"></i>
														</span>
														<label>email@fime.org</label>
													</div>
												</div>
											</div>
											<!-- End single item -->
										</div>
									</div>
								</div>
							</div>
							<!-- End Team Content -->
						</div>
					</div>
				</div>
			</div>
		</section> --}}
		<!-- End Team -->
	</main>
	
@stop