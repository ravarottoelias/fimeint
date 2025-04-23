@extends('sitio.layout')

@section('title_and_meta')
    <title>FIMe Autogestión</title>
    <meta name="description" content="FIMe Autogestión. Gestión de certificados. Guía de ayuda.">
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
					    <li class="breadcrumb-item active" aria-current="page">Autogestión</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumb -->

		<!-- Start Contact -->
		<section id="mu-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-contact-area py-4">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>AUTOGESTIÓN</h2>
										<p>Esta sección proporciona recursos para facilitar la autogestión de los usuarios.
											Se incluyen guías paso a paso para la recuperación de credenciales de acceso, obtención de certificados digitales y otros procesos.</p>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<div class="accordion" id="accordionExample">
										<div class="card">
										  <div class="card-header" id="headingOne">
											<h2 class="mb-0">
											  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												DESCARGA DE CERTIFICADOS
											  </button>
											</h2>
										  </div>
									  
										  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
											<div class="card-body">
												<a href="https://fimeint.org/uploads/i8jFefScHiXx86rvqv7wQHjAjbmXcYuEaPuzjzcO.pdf" target="_blank">
													<i class="far fa-file-pdf"></i> Guía paso a paso para la <b class="text-muted">descarga de certificados digitales</b>.
												</a>
											</div>
										  </div>
										</div>
										<div class="card">
										  <div class="card-header" id="headingTwo">
											<h2 class="mb-0">
											  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												RECUPERO DE CONTRASEÑA Y VERIFICACIÓN DE CORREO ELECTRÓNICO
											  </button>
											</h2>
										  </div>
										  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
											<div class="card-body">
												<a href="https://fimeint.org/uploads/bM5kx2vxL70ARL341gbkK7XgMQfAqDRzFhMpYd4i.pdf" target="_blank">
													<i class="far fa-file-pdf"></i> Guía paso a paso para <b class="text-muted">Verificación de correo electrónico</b> y <b class="text-muted">Recupero de contraseña</b>.
												</a>
											</div>
										  </div>
										</div>
									  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->
@stop