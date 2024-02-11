@extends('sitio.layout')

@section('title_and_meta')
    <title>Alianza Fundación Instituto de Mediación y Portal Todo Sobre Mediación</title>
    <meta name="description" content="Alianza Fundación Instituto de Mediación y Portal Todo Sobre Mediación">
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
				    <li class="breadcrumb-item active" aria-current="page">Alianza</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog" class="mt-3">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="mu-blog-left">
					<div class="d-flex align-items-center justify-content-center mb-4">
						<img class="img-fluid w-25" src="{{asset('images/logo-alianza.jpg')}}">
						<div class="w-50 ml-4">
							<h2>Alianza</h2>
							<p>Fundación Instituto de Mediación y Portal Todo Sobre Mediación</p>
						</div>
					</div>
					
					<p class="text-justify">La Fundacion <b>INSTITUTO DE MEDIACIÓN (FIMe)</b> y el Portal <a target="_blank" title="Portal Todo Sobre Mediación" class="font-weight-bold hover-text-decoration" href="https://www.todosobremediacion.com.ar/"><span class="text-dark">TODO SOBRE MEDIACION (TSM)</span> <i class="external-link fas fa-external-link-alt"></i></a> han concretado una ALIANZA ESTRATEGICA con el fin de promover y consolidar la mediación y los procesos de gestión adecuada de conflictos en la región y a nivel global. </p>
					<p class="text-justify">Esta Alianza formal, es el resultado de muchas actividades ejecutadas en conjunto entre ambas organizaciones desde hace ya varios años.</p>
					<p class="text-justify">FIMe es la  Primera Institución Privada de formación y Primer Centro Privado de Mediación del Chaco, que desde 1995 viene desarrollando acciones en pro de la difusión e implementación de los métodos adecuados de Resolución de conflictos en diversos contextos, no solamente en la región, sino también a nivel Global. Está presidida actualmente por LILIAN VARGAS, quien es además la Coordinadora Académica de la institución</p>
					<p class="text-justify">TSM, portal nacido en el año 2000, dedicado primero a la mediación educativa y luego a la difusión de trabajos, videos, experiencias y bibliografía sobre los procesos de Gestión de conflictos en los diferentes ámbitos, está coordinado por  DANIEL MARTÍNEZ ZAMPA, quien es además el responsable del Aula Virtual y Capacitación on line con FIMe. </p>
					<p class="text-justify">FIMe, desde su relevante experiencia y presencia en el medio, con importante trayectoria en formación, servicios de asesoría, resolución adecuada de conflictos y facilitación de procesos de toma de decisiones en diversos contextos, y TSM, como espacio de consulta con el aporte de experiencias de profesionales de diversos países, parten de la premisa que el conocimiento es el único bien que se enriquece y aumenta a medida que lo compartimos, estando ambas organizaciones abiertas para que los interesados puedan compartir ideas, experiencias, dudas e inquietudes sobre la temática. </p>
					<p class="text-justify">En este sentido, esta alianza busca consolidar espacios de formación, asesoría  y servicios de mediación y consultoría con reflexiones e ideas que ayuden a crecer y consolidar los marcos teóricos que sustenten el trabajo de los procesos RAD en los diferentes medios.</p>

				</div>
			</div>
		</div>
	</div>
</section>


@stop