@extends('sitio.layout')

@section('title_and_meta')
    <title>{{ $curso->titulo }}</title>
    <meta name="description" content="Oferta Académica. {{ $curso->titulo }}">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
	<link rel="stylesheet" href="{{asset('css/course-single.css')}}" />	
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
					    <li class="breadcrumb-item"><a href="{{route('all_posts')}}?categoria={{$curso->categoria->slug}}">{{$curso->categoria->nombre}}</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{$curso->titulo}}</li>
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
						<div class="row">
							<div class="col-md-8">
								<div class="mu-blog-left">
									<!-- start single item -->
									<article class="mb-5 mb-md-0">

										<img class="w-100" src="{{Storage::disk('uploads')->url($curso->foto)}}" alt="blgo image">

										<div class="mu-blog-item-content">
											<h1 class="mu-blog-item-title">{{$curso->titulo}}</h1>
											
											<ul class="mu-blog-meta">
												@if($curso->lugar)
												<li class="text-muted"><i class="fas fa-map-marker-alt"></i> {{$curso->lugar}}</li>
												@endif
												<li class="text-muted"><i class="far fa-calendar-alt"></i> Publicado {{$curso->created_at->diffForHumans()}}</li>
											</ul>

											<p>{{$curso->descripcion}}</p>

											<div class="contenido-del-post">
												{!! $curso->contenido !!}
											</div>
											
											<!-- ARCHIVOS ADJUNTOS -->
											@if(sizeof($curso->files)>0)
												<div class="mu-files my-4">
													<h5><i class="fas fa-paperclip"></i> Archivos Adjuntos</h5>
													<hr>
													<div class="row">
														@foreach($curso->files as $file)
															<div class="col-md-4 ">
																<a href="{{Storage::disk('uploads')->url($file->path)}}" class="box-shadow-1 border d-flex file-adjunto" download>
																	<div class="w-25 file-type">
																		@switch($file->extension)
																			@case('pdf')
																				<i class="far fa-file-pdf"></i>
																			@break

																			@case('doc' || 'docx')
																				<i class="far fa-file-word"></i>
																			@break

																			@case('png' || 'jpg' || 'jpeg')
																				<i class="far fa-image"></i>
																			@break

																			@default
																				<i class="fal fa-file"></i>
																		@endswitch
																	</div>
																	<div class="w-75 file-name text-muted">
																		{{ strlen($file->name>14) ? substr($file->name, 0, 15).'...' : $file->name}}
																	</div>
																</a>
															</div>
														@endforeach
													</div>
												</div>
											@endif
											
										</div>

										@include('sitio.cursos.inscription-payment-actions')

									</article>

								</div>
							</div>
							<div class="col-md-4">
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
				</div>
			</div>
		</div>
	</section>
	<!-- End Blog --> 
@stop

@section('script')
	<script type="text/javascript">
		//Manejar el focus del login
		@if($errors->has('email'))
			$('.login-alumno input[name="email"]').focus()
		@endif

		@if($errors->has('password'))
			$('.login-alumno input[name="password"]').focus()
		@endif

	</script>
@stop