@extends('sitio.layout')

@section('title_and_meta')
    <title>Aula Virtual</title>
    <meta name="description" content="Aula Virtual. Desde FIMe estamos comprometidos en la calidad de la educación, para ello trabajamos, en alianza con Todo Sobre Mediación -espacio de Formación virtual- como apoyo de todas nuestras actividades de formación de RRHH, de manera on line.">
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
				    <li class="breadcrumb-item active" aria-current="page">Aula Virtual</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="my-4">
					<div class="d-flex align-items-center justify-content-center">
						<img class="img-fluid w-25" src="{{asset('images/logo-alianza.jpg')}}">
						<div class="w-50 ml-4">
							<h2>Aula Virtual</h2>
							<p>Fundación Instituto de Mediación y Portal Todo Sobre Mediación</p>
						</div>
					</div>
				</div>
				<img class="img-fluid mb-5" src="{{asset('images/portada-aula-virtual.jpg')}}">
				<div class="mb-4">	
					<p class="text-justify">Desde <b>FIMe</b> estamos comprometidos en la calidad de la educación, para ello trabajamos, en alianza con Todo Sobre Mediación -espacio de Formación virtual- como apoyo de todas nuestras actividades de formación de RRHH, de manera on line.</p>
					<div class="my-5">
						<a class="mu-primary-btn" href="https://www.todosobremediacion.com.ar/aula-virtual/" target="_blank">Ir al Aula Virtual <i class="fas fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="mu-blog-sidebar">
					<!-- start Single Widget -->
					@include('sitio.includes.follow-us')

					<div class="mu-sidebar-widget">
						<!-- start Single Widget -->
						@include('sitio.includes.recent-posts-side-rigth')
					</div>
					<!-- start Single Widget -->
					@include('sitio.includes.subscribe')
				</div>
			</div>
		</div>
	</div>
</section>


@stop