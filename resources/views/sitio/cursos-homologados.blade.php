@extends('sitio.layout')

@section('title_and_meta')
    <title>Cursos Homologados</title>
    <meta name="description" content="Cursos Homologados">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.lista-cursos-h li{
		font-size: 15px;
	}
	.titulo-cursos-h{
		font-weight: 400;
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
				    <li class="breadcrumb-item active" aria-current="page">Cursos Homologados</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog" class="mt-3">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="mu-blog-left">
					<div class="d-flex align-items-center justify-content-center">
						<img class="img-fluid" style="height: 80px;" src="{{asset('images/icon-only-cursoshomologados-min.png')}}">
						<div class=" ml-4">
							<h2>Cursos Homologados</h2>
							{{-- <p></p> --}}
						</div>
					</div>

					<div class="row mt-5">
						<div class="col-md-10">
							<h4 class="titulo-cursos-h">CURSO HOMOLOGADO CONFORME LA DISPOSICIÓN MJYDH N° 064/98 Y RATIFICADO POR RESOLUCIÓN Nº 517/14 </h4>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">CURSO NIVEL BÁSICO (Modalidad presencial)</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<li>CURSO FORMACIÓN MULTIDISCIPLINARIA DE MEDIADORES</li>
							</ul>	
						</div>
					</div>
					<hr class="my4">	
					<div class="row mt-5">
						<div class="col-md-10">
							<h4 class="titulo-cursos-h">CURSOS HOMOLOGADOS CONFORME LA RESOLUCION MJYDH N° 517/14 </h4>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">CAPACITACIÓN CONTINUA (Modalidad presencial)</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<p>•	PNL, COACHING Y MEDIACIÓN </p>
								<p>•	MÁS ALLÁ DE LA MEDIACIÓN. APORTES DE LOS PROCEDIMIENTOS RAD AL ABORDAJE DE LOS CONFLICTOS PÚBLICOS </p>
								<p>•	MEDIACIÓN FAMILIAR: APLICACIONES PRÁCTICAS DESDE EL MÉTODO CIRCULAR NARRATIVO </p>
								<p>•	ABORDAJE DE CONFLICTOS EN EMPRESAS DE FAMILIA </p>
								<p>•	MEDIACION PENAL I </p>
								<p>•	MEDIACION PENAL II </p>
								<p>•	PROFUNDIZACION EN NEGOCIACION PARA MEDIADORES </p>
								<p>•	LOS ERRORES EN LA NEGOCIACIÓN Y LOS PASOS PARA LA CONSTRUCCIÓN DE ACUERDOS INTEGRATIVOS </p>
								<p>•	CLINICA DE CASOS </p>
								<p>•	MEDIACION EDUCATIVA: APORTES PARA PENSAR SU ESPECIFICIDAD </p>
								<p>•	MEDIACION COMUNITARIA: ESTRATEGIAS DE INTERVENCION Y GESTION DE CONFLICTOS </p>
								<p>•	EL CÓDIGO CIVIL Y COMERCIAL Y LA MEDIACIÓN FAMILIAR </p>
								<p>•	LA VIVIENDA Y ASPECTOS ECONOMICOS EN LOS CONVENIOS DE MEDIACION FAMILIAR </p>
								<p>•	LA MEDIACION EN MATERIA SUCESORIA Y EL CODIGO CIVIL Y COMERCIAL DE LA NACION </p>
								<p>•	LOS CONVENIOS EN MEDIACIÓN FAMILIAR A LA LUZ DEL CÓDIGO CIVIL Y COMERCIAL DE LA NACIÓN</p>
								<p>•	CURSO DE ESPECIALIZACION EN MEDIACION FAMILIAR</p>

							</ul>	
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">CURSO DE ESPECIALIZACIÓN (Modalidad presencial)</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<p>• CURSO DE ESPECIALIZACION EN MEDIACION FAMILIAR </p>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


@stop