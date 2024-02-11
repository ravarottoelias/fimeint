@extends('sitio.layout')

@section('title_and_meta')
    <title>Responsabilidad Social Empresaria</title>
    <meta name="description" content="Desde FIMe estamos comprometidos en la calidad de la educación, para ello trabajamos, en alianza con Todo Sobre Mediación -espacio de Formación virtual- como apoyo de todas nuestras actividades de formación de RRHH, de manera on line.">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.mu-social-media .mu-whatsapp{
		background-color: #65bc54;
	}
	.mu-social-media a{
		font-size:20px;
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
				    <li class="breadcrumb-item active" aria-current="page">Responsabilidad Social Empresaria</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section class="mt-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-blog-left mb-4">
					<div class="mu-title text-left">
						<div class="d-flex align-items-center justify-content-center my-4">
							<img class="img-fluid" style="height: 80px;" src="{{asset('images/icon-only-servicios-min.png')}}">
							<div class="ml-4">
								<h2>RSE</h2>
								<p class="mb-0">Responsabilidad Social Empresaria</p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p class="text-justify">Reconociendo los nuevos roles que tanto las Empresas como la Sociedad Civil tienen en la actualidad, resulta fundamental poder abordar los nuevos desafíos que el mundo globalizado presenta, en miras de lograr el triple impacto esperado: ambiental, social y económico.</p>
				<p class="text-justify">En este contexto, y alineados con la <a target="_blank" href="https://www.un.org/sustainabledevelopment/es/development-agenda/">Agenda 2030 de Naciones Unidas</a>, nos proponemos aunar esfuerzos con empresas y organizaciones públicas y privadas en miras de lograr sumarnos a los Objetivos del Desarrollo Sostenible (ODS) <span class="font-italic text-muted">(1)</span> </p>
				<p class="font-italic text-justify">“Los programas de responsabilidad social empresaria (RSE) se integran cada vez más al corazón del negocio.  En este mundo globalizado ya no se juzga el éxito empresarial sólo con indicadores financieros; los valores intangibles como la reputación, la ética y la responsabilidad son igual de importantes… Las empresas que logren involucrarse en los asuntos y actividades relacionadas con su comunidad serán capaces de demostrar que son un contribuyente responsable con el futuro del desarrollo social. Asimismo, serán capaces de generar confianza y volverse una empresa atractiva para los nuevos talentos y para los clientes. Sólo un nuevo modelo de negocio basado en los principios de los derechos humanos, ética y justicia social puede traernos un futuro sostenible…”<span class="font-italic text-muted">(2)</span></p>
				
				<p class="text-justify">Desde <b>FIMe</b> estamos comprometidos con los O.D.S., para cuyo cumplimiento desarrollamos proyectos tanto con empresas como con otras OSC y de Gobierno alineadas a los mismos.</p>
				<p class="text-justify">Nuestro rol consiste en detectar fuentes de financiamiento, como también determinar necesidades a cubrir, diseñar proyectos, conformar y supervisar a los equipos técnicos de trabajo, articular acciones, administrar los fondos, cumplimentar rendiciones de cuentas …
				Desde hace 22 años estamos involucrados en este tipo de acciones a nivel global. 
				</p>
				<p class="text-justify">Trabajamos en proyectos de pacificación, desarmamentismo y abordaje de conflictos a gran escala y de menor intensidad, como también con proyectos sociales y artístico-culturales locales; nos involucramos con diversas empresas, el Estado, OSC, y otros actores comprometidos con la inclusión y el fortalecimiento de los pueblos.</p>
				<blockquote>
					<p class="font-weight-light"><span class="font-italic text-muted font-weight-light">(1)</span>   Los Objetivos de Desarrollo Sostenible (ODS) constituyen un llamamiento universal a la acción para poner fin a la pobreza, proteger el planeta y mejorar las vidas y las perspectivas de las personas en todo el mundo.</p>
					<p class="font-weight-light"><span class="font-italic text-muted font-weight-light">(2)</span> Palabras del Presidente de Toyota Argentina -Daniel Herrero- en el lanzamiento del Programa Desarrollo RSE de Concesionarios (2018) </p>
				</blockquote>

				<p class="text-justify">Estos objetivos no son posibles de ser logrados solos, resulta fundamental el aporte articulado y el esfuerzo conjunto de los diversos sectores de la comunidad, desde los ámbitos tanto públicos como privados. Y en este sentido estamos alineados.</p>
			</div>
			
		</div>
	</div>
</section>

<section class="my-5">
	<div class="container">
    		<div class="row d-flex justify-content-center">
    			<div class="col-md-10 col-sm-12">
    				<div class="row d-flex align-items-center">
    					<div class="col-md-4 col-sm-12 text-center">
    						<img class="rounded-circle my-3" src="{{asset('images/contact-us-keyboard-3.jpg')}}">
    					</div>
    					<div class="col-md-8 col-sm-12">
    						<div class="text-center text-md-left">
		    					<h4>CONTACTENOS SI DESEA SUMARSE A NUESTRA LABOR</h4>
		    					<p>Comunícate con nosotros a través de cualquiera de nuestros medios.</p>
		    				</div>
			    			<div class="text-center text-md-left mu-social-media">
			    				<ul class="list-inline">
								  <li class="list-inline-item"> <a href="https://api.whatsapp.com/send?phone=543624373386" class="mu-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
								  <li class="list-inline-item"> <a href="https://www.facebook.com/fundacioninstituto.demediacionfime/" class="mu-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								  <li class="list-inline-item"> <a href="https://www.instagram.com/fime_institutodemediacion/" class="mu-instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
									<li class="list-inline-item"> <a href="/contacto" class="mu-google-plus" target="_blank"><i class="far fa-envelope"></i></a></li>
								</ul>
			    			</div>
    					</div>
    				</div>
    			</div>

    		</div>
    	</div>
</section>

{{-- <section>
    <div class="paralax rse my-5">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-8 col-sm-12">
    				<h4>CONTACTENOS SI DESEA SUMARSE A NUESTRA LABOR</h4>
    				<p>Comunícate con nosotros a través de cualquiera de nuestros medios.</p>
    			</div>
    			<div class="col-md-4 col-sm-12 text-center">
    				<a href="/contacto" class="mu-primary-btn">CONTACTO</a>
    				<a class="btn btn-outline-secondary my-2 d-flex justify-content-center align-items-center" href="https://api.whatsapp.com/send?phone=543624373386" style="border-radius: 50px" target="_blank">
						<div class="mu-single-service-icon" style="background-color: #65bc54"><i class="fab fa-whatsapp"></i></div>
						<div class="mu-single-service-content">
							<h3 class="text-justify text-white my-0 py-0">Enviar Whatsapp</h3>
						</div>
					</a>
    			</div>
    		</div>
    	</div>
	</div>
</section> --}}

@stop