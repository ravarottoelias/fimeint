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
				    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Empresa de Familia</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog">
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
	
	{{-- <div class="container">
		<div class="row">
			<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="mu-about-area">
								<div class="row">
									<div class="col-md-6">
										<div class="mu-about-left">
											<img class="" src="{{asset('images/about-us.jpg') }}" alt="img">
										</div>
									</div>
									<div class="col-md-6">
										<div class="mu-about-right py-2">
											<h1>Brindamos soluciones para tu empresa familiar.</h1>
											<h2 class="py-2">Contactanos y te asesoramos</h2>
											<p class="py-2" style="font-size: 16px">Ofrecemos los mejores contenidos y programas de formación, para que las familias empresarias tengan recursos e ideas que las permitan crear estructuras de gobierno fuertes y resistentes al paso del tiempo.</p>
										</div>
										<ul class="list-inline ml-0">
										  <li class="list-inline-item">
											<a href="https://wa.me/5493624373386" target="_blank" class="btn btn-lg btn-whatsapp "><i class="fab fa-whatsapp"></i> Enviar Whatsapp</a>
										  </li>
										  <li class="list-inline-item my-3">
											<a href="/contacto" class="btn btn-secondary btn-lg active"> Contacto</a>
										  </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="mu-about-area">
					<!-- Start Feature Content -->
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-3">
							<div class=" text-center">
								<img class="mu-rt-img" src="{{ asset('images/thumbnail_lilian.png') }}" style="height: auto !important">
							</div>
						</div>
						<div class="col-md-5">
							<div class="mu-about-right py-2 text-md-left text-center">
								<h2>Lilian Edith Vargas</h2>
								<h5 class="text-muted py-2">Directora de la Delegación Chaco del IADEF</h5>
								<p class="py-2" style="font-size: 16px">El Instituto Argentino de la Empresa Familiar – IADEF – fundado en 2010 es una asociación civil sin fines de lucro comprometida con la Empresa Familiar Argentina generadora de riqueza, empleo y cultura en el país.</p>
							</div>
								<a href="http://www.iadef.org/" target="_blank">
									<img src="{{asset('images/logoiadef.jpg')}}">
								</a>
						</div>
					</div>
					<!-- End Feature Content -->
				</div>
			</div>
		</div>
	</div> --}}
</section>


@stop