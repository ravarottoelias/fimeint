@extends('sitio.layout')

@section('title_and_meta')
    <title>Otros Cursos</title>
    <meta name="description" content="Otros Cursos. Fundación Instituto de Mediación">
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
				    <li class="breadcrumb-item active" aria-current="page">Otros Cursos</li>
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
							<h2>Otros Cursos</h2>
							{{-- <p></p> --}}
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">MÉTODOS ALTERNATIVOS DE RESOLUCIÓN DE CONFLICTOS</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<li>HABILIDADES COMUNICACIONALES PARA LA BUENA CONVIVENCIA</li>
								<li>MANEJO DE EMOCIONES EN LA NEGOCIACION Y MEDIACIÒN</li>
								<li>EL ROL DEL ABOGADO/A EN LOS PROCESOS DE MEDIACIÓN Y NEGOCIACIÓN COOPERATIVA</li>
								<li>FORMACIÓN MULTIDISCIPLINARIA DE MEDIADORES</li>
								<li>PNL, COACHING Y MEDIACIÓN </li>
								<li>MÁS ALLÁ DE LA MEDIACIÓN. APORTES DE LOS PROCEDIMIENTOS RAD AL ABORDAJE DE LOS CONFLICTOS PÚBLICOS </li>
								<li>MEDIACIÓN FAMILIAR: APLICACIONES PRÁCTICAS DESDE EL MÉTODO CIRCULAR NARRATIVO </li>
								<li>ABORDAJE DE CONFLICTOS EN EMPRESAS DE FAMILIA </li>
								<li>MEDIACION PENAL </li>
								<li>NEGOCIACION COOPERATIVA: CLAVES PARA LOGRAR RESULTADOS EFICACES EN PROCESOS DE NEGOCIACIÓN</li>
								<li>LOS ERRORES EN LA NEGOCIACIÓN Y LOS PASOS PARA LA CONSTRUCCIÓN DE ACUERDOS INTEGRATIVOS </li>
								<li>MEDIACION EDUCATIVA: APORTES PARA PENSAR SU ESPECIFICIDAD </li>
								<li>MEDIACION COMUNITARIA: ESTRATEGIAS DE INTERVENCION Y GESTION DE CONFLICTOS </li>
								<li>EL CÓDIGO CIVIL Y COMERCIAL Y LA MEDIACIÓN FAMILIAR </li>
								<li>LA VIVIENDA Y ASPECTOS ECONOMICOS EN LOS CONVENIOS DE MEDIACION FAMILIAR </li>
								<li>LA MEDIACION EN MATERIA SUCESORIA Y EL CODIGO CIVIL Y COMERCIAL DE LA NACION </li>
								<li>LOS CONVENIOS EN MEDIACIÓN FAMILIAR A LA LUZ DEL CÓDIGO CIVIL Y COMERCIAL DE LA NACIÓN</li>
							</ul>	
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">CONFLICTOS EN EMPRESAS DE FAMILIA</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<li>INTRODUCCIÓN A LA EMPRESA FAMILIAR. ¿DE QUÉ SE TRATA?</li>

								<li>HABILIDADES COMUNICACIONALES PARA LA ARMONIA EN LA EMPRESA Y EN LA FAMILIA</li>

								<li>LA BUENA GOBERNANZA EN LA EMPRESA FAMILIAR</li>

								<li>EL PROTOCOLO FAMILIAR COMO INSTRUMENTO DE PREVENCIÓN DE CONFLICTOS Y PLANIFICACIÓN SUCESORIA EN LA EMPRESA FAMILIAR </li>

								<li>NEGOCIACIÓN EN EMPRESAS: HERRAMIENTAS PARA NEGOCIACIONES COTIDIANAS Y PARA SITUACIONES COMPLEJAS</li>

								<li>ROLES Y RESPONSABILIDADES DE LOS PROFESIONALES QUE ASESORAN A EMPRESAS FAMILIARES. EL CONSULTOR DE LA EMPRESA FAMILIAR  </li>
							</ul>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">RESPONSABILIDAD SOCIAL EMPRESARIA</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<li>CÓMO POTENCIAR LOS PROCESOS DE LA EMPRESA MEDIANTE HERRAMIENTAS DE CRÉDITO FISCAL</li>
								<li>¿QUÉ ES LA RSE? </li>
							</ul>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-10">
							<p class="font-weight-bold">RRHH</p>
							<ul class="list-ustyled lista-cursos-h ml-4">
								<li>PROCESOS BÁSICOS DE SELECCIÓN DE PERSONAL PARA PYMES</li>
								<li>COMO DETECTAR NECESIDADES DE CAPACITACIÓN EN LA ORGANIZACIÓN </li>
								<li>NOCIONES BÁSICAS PARA LA GESTIÓN DE EMPRENDIMIENTOS </li>
								<li>MOTIVACIÓN PARA LOS JÓVENES EN EL MUNDO DEL TRABAJO </li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>


@stop