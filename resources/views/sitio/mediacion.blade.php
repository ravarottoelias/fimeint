@extends('sitio.layout')

@section('title_and_meta')
    <title>Mediación</title>
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
				    <li class="breadcrumb-item active" aria-current="page">Mediacón</li>
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

		<div class="row">
			<div class="col-md-12">
				<h3>Concepto de Mediación</h3>
				<p>En general podemos decir que es un procedimiento en el cual, las partes, ayudadas por un tercero que no tiene facultades de decisión, intentan resolver un conflicto. “La mediación es un proceso negocial que con dirección de un tercero neutral, que no tiene autoridad decisional, busca soluciones de recíproca satisfacción subjetiva y de común ventaja objetiva para las partes, a partir del control e intercambio de la información, favoreciendo el comportamiento colaborativo de las mismas” (1). “El dispositivo d ela mediación otorga la palabra a los sujetos que padecen y el mediador escucha, desde una posición neutral, sus relatos (verdades que en tanto sujetos se constituyen en verdades subjetivas) para evaluar (éste es el saber del medidor) si podrán diseñar estrategias consensuadas y conseguir aquello que dicen necesitar y acompañarlos en este procesos sosteniendo su conflicto.(2).Características de la Mediación:</p>
					<p> - Voluntariedad.</p>	
					<p> - Confidencialidad</p>	
					<p> - Autocomposición</p>	
					<p> - Cooperación</p>	
					<p> - Acento en el futuro.</p>	
					<p> - Informal pero con estructura.</p>	
					<p> - Economía de tiempo, esfuerzos y dinero</p>	
					<p> - Se puede lograr acuerdos que van más allá de la disputa inicial</p>	
					<p> - Mejor índice de cumplimiento de los acuerdos.</p>	
					<p> - No se pierden derechos.</p>	
			</div>
		</div>

	   <blockquote class="blockquote">
	      <p class="mb-0">(1) La Ley: Suplemento de Resolución de Conflictos</p>
	      <footer class="blockquote-footer">Calcaterra Rubén R. <cite title="Source Title">Bs.As. 16-12-96-pág.11</cite></footer>
	   </blockquote>
	   <blockquote class="blockquote">
	      <p class="mb-0">(2) Aréchaga, Brandoni y Finkelstein, Acerca de la Clínica de la Mediación.</p>
	      <footer class="blockquote-footer">LIB. Histórica</footer>
	   </blockquote>
	</div>
</section> --}}


@stop