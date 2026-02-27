@extends('sitio.layout')

@section('title_and_meta')
    <title>Concursos</title>
    <meta name="description" content="Concurso">
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
				    <li class="breadcrumb-item active" aria-current="page">Concurso</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog" class="mt-2">
	<div class="container-fluid">
		<div class="row">
			@forelse ($concursos as $concurso)
				<div class="col-12">
					<div class="row justify-content-md-center">
						<div class="col-12 col-md-10 col-lg-10">
							    @php
								$portadaWeb = $concurso->portadas->first();
								if ($portadaWeb != null) {
									$srcWeb = Storage::disk('uploads')->url($portadaWeb->path);
								}else{ $srcWeb = '/images/default.png'; }

								$portadaMobile = $concurso->portadas->slice(1, 1)->first();
											if ($portadaMobile != null) {
												$srcMobile = Storage::disk('uploads')->url($portadaMobile->path);
											}else{ $srcMobile = '/images/default.png'; }
							@endphp

							<img class="img-fluid d-none d-sm-block d-md-block" src="{{ $srcWeb }}">
							<img class="img-fluid d-block d-sm-none" src="{{ $srcMobile }}">

							<h1 class="">{{$concurso->titulo}}</h1>
							<p>
								<i class="far fa-calendar-alt"></i> Publicado {{$concurso->created_at->diffForHumans()}} / 
								@switch($concurso->status)

									@case(\App\Post::ESTADO_EN_CURSO)
										<span class="badge badge-primary">
											{{ $concurso->status }}
										</span>
										@break

									@case(\App\Post::ESTADO_FINALIZADO)
										<span class="badge badge-dark">
											{{ $concurso->status }}
										</span>
										@break

									@default
										<span class="badge badge-dark">
											{{ $concurso->status }}
										</span>

								@endswitch
							</p>
							
							<a class="mu-primary-btn" href="{{ route('concursos_show', $concurso->slug) }}">Leer más</a>

							<hr>
					</div>	
				</div>
				@if(request()->query('status') === 'En Curso')
					<div class="col-12 text-center">
						<a class="mu-primary-btn" href="{{route('concursos', ['status' => 'Finalizado'])}}">Ediciones anteriores <i class="fas fa-arrow-right"></i></a>
					</div>
				@endif
			@empty
				<div class="alert alert-info" role="alert">Por el momento no tenemos concursos abiertos.</div>
			@endforelse
		</div>
	</div>
</section>


@stop