@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe</title>
    {{-- <meta name="description" content="Derka y Vargas Concesionario Oficial Toyota en Chaco. Venta de 0KM, Usados Certificados Toyota, Usados Multimarcas. Servicios de Posventa. Plan de Ahorro 100% financiado"> --}}
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.title-status{
		border-bottom: 3px solid #0091ea;
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
					    <li class="breadcrumb-item active" aria-current="page">Posts</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

	
	<!-- Start main content -->
	<main>
	
		<!-- Start Blog -->
		<section id="mu-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-blog-area">
							<div class="row">
								<div class="col-md-8">
									<div class="mu-blog-left">

										{{-- Filtro por tags --}}
										@if(Request::exists('tag'))
											<div class="row">
												<div class="col-sm-12">
													<div class="mu-tags">
														<span class="mr-2">Filtrado por:</span>
														@foreach(\App\Helpers\Helper::getTags() as $tag)
															@if(Request::get('tag'))
																@if( Request::get('tag') == $tag->slug)
																<a href="{{route('all_posts')}}"><i class="fas fa-times"></i> {{$tag->nombre}}</a>
																@endif
															@endif
														@endforeach
													</div>
												</div>
											</div>
											@foreach( $cursos as $curso )
												<!-- End single item -->
												<article class="mb-4">
													<div class="row d-flex align-items-center" style="">
														<div class="col-md-3 col-sm-12">
															<img src="{{Storage::disk('uploads')->url($curso->foto)}}">
														</div>
														<div class="col-md-9 col-sm-12">
															<h1 style="line-height: 0">
															<a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" style=" color: #323232;
																			    font-size: 20px;
																			    line-height: 1.5;
																			    -webkit-transition: all .5s;
																			    transition: all .5s;">
														    	{{$curso->titulo}}
														    </a>
														    </h1>
														    <p class="text-muted text-justify">{{$curso->descripcion}}</p>
															<a href="{{route('show_post', $curso->slug)}}">Leer más <i class="fas fa-arrow-right"></i></a>				    	
														</div>
													</div>
													<hr>
												</article>
											@endforeach
										@else
											<!-- PROXIMOS CURSOS -->
											@php $proximos = \App\Helpers\CursosHelper::findCursosByStatusProiximo(\App\Curso::ESTADO_PROXIMO) @endphp
											@if(sizeof($proximos) > 0)
												<div class="my-4 title-status">
													<h3 class="font-weight-normal">Inscribite Ahora</h3>
												</div>
												@foreach( $proximos as $curso )
													<article class="mb-4">
														<div class="row d-flex align-items-center" style="">
															<div class="col-md-3 col-sm-12">
																<img src="{{Storage::disk('uploads')->url($curso->foto)}}">
															</div>
															<div class="col-md-9 col-sm-12">
																<h1 style="line-height: 0">
																<a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" style=" color: #323232;
																				    font-size: 20px;
																				    line-height: 1.5;
																				    -webkit-transition: all .5s;
																				    transition: all .5s;">
															    	{{$curso->titulo}}
															    </a>
															    </h1>
															    <p class="text-muted text-justify">{{$curso->descripcion}}</p>
																<a href="{{route('show_post', $curso->slug)}}">Leer más <i class="fas fa-arrow-right"></i></a>				    	
															</div>
														</div>
														<hr>
													</article>
												@endforeach
											@endif

											<!-- EN CURSO -->
											@php $en_curso = \App\Helpers\CursosHelper::findCursosByStatusEnCurso(\App\Curso::ESTADO_EN_CURSO) @endphp
											@if(sizeof($en_curso) > 0)
												<div class="mt-5 mb-4 title-status">
													<h3 class="font-weight-normal">En Curso</h3>
												</div>
												@foreach( $en_curso as $curso )
													<!-- End single item -->
													<article class="mb-4">
														<div class="row d-flex align-items-center" style="">
															<div class="col-md-3 col-sm-12">
																<img src="{{Storage::disk('uploads')->url($curso->foto)}}">
															</div>
															<div class="col-md-9 col-sm-12">
																<h1 style="line-height: 0">
																<a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" style=" color: #323232;
																				    font-size: 20px;
																				    line-height: 1.5;
																				    -webkit-transition: all .5s;
																				    transition: all .5s;">
															    	{{$curso->titulo}}
															    </a>
															    </h1>
															    <p class="text-muted text-justify">{{$curso->descripcion}}</p>
																<a href="{{route('show_post', $curso->slug)}}">Leer más <i class="fas fa-arrow-right"></i></a>				    	
															</div>
														</div>
														<hr>
													</article>
												@endforeach
											@endif

											<!-- FINALIZADOS -->
											@php $finalizados = \App\Helpers\CursosHelper::findCursosByStatusFinalizado(\App\Curso::ESTADO_FINALIZADO) @endphp
											@if(sizeof($finalizados)>0)
												<div class="mt-5 mb-4 title-status">
													<h3 class="font-weight-normal">Finalizados</h3>
												</div>
												@foreach( $finalizados as $curso )
													<!-- End single item -->
													<article class="mb-4">
														<div class="row d-flex align-items-center" style="">
															<div class="col-md-3 col-sm-12">
																<img src="{{Storage::disk('uploads')->url($curso->foto)}}">
															</div>
															<div class="col-md-9 col-sm-12">
																<h1 style="line-height: 0">
																<a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" style=" color: #323232;
																				    font-size: 20px;
																				    line-height: 1.5;
																				    -webkit-transition: all .5s;
																				    transition: all .5s;">
															    	{{$curso->titulo}}
															    </a>
															    </h1>
															    <p class="text-muted text-justify">{{$curso->descripcion}}</p>
																<a href="{{route('show_post', $curso->slug)}}">Leer más <i class="fas fa-arrow-right"></i></a>				    	
															</div>
														</div>
														<hr>
													</article>
												@endforeach
											@endif

											@if(sizeof($proximos)==0 && sizeof($en_curso)==0 && sizeof($finalizados)==0)
											<div class="w-100 px-4 py-5" style="background-color: #f2f2f4">
												<h5 style="color: #648347; font-weight: 400">Por el momento no contamos con Ofertas Académicas o Cursos Vigentes.</h5>
												<p>Ante cualquier consulta no dudes en escribirnos a través de cualquiera de nuestros medios.</p>
												<a class="btn btn-default" href="{{route('contacto')}}">Contacto</a>
											</div>
											@endif
										@endif


										

									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="card box-shadow-1 mt-5">
											  <div class="card-body text-center">
											  	<h4 class="text-dark">Otras Propuestas</h4>
											  	<a class="btn btn-primary mt-2" href="{{route('cursos_otros')}}">VER <i class="fas fa-long-arrow-alt-right"></i></a>
											  </div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mu-blog-sidebar">
										<!-- start Single Widget -->
										@include('sitio.includes.follow-us')
										<!-- End single widget -->

										
										<!-- start Single Widget -->
										@include('sitio.includes.tags')
										<!-- End single widget -->

										<!-- start Single Widget -->
										@include('sitio.includes.subscribe')
										<!-- End single widget -->

									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Blog --> 

	</main>
@stop