@extends('sitio.layout')

@section('title_and_meta')
    <title>Proyectos RSE</title>
    {{-- <meta name="description" content="Derka y Vargas Concesionario Oficial Toyota en Chaco. Venta de 0KM, Usados Certificados Toyota, Usados Multimarcas. Servicios de Posventa. Plan de Ahorro 100% financiado"> --}}
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.owl-rse-poyects{
		margin-top: 15px;
	}
	.owl-rse-poyects .owl-image{
		border-radius: 5px;
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
					    <li class="breadcrumb-item active" aria-current="page">Proyectos RSE</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

	<section id="mu-blog">

		<div class="container">



			<div class="row">
				<div class="col-md-12">

					<div class="mu-blog-area">
						<div class="row d-flex justify-content-center">

							<div class="col-md-10">
								<div class="mu-blog-left">

									@foreach( $posts as $post )

									<article class="mb-4 pr-md-5">
										<div class="row d-flex align-items-center" style="">
											<div class="col-md-3 col-sm-12">
												@php
											 		if ($post->portada != null) {
											 			$src = Storage::disk('uploads')->url($post->portada->path);
											 		}else{ $src = '/images/default.png'; }
											 	@endphp
												<img class="img-fluid rounded" src="{{ $src }}">
											</div>
											<div class="col-md-9 col-sm-12">
												{{-- <span style="font-size: 12px; color: #8d8d8d">{{$curso->created_at->format('d-m-Y')}}</span> --}}
												<h1 style="line-height: 0">
												<a href="{{ route('proyectos_rse_show', $post->slug) }}" style=" color: #323232;
																    font-size: 20px;
																    line-height: 1.5;
																    -webkit-transition: all .5s;
																    transition: all .5s;">
											    	{{$post->titulo}}
											    </a>
											    </h1>
											    <p class="text-muted text-justify">

											    	{{str_limit(strip_tags($post->contenido), 190)}}
											    	
											    </p>
												<a href="{{route('proyectos_rse_show', $post->slug)}}">Leer más <i class="fas fa-arrow-right"></i></a>				    	
											</div>
										</div>
									</article>

									<hr>

									@endforeach

									<div class="w-100 mt-5 text-center">
										<a class="mu-primary-btn mt-5" href="{{route('rse')}}">Más Info <i class="fas fa-arrow-right"></i></a>
									</div>

								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


@stop