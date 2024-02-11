@extends('sitio.layout')

@section('title_and_meta')
    <title></title>
    <meta name="description" content="">
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
				    <li class="breadcrumb-item active" aria-current="page">Galeria</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<!-- Start galeria-videos -->
	<section id="mu-portfolio">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-portfolio-area">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>Expositores del Seminario Internacional</h2>
										<p>Los MARC y la mediación en tiempos de crisis.</p>
									</div>
								</div>
							</div>

							<div class="row">
									<!-- Start Portfolio Filter -->
									{{-- <div class="mu-portfolio-filter-area">
										<ul class="mu-simplefilter">
							                <li class="active" data-filter="all">All<span>/</span></li>
							                <li data-filter="1">Web design<span>/</span> </li>
							                <li data-filter="2">Mobile Development<span>/</span></li>
							                <li data-filter="3">E-commerces<span>/</span></li>
							                <li data-filter="4"> Arts<span>/</span> </li>
							                <li data-filter="5">Branding</li>
							            </ul>
									</div> --}}

									<!-- Start Portfolio Content -->
									<div class="mu-portfolio-content">
										<div class="row filtr-container">

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="4">
							                   	<div class="video-responsive">
							                   		<iframe src="https://www.youtube.com/embed/17WDhE1xPSI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="5">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/GGiGOQBAPhM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="3">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/jRWTQXukCGg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/IjO-AEwxApM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="2">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/_7xS9YX7M8g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="5">
							                   <div class="video-responsive">
							                   	<iframe src="https://www.youtube.com/embed/UJBtYPaORbs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							              	  </div>
							                </div>
												
							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="3">
							                   <div class="video-responsive">
							                   	<iframe src="https://www.youtube.com/embed/eSrkZBwgNeY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							              	  </div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="4">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/kz7qtu3QbyI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

						                  	<div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/wEdMGbKa3ho" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

											<div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                    <div class="video-responsive">
							                    	<iframe src="https://www.youtube.com/embed/sFA8AzfUTbI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/fDy5wDlt8Wg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/kBp5Y2qAUdc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/aTiZGzH1qOs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/PnAwxJw0-Z4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/KfPwPOb2wFc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/FijqeqU0wuk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/w0U2O2K3OIk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/zc4jHMGySUg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/yDB8Geqga0E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/0tKXpcVf9sI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/rjLVqq-qvEk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/rjLVqq-qvEk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/KmAGNaSNtRs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/72NuZDDRkbI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/72NuZDDRkbI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/nS3ZNoWRidQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>
							                
							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/N5-WKnmHyk8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>
							                
							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/65F22dWOdOM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/V2OUhPGmlDc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/8F8zKlEChG8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/CvXlMCdcvjI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/GPKEtF0Gq-E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>

							                <div class="col-xs-6 col-sm-6 col-md-4 filtr-item" data-category="1">
							                	<div class="video-responsive">
							                		<iframe src="https://www.youtube.com/embed/BH2sgvrhfHM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							                	</div>
							                </div>
							            </div>
									</div>
									<!-- End Portfolio Content -->
								</div>
							
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End galeria-videos -->


@stop