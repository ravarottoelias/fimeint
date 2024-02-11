@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe</title>
    {{-- <meta name="description" content="Derka y Vargas Concesionario Oficial Toyota en Chaco. Venta de 0KM, Usados Certificados Toyota, Usados Multimarcas. Servicios de Posventa. Plan de Ahorro 100% financiado"> --}}
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	#mu-hero{
	    -webkit-box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08), 0 0 6px rgba(0, 0, 0, 0.05);
    	box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08), 0 0 6px rgba(0, 0, 0, 0.05);
    	margin-bottom: 10px;
	}
	.slick-list {
		padding-bottom: 10px;
	}
	.video-responsive {
    height: 0;
    overflow: hidden;
    padding-bottom: 56.25%;
    padding-top: 30px;
    position: relative;
    }
.video-responsive iframe, .video-responsive object, .video-responsive embed {
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    }
</style>
@stop


@section('content')
	<!-- Start slider Ppal -->
	@include('sitio.includes.slide-ppal')
	<!-- End slider Ppal -->

	
	<!-- Start main content -->
	<main>
	 	{{-- Start Services  --}}
		<section id="mu-service">
			<div class="container">
				<div class="row d-flex justify-content-center mt-3">
					<div class="col-md-11">
						<div class="mu-service-area">
							<div class="row d-flex justify-content-center icons-services">
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('quienes_somos')}}#quines-somos">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-quienes-somos-min.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('servicios')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-servicios-min.png')}}">
									</a>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('rse')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-rse.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('consultoria_pymes_familiares')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-consultoria-min.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('aula_virtual')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-aulavirtual-min.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('all_posts')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-capacitaciones-min.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('cursos_homologados')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-cursoshomologados-min.png')}}">
									</a>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 icon">
									<a href="{{route('alianza')}}">
										<img class="img-fluid hvr-pop" src="{{asset('/images/icono-alianza-min.png')}}">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


	
		<!-- Start from blog -->
		<section id="mu-from-blog">
			@include('sitio.includes.recent-posts')
		</section>
		<!-- End from blog -->

		{{-- <section id="social-media my-4 py-4">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="fb-page" 
						     data-href="https://www.facebook.com/fundacioninstituto.demediacionfime/" 
						     data-tabs="timeline" 
						     data-width="500" 
						     data-height="" 
						     data-small-header="false" 
						     data-adapt-container-width="true" 
						     data-hide-cover="false" 
						     data-show-facepile="true">
						     <blockquote cite="https://www.facebook.com/fundacioninstituto.demediacionfime/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/fundacioninstituto.demediacionfime/">Fundación Instituto de Mediación</a></blockquote>
						 </div>
					</div>
					<div class="col-md-6 col-sm-12">
						@php $count = 0 @endphp
						@foreach(\App\Helpers\Helper::getRecentPostInstagram()->data as $post)
							@if ($count == 9) @break @endif
							@php $count++ @endphp
							<a class="group" href="{{$post->link}}"target="_blank"><img src="{{ $post->images->thumbnail->url }}" alt="{{$post->caption->text}}"></a>
						@endforeach
					</div>
				</div>
			</div>
		</section> --}}

		<!-- Call to Action -->
<!-- 		<div id="mu-call-to-action">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-call-to-action-area">
							<div class="mu-call-to-action-left">
								<h2>This is a simple hero unit, a simple jumbotron-style</h2>
								<p>component for calling extra attention to featured content or information.</p>
							</div>
							<a href="#" class="mu-primary-btn mu-quote-btn">Get a Quote <i class="fa fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</main>
	
	<!-- End main content -->

	<!-- Start galeria-videos -->
	<section id="mu-portfolio">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-portfolio-area">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>Expositores del Seminario Internacional</h2>
										<p>Los MARC y la mediación en tiempos de crisis.</p>
									</div>
								</div>
							</div>

							<div class="row">
									<!-- Start Portfolio Content -->
									<div class="mu-portfolio-content">
										<div class="row filtr-container">

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="4">
							                   	<div class="video-responsive">
							                   		<iframe src="https://www.youtube.com/embed/17WDhE1xPSI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="5">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/GGiGOQBAPhM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="3">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/jRWTQXukCGg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/IjO-AEwxApM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="2">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/_7xS9YX7M8g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="5">
							                   <div class="video-responsive">
							                   	<iframe src="https://www.youtube.com/embed/UJBtYPaORbs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							              	  </div>
							                </div>

							                <div class="col-xs-12 col-sm-12 col-md-12 text-center" data-category="5">
							                	<a href="{{route('galeria_videos')}}" class="btn btn-primary ">
												    Mostrar todos
											  	</a>
											</div>
							            </div>
									</div>
									<!-- End Portfolio Content -->
								</div>
							
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End galeria-videos -->
@stop