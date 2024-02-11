@extends('sitio.layout')

@section('title_and_meta')
    <title>Arbitraje</title>
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
				    <li class="breadcrumb-item active" aria-current="page">Arbitraje</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

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

{{-- <section id="mu-blog">
	<div class="container">
		@include('sitio.includes.section-get-service')
		<h3>Arbitraje</h3>
		<p>El arbitraje es un procedimiento por el cual se somete una controversa por acuerdo de las partes, a un árbitro o a un tribunal de varios árbitros que dicta una decisión sobre la controversia que es obligatoria para las partes. Al escoger el arbitraje, las partes optan por un procedimiento privado de solución de controversias en lugar de acudir ante los tribunales.(1)</p>
		<p>Las características principales del arbitraje son:</p>
		<p> <b>-</b> Las partes deben acordar ir al arbitraje.</p>
		<p> <b>-</b> Las partes seleccionan al árbitro o árbitros</p>
		<p> <b>-</b> El arbitraje es neutral</p>
		<p> <b>-</b> El arbitraje es un procedimiento confidencial</p>
		<p> <b>-</b> La decisión del tribunal arbitral es definitiva y fácil de ejecutar</p>
	</div>
</section> --}}


@stop