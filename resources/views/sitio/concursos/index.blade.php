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

<section id="mu-blog" class="mt-0">
	<div class="container_">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-blog-left">

					<!-- Start Blog -->
					<section id="mu-blog" class="mu-blog-single">
						<div class="container_">
							<div class="row">
								<div class="col-md-12">
									<div class="">
										<!-- Title -->
										<div class="row">
											<div class="col-md-12">
												<div class="mu-blog-left">
													@forelse ($concursos as $concurso)
														@include('sitio.concursos.show-content', [ "concurso" => $concurso ])
													@empty
														<div class="alert alert-info" role="alert">Por el momento no tenemos concursos abiertos.</div>
													@endforelse
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- End Blog --> 
				</div>
			</div>
		</div>
	</div>
</section>


@stop