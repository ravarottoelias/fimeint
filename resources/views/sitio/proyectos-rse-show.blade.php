@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe</title>
    <meta name="description" content="Proyectos RSE FIMe">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.owl-carousel .owl-nav{
		display: flex;
		justify-content: center;
	}
	.owl-carousel .owl-nav .owl-next, 
	.owl-carousel .owl-nav .owl-prev {
	    height: 50px;
	    width: 40px;
	    background-color: #0091ea !important;
	    cursor: pointer;
	    border-radius: 0;
	    margin: 10px 15px;
	}
	.owl-carousel .owl-nav .owl-prev i, 
	.owl-carousel .owl-nav .owl-next i{
		color: white
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
					    <li class="breadcrumb-item">
					    	<a href="{{route('proyectos_rse')}}">
					    		Proyectos {{$post->categoria->nombre}}
					    	</a>
					    </li>
					    <li class="breadcrumb-item active" aria-current="page">{{$post->titulo}}</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

	<!-- Start Blog -->
	<section id="mu-blog" class="mu-blog-single">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mu-blog-area">
						<!-- Title -->
						<div class="row d-flex justify-content-center">
							<div class="col-md-8">
								<div class="mu-blog-left">

									<!-- start single item -->
									<article class="mu-blog-item">
										
										<div class="owl-carousel owl-rse-poyects mb-5"></div>

										<div class="mu-blog-item-content mb-4">
											<h1 class="mu-blog-item-title">{{$post->titulo}}</h1>
											<ul class="mu-blog-meta">
												<li class="text-muted"><i class="far fa-calendar-alt"></i> Publicado {{$post->created_at->diffForHumans()}}</li>
											</ul>
											<p>{{$post->descripcion}}</p>
											<div class="contenido-del-post">
												{!! $post->contenido !!}
											</div>
										</div>
									</article>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@stop

@section('script')
<script type="text/javascript">

	var slides = document.getElementsByClassName("img-slide");

	for (var i = 0; i < slides.length; i++) {
	    let item = `<div class="item">
				 <img class="owl-image img-fluid" src="${slides.item(i).src}">
			</div>`;

		$('.owl-carousel').append(item)
	}

	$('.owl-carousel').owlCarousel({
	    stagePadding: 50,
	    loop:true,
	    margin:20,
	    nav:true,
	    navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:2
	        }
	    }
	})
</script>
@stop
