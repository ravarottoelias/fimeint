@extends('sitio.layout')

@section('title_and_meta')
    <title>Nuestros Servicios</title>
    <meta name="description" content="-	Conciliación, Mediación, Negociación y Arbitraje. -	Capacitación y Formación de Recursos Humanos presencial, on line y off line">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.mu-single-service-icon {
	    background-color: #b264a3;
	    border-radius: 50%;
	    color: #fff;
	    display: inline;
	    font-size: 17px;
	    float: left;
	    min-height: 35px;
	    min-width: 35px;
	    max-width: 35px;
	    text-align: center;
	    line-height: 35px;
	    max-height: 35px;
	}
	.item-service{
		margin-bottom: 1.5rem;
	}

	.item-service-content p{
		text-align: justify;
	}
	.item-service-content{
		margin-left: 80px;
	}
	.item-service-content{
		font-size: 19px;
		font-weight: 400;
	}
	.a-service{
		font-weight: 400;
    	font-size: 19px;
	}
</style>
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
				    <li class="breadcrumb-item active" aria-current="page">Servicios</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="" class="mt-3">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10 col-sm-11">

				<div class="d-flex align-items-center justify-content-center my-4">
					<img class="img-fluid" style="height: 80px;" src="{{asset('images/icon-only-servicios-min.png')}}">
					<div class="ml-4">
						<h2>Servicios</h2>
						<p class="mb-0">Conoce nuestros servicios profesionales</p>
					</div>
				</div>
					
				<div class="py-4">
					<div class="item-service">
						<div class="mb-2 d-flex align-items-center">
							<div class="mu-single-service-icon">
								<i class="fas fa-check text-white"></i>	
							</div>
							<h5 class="a-service mb-0">
								Conciliación, Mediación, Negociación y Arbitraje.
							</h5>
						</div>
					</div>

					<div class="item-service">
						<div class="mb-2 d-flex align-items-center">
							<div class="mu-single-service-icon">
								<i class="fas fa-check text-white"></i>	
							</div>
							<h5 class="a-service mb-0">
								Capacitación y Formación de Recursos Humanos (presencial, on line y off line).
							</h5>
						</div>
						<div class="item-service-content">
							<p><i class="fas fa-check text-muted"></i> Llevamos a cabo actividades de capacitación (cursos, talleres, foros, seminarios, diplomados) en las diferentes áreas en que la Institución está involucrada, en los ámbitos tanto formal como informal de la educación.</p>
							<p><i class="fas fa-check text-muted"></i> Desarrollamos capacitación “in-company”, diseñada según las necesidades e intereses de los capacitados.</p>
						</div>
					</div>

					<div class="item-service">
						<div class="mb-2 d-flex align-items-center">
							<div class="mu-single-service-icon">
								<i class="fas fa-check text-white"></i>	
							</div>
							<h5 class="a-service mb-0">
								Asesoramiento a instituciones públicas y privadas, nacionales y extranjeras, particulares.
							</h5>
						</div>
						<div class="item-service-content">
							<p><i class="fas fa-check text-muted"></i> Brindamos asesoramiento en temáticas y procesos de abordaje cooperativo y consensuado de conflictos.</p>
						</div>
					</div>

					<div class="item-service">
						<div class="mb-2 d-flex align-items-center">
							<div class="mu-single-service-icon">
								<i class="fas fa-check text-white"></i>	
							</div>
							<h5 class="a-service mb-0">
								Consultoría a Pymes Familiares.
							</h5>
						</div>
						<div class="item-service-content">
							<a class="ml-2 card-link" href="{{route('consultoria_pymes_familiares')}}"> Leer más <i class="fas fa-arrow-right"></i></a>
						</div>
					</div>

					<div class="item-service">
						<div class="mb-2 d-flex align-items-center d-flex">
							<div class="mu-single-service-icon">
								<i class="fas fa-check text-white"></i>	
							</div>
							<h5 class="a-service mb-0">
								RSE: Responsabilidad Social y Responsabilidad Social Empresaria.
							</h5>
						</div>
						<div class="item-service-content">
							<a class="ml-2 card-link" href="{{route('rse')}}"> Leer más <i class="fas fa-arrow-right"></i></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

@include('sitio.includes.contact-us')

@stop