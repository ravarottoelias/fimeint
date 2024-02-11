@extends('sitio.layout')

@section('title_and_meta')
    <title>Consultoría a Pymes Familiares</title>
    <meta name="description" content="Desde FIMe estamos comprometidos en la calidad de la educación, para ello trabajamos, en alianza con Todo Sobre Mediación -espacio de Formación virtual- como apoyo de todas nuestras actividades de formación de RRHH, de manera on line.">
@stop

@section('mark-up-facebook')
@stop

@section('styles')
<style type="text/css">
	.desc{
		font-weight: 500;
    	font-size: 1.5rem;
    	line-height: 1.75;
	}
	.paralax {
	    padding: 90px 0 80px;
	    background: url(https://stylemixthemes.scdn2.secure.raxcdn.com/homepress/wp-content/themes/landing/assets/dist/../image/advanced/bg.jpg) no-repeat fixed;
	    background-size: cover;
	    color: #fff;
	}
	.pymes-item p{
		font-size: 17px;
	}
	.pymes-item i{
		color: #fcb80b;
	}
	.mu-social-media .mu-whatsapp{
		background-color: #65bc54;
	}
	.mu-social-media a{
		font-size:20px;
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
				    <li class="breadcrumb-item active" aria-current="page">Consultoría a Pymes Familiares</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section class="w-100" style="display: inline-block;">
	<div class="d-flex align-items-center justify-content-center my-4">
		<img class="img-fluid" style="height: 80px;" src="{{asset('images/icon-only-consultoria-min.png')}}">
		<div class="ml-4">
			<h2>Consultoría a Pymes Familiares</h2>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="my-5">
					<p class="text-justify">Nuestra misión es lograr la supervivencia armónica de las empresas familiares y de sus familias a través de sus sucesivas generaciones.</p>
					<p class="text-justify">Junto con nuestros clientes, buscamos soluciones ajustadas a sus necesidades y requerimientos, optimizando los recursos con que cuentan, sugiriendo la incorporación de aquéllos que se considere pertinentes.</p>
					<p class="text-justify">Diseñamos capacitaciones a medida de cada empresa, potenciando sus propias capacidades. </p>
					<p class="text-justify">Trabajamos en red con profesionales especialistas en temáticas específicas de diversas disciplinas.</p>
					<p class="text-justify">Nuestro PUBLICO OBJETIVO está conformado por empresarios, directivos, emprendedores, sus familiares, sin importar las dimensiones de su empresa, que necesiten una colaboración externa y neutral para lograr mejores resultados en sus actividades cotidianas, y en las que estén proyectando.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="my-5">
	<div class="container">
    		<div class="row d-flex justify-content-center">
    			<div class="col-md-10 col-sm-12">
    				<div class="row d-flex align-items-center">
    					<div class="col-md-4 col-sm-12 text-center">
    						<img class="rounded-circle my-3" src="{{asset('images/contact-us-keyboard-3.jpg')}}">
    					</div>
    					<div class="col-md-8 col-sm-12">
    						<div class="text-center text-md-left">
		    					<h4>HACENOS TU CONSULTA</h4>
		    					<p>Comunícate con nosotros a través de cualquiera de nuestros medios.</p>
		    				</div>
			    			<div class="text-center text-md-left mu-social-media">
			    				<ul class="list-inline mt-2">
								  <li class="list-inline-item"> <a href="https://api.whatsapp.com/send?phone=543624373386" class="mu-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
								  <li class="list-inline-item"> <a href="https://www.facebook.com/fundacioninstituto.demediacionfime/" class="mu-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								  <li class="list-inline-item"> <a href="https://www.instagram.com/fime_institutodemediacion/" class="mu-instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
								  <li class="list-inline-item"> <a href="/contacto" class="mu-google-plus" target="_blank"><i class="far fa-envelope"></i></a></li>
								</ul>
			    			</div>
    					</div>
    				</div>
    			</div>

    		</div>
    	</div>
</section>

<section class="my-5 py-5">
    <div class="paralax pymes">
    	<div class="container">
    		<div class="row d-flex justify-content-center">
    			<div class="col-md-12 col-sm-12">
    				<h3 class="text-center text-uppercase" style="font-weight: 400; line-height: 1.4">Trabajamos junto a PYMES y Emprendimientos Familiares a fin de lograr</h3>
		    		<div class="row py-5">
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> Su apropiada profesionalización y planificación estratégica.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> La efectiva puesta en funcionamiento de órganos de gobierno.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> La clarificación de roles, funciones y responsabilidades, como así también de la distribución de sus ingresos.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> La armonía en la incorporación de las nuevas generaciones y convivencia intergeneracional.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> El eficiente manejo de las relaciones internas, tanto en la empresa como en la familia.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> Una adecuada planificación de la continuidad de la empresa.</p>
		    			</div>
		    			<div class="col-md-6 col-sm-12 mb-2 pymes-item">
		    				<p><i class="fas fa-check"></i> La gestión eficiente de conflictos.</p>
		    			</div>
		    		</div>
    			</div>
    		</div>
    		
    	</div>
    </div>
</section>



@stop