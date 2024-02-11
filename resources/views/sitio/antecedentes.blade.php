@extends('sitio.layout')

@section('title_and_meta')
    <title>Quiénes Somos Fundación Instituto de Mediación</title>
    <meta name="description" content="Desde FIMe estamos comprometidos en la calidad de la educación, para ello trabajamos, en alianza con Todo Sobre Mediación -espacio de Formación virtual- como apoyo de todas nuestras actividades de formación de RRHH, de manera on line.">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.celeste{
		color: #7d65ef !important;
	}
.bg-testimonial-area{
	/*background-image: url("/images/testimonial-bg.jpg");*/
	background-image: url("https://nordiclifescience.org/wp-content/public_html/2018/01/publication-e1516615172666.jpg");
}
.mu-about-right ul li h3 {
	font-size: 25px;
}
.mu-about-right h3 {
    border-bottom: 3px solid #e5e5e5;
    color: #323232;
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 15px;
}
.mu-about-right p {
    font-size: 16px;
}
.mu-single-team-content{
	min-height: 225px
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
				    <li class="breadcrumb-item active" aria-current="page">Nosotros</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section>
	<img src="{{asset('/images/collage-us-min.jpg')}}" class="w-100 img-fluid">
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="mu-blog" class="mt-4">
				 	<div class="row">
						<div class="col-md-12">
							<div class="mu-title">
								<h2>¿Quiénes Somos?</h2>
								<p>Somos una Entidad sin fines de lucro que hemos iniciado nuestras actividades en agosto de 1.995 obteniendo la constitución jurídica el 20 de febrero de 1.996, (Matrícula N° 115/96, Dto. 1986/96 de la provincia del Chaco).</p>
							</div>
						</div>
					</div>
					
					<div class="row py-4">
						<div class="col-md-4" id="mision-vision-valores">
							<div class="mu-about-right">
								<ul>
									<li>
										<h3 class="celeste">Misión</h3>
										<p class="text-justify">Desarrollar nuestras actividades con profesionalismo, seriedad y responsabilidad, apoyados en los valores que nos sustentan, para asegurar el bienestar y armonía de los pueblos y sus organizaciones.</p>
									</li>
									<li>
										<h3 class="celeste">Visión</h3>
										<p class="text-justify">Convertirnos en una organización líder en la región, destacándonos por nuestro compromiso, responsabilidad y entrega en el abordaje cooperativo de conflictos en todos los ámbitos de la sociedad.</p>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-8" id="quienes-somos">
							<div class="mu-about-right text-center">
								
								<h3 class="celeste">Valores</h3>
								
							</div>
							<img src="{{asset('/images/valores-min.jpg')}}">
							{{-- <div class="mu-about-left">
								<h2 class="celeste text-center mb-4">¿Quiénes Somos? </h2>
								<p class="text-justify">Somos una Entidad sin fines de lucro que hemos iniciado nuestras actividades en agosto de 1.995 obteniendo la constitución jurídica el 20 de febrero de 1.996, (Matrícula N° 115/96, Dto. 1986/96 de la provincia del Chaco).</p>
								<p class="text-justify">Estamos inscriptos en el registro de Entidades Formadoras del Ministerio de Justicia y Derechos Humanos de la Nación, con registro Nº 21 en Di.Na.M.A.R.C. (Dirección Nacional de Medios Alternativos de Resolución de Conflictos).</p>
								<p class="text-justify">La abogada Lilian Edith Vargas es nuestra  Responsable Institucional, somos la primera Entidad Formadora Oficial de la región y contamos con el primer Centro Privado de Mediación, Negociación, Arbitraje y Resolución de Conflictos de la provincia del Chaco y también de la región.</p>
								<p class="text-justify">Trabajamos en equipo de manera interdisciplinaria con profesionales, especialistas y técnicos de diversos ámbitos y regiones del planeta, buscando generar e implementar acciones a medida de cada situación, que se adapten a las necesidades de la misma.</p>
								<p class="text-justify">Nos unen objetivos e intereses comunes: LA ARMONÍA EN LAS RELACIONES HUMANAS EN TODOS LOS CONTEXTOS DE LA SOCIEDAD</p>														
							</div> --}}
						</div>
					</div> 
				
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Start Equipo -->
<section id="equipo">
	<div class="container">
		<div class="mu-team-area">
		   <!-- Title -->
		   <div class="row">
		      <div class="col-md-12">
		         <div class="mu-title">
		            <h2>Nuestro Equipo</h2>
		            <p>Conoce a los integrantes.</p>
		         </div>
		      </div>
		   </div>

		   <!-- Start Team Content -->
		   <div class="row">
		      <div class="col-md-12">
		         <div class="mu-team-content">
		            <div class="row">
		               <!-- start single item -->
		               <div class="col-md-6">
		                  <div class="mu-single-team">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-lilian.png" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="{{asset('/docs/cv-lilian-vargas.pdf')}}" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>LILIAN EDITH VARGAS</h3>
		                        <p>Responsable Institucional y Coordinadora Académica</p>
		                        <p class="detail-member">Abogada. Master of Arts in Conflict Resolution. Mediadora. Especialista en Negociación Cooperativa, Mediación Familiar y en Empresas de Familia.</p>
		                        {{-- <ul class="mu-team-social">
		                           <li><a href="#"><i class="fa fa-facebook"></i></a></li>
		                           <li><a href="#"><i class="fa fa-twitter"></i></a></li>
		                           <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
		                           <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
		                        </ul> --}}
		                     </div>
		                  </div>
		               </div>
		               <!-- End single item -->
		               <!-- START DANIEL -->
		               <div class="col-md-6">
		                  <div class="mu-single-team">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-daniel.jpg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="{{asset('/docs/cv-daniel-martinez-zampa.pdf')}}" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>DANIEL MARTINEZ ZAMPA</h3>
		                        <p>Responsable del Dpto. Capacitación on line</p>
		                        <p class="detail-member">Abogado, Magister en Resolución de Conflictos. Mediador. Especialista en Mediación Familiar y Mediación Educativa. Profesor de Ciencias Jurídicas. Formador de mediadores.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End DANIEL -->
		               <!-- start LAURA -->
		               <div class="col-md-6">
		                  <div class="mu-single-team">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-laura.jpg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="{{asset('/docs/cv-laura-monfardini.pdf')}}" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>LAURA MONFARDINI</h3>
		                        <p>Coordinadora General de actividades de capacitación.</p>
		                        <p class="detail-member"> Técnica Superior en Administración y Gestión en Instituciones Educativas de Educación Superior. Mediadora. Especialista en Mediación Familiar. Responsable del Dpto. Administración y fundraising.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End LAURA -->
		              
		               <!-- start Sonia Seba -->
		               <div class="col-md-6">
		                  <div class="mu-single-team" style="height: auto;">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-sonia-seba.jpeg" alt="img">
		                       {{--  <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="#" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>SONIA SEBA</h3>
		                        <p>Docente</p>
		                        <p class="detail-member">Especialista en Dcho de familia, escribana, mediadora, orientadora familiar.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End Sonia Seba -->

		               <!-- start Víctor del Río -->
		               <div class="col-md-6">
		                  <div class="mu-single-team" style="height: auto;">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-victor-del-rio.jpeg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="#" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>VÍCTOR DEL RÍO</h3>
		                        <p>Docente</p>
		                        <p class="detail-member mt-3">Juez de Camara. Mediador. Profesor Derecho Penal y Procesal Penal.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End Víctor del Río -->
		               
		               <!-- start Daicy Pedrini -->
		               <div class="col-md-6">
		                  <div class="mu-single-team" style="height: auto;">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-daicy-pedrini.jpg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="#" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>DAICY PEDRINI</h3>
		                        <p>Docente</p>
		                        <p class="detail-member mt-3">Abogada. Mediadora M. Familiar. Especialista en Derecho de Familia.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End Daicy Pedrini -->

		               <!-- start Mónica Tiraboschi -->
		               <div class="col-md-6">
		                  <div class="mu-single-team" style="height: auto;">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-monica-tiraboschi.jpeg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="#" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>MÓNICA TIRABOSCHI</h3>
		                        <p>Docente</p>
		                        <p class="detail-member mt-3">Mediadora y Negociadora. Psicóloga.  Participa del diseño e implementación de programas de fortalecimiento social e institucional y  de capacitación para la gestión de proyectos participativos.</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End Mónica Tiraboschi -->

		               <!-- start marcelo -->
		               <div class="col-md-6">
		                  <div class="mu-single-team" style="height: auto;">
		                     <div class="mu-single-team-img">
		                        <img src="/images/team-marcelo.jpeg" alt="img">
		                        {{-- <div class="w-100 text-center mt-4" >
		                     		<a class="btn " href="{{asset('/docs/cv-belen-suarez.pdf')}}" target="_blank"><i class="far fa-file-alt"></i> Ver CV</a>
		                        </div> --}}
		                     </div>
		                     <div class="mu-single-team-content">
		                        <h3>MARCELO CHURIN</h3>
		                        <p class="detail-member mt-3">Abogado, licenciado, especialista en negociación en crisis de alta visibilidad. Ex integrante del COE Chaco y ex secretario de seguridad de la provincia</p>
		                     </div>
		                  </div>
		               </div>
		               <!-- End marcelo -->

		            </div>
		         </div>
		      </div>
		   </div>
		   <!-- End Team Content -->
		</div>
	</div>
</section>

<!-- Start Client Testimonials -->
<section id="mu-testimonials" class="bg-testimonial-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-testimonials-area">
					<h2>Homenaje a</h2>

					<div class="mu-testimonials-block">
						<ul class="mu-testimonial-slide">
							<li>
								<div class="d-flex justify-content-center mb-5 flex-wrap">
									<div class="px-4">
										<img class="mu-rt-img" src="/images/homenaje-cesar-jazmin.jpeg" alt="img">
										<h5 class="mu-rt-name mt-0">JULIO CÉSAR JAZMÍN</h5>
									</div>
									<div class="px-4">
										<img class="mu-rt-img" src="/images/homenaje-maria-baroni.jpeg" alt="img">
										<h5 class="mu-rt-name mt-0">MARÍA CECILIA BARONI</h5>
									</div>
								</div>
								<p>Se ha escrito mucho acerca de la importancia de la Educación y de la relevancia de la tarea educativa, pero quizás no tanto acerca del recuerdo y la impronta que dejan las personas que la encarnan.
									Es por ello que desde FIMe homenajeamos con el mejor de los recuerdos a nuestros queridos colegas, miembros ambos de nuestro equipo docente: JULIO CÉSAR JAZMÍN, quien nos dejara presencialmente el 13 de marzo de 2015 y MARÍA CECILIA BARONI, el 16 de noviembre de 2019.
									El recuerdo y espíritu de ambos se mantienen intactos entre nosotros.
								</p>
								<div class="mt-5 d-flex flex-row justify-content-center align-items-center">
									<img  src="{{asset('/images/nuevo-logo-fime.png')}}" style="max-width: 160px;">
									{{-- <h5 class="mu-rt-name my-0 ml-2">FIMe</h5> --}}
								</div>
								<span class="mu-rt-title d-none">Fundación Instituto de Mediación</span>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Client Testimonials -->

@stop
@section('script')

@stop