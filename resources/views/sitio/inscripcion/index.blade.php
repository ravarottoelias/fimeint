@extends('sitio.layout')

@section('title_and_meta')
    <title>Inscripción</title>
    <meta name="description" content="Inscripción">
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
				    <li class="breadcrumb-item"><a href="/">Oferta Académica</a></li>
				    <li class="breadcrumb-item"><a href="/">{{ $curso->titulo }}</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Inscripción</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="mu-blog-left">
				 
				 	@include('sitio.includes.flash-message')	

					@php
						$esPreInscripcion = $curso->unit_price < 1 ? true : false;
					@endphp

				 	@if( $curso->permitir_inscripcion == 1 )
						<div class="container-stepwizard" id="container-stepwizard">
							<div class="wizard-header text-center mx-3">
								<h4 class="heading">{{ $curso->titulo }}</h4>
								<p class="">{{ $curso->descripcion }}</p>
							</div>							

							<div class="stepwizard">
								<div class="stepwizard-row py-3">
									<div class="stepwizard-step">
										<button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
										<p class="d-none d-sm-block">Cuenta</p>
									</div>
									{{-- ACTIVO --}}
									<div class="stepwizard-step">
										<button type="button" class="btn btn-primary btn-circle"><i class="fas fa-pencil-alt"></i></button>
										<p class="text-dark d-none d-sm-block">
											@if ($esPreInscripcion)
												Pre Inscripción
												@else
												Inscripción
											@endif
										</p>
									</div>
									<div class="stepwizard-step">
										<button type="button" class="btn btn-default btn-circle"><i class="fas fa-money-check-alt"></i></button>
										<p class="d-none d-sm-block">Pago</p>
									</div>
									<div class="stepwizard-step">
										<button type="button" class="btn btn-default btn-circle"><i class="fas fa-check"></i></button>
										<p class="d-none d-sm-block">Hecho</p>
									</div>  
								</div>

								<div class="stepwizard-contenido d-flex justify-content-center">
									<div class="col-sm-12 col-md-8">
										<form method="POST" action="{{ route('crear_inscripcion') }}">
											{{ csrf_field() }}
											<input type="hidden" name="curso_id" value="{{$curso->id}}">
											<div class="form-group">
												<div class="row my-3">
													<div class="col text-center">
														<h5 class="font-weight-normal">¿Cómo te enteraste del curso?</h5>
													</div>
												</div>
												<div class="row my-3 justify-content-center">
													<div class="col-6 col-md-4">
														<div class="form-check ml-4">
															<input class="form-check-input" id="facebook-option" type="radio" name="canal" value="facebook" required>
															<label class="form-check-label" for="facebook-option">
																Facebook 
															</label>
														</div>
														<div class="form-check ml-4">
															<input class="form-check-input" id="instagram-option" type="radio" name="canal" value="instagram">
															<label class="form-check-label" for="instagram-option">
																Instagram
															</label>
														</div>
															<div class="form-check ml-4">
															<input class="form-check-input" id="email-option" type="radio" name="canal" value="email">
															<label class="form-check-label" for="email-option">
																Email
															</label>
														</div>
														<div class="form-check ml-4">
															<input class="form-check-input" id="iadef-option" type="radio" name="canal" value="iadef">
															<label class="form-check-label" for="iadef-option">
																IADEF
															</label>
														</div>
														<div class="form-check ml-4">
														<input class="form-check-input" id="whatsapp-option" type="radio" name="canal" value="whatsapp">
														<label class="form-check-label" for="whatsapp-option">
															Whatsapp
														</label>
														</div>
														<div class="form-check ml-4">
														<input class="form-check-input" id="otro-option" type="radio" name="canal" value="otro">
														<label class="form-check-label" for="otro-option">
															Otro
														</label>
														</div>
													</div>
												</div>
											</div>
											<div class="w-100 my-5 my-md-4 d-flex justify-content-center">
												<button type="submit" class="mu-primary-btn font-weight-normal"><i class="fas fa-pencil-alt"></i> 
													@if ($esPreInscripcion)
													Pre Inscribirme
													@else
													Inscribirme
												@endif</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>		
					@endif

				</div>
			</div>
		</div>
	</div>
</section>


@stop
