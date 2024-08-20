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

<section id="mu-blog" class="">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="mu-blog-left">
				
				<div class="row mt-3">
					<div class="col-12">
						@include('sitio.includes.flash-message')	
					</div>
				</div>

				 @if( $curso->permitir_inscripcion == 1 )
					<div class="container-stepwizard" id="container-stepwizard">
						<div class="wizard-header text-center mx-3">
							<h4 class="heading">{{ $curso->titulo }}</h4>
							<p class="">{{ $curso->descripcion }}</p>
						</div>
						<div class="stepwizard">
							<div class="stepwizard-row py-2">
								<div class="stepwizard-step">
									<button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
									<p class="d-none d-sm-block">Cuenta</p>
								</div>
								<div class="stepwizard-step">
									<button type="button" class="btn btn-default btn-circle"><i class="fas fa-pencil-alt"></i></button>
									<p class="d-none d-sm-block">Inscripción</p>
								</div>
								{{-- ACTIVO --}}
								<div class="stepwizard-step">
									<button type="button" class="btn btn-primary btn-circle"><i class="fas fa-money-check-alt"></i></button>
									<p class="text-dark d-none d-sm-block">Pago</p>
								</div>
								<div class="stepwizard-step">
									<button type="button" class="btn btn-default btn-circle"><i class="fas fa-check"></i></button>
									<p class="d-none d-sm-block">Hecho</p>
								</div>  
							</div>
							<div class="stepwizard-contenido py-2 py-md-5 mx-4 ">
								<section class="payment-section mt-4">
									@php
										$esPreInscripcion = $curso->unit_price < 1 ? true : false;
									@endphp
									@if ($esPreInscripcion)
										<div class="row">
											<div class="col-12">
												<h3 class="text-center">Pre Inscripción</h3>
												<p class="text-center"><i class="text-success fas fa-check-circle"></i> Su pre inscripcion ha sido exitosa </p>
												<ul>
													<li class="text-center">Los pagos se podran realizar una vez finalizada la etapa de pre-inscripción.</li>
												</ul>
											</div>
										</div>
										@else
										<div class="row justify-content-center">
											@if (\App\Helpers\Utils::getSetting('mercadopago_integration_enabled') == '1')										
											<div class="col-lg-12 col-12 mb-3">
												<div class="box featured py-3">
													<h3>Pago Argentinos</h3>
													{{-- <h4><sup>$</sup>{{ $curso->unit_price }}</h4> --}}
													<ul>
														<li><i class="bx bx-check"></i> Realiza tu pago con Mercadopago</li>
													</ul>
													<table class="table table-borderless">
														<tbody>
															@if ($curso->cantidad_cuotas == 1)
															<tr>
																<td class="text-right">Abonar total. - 1 x $ {{ App\Helpers\Utils::formatPrice($curso->unit_price) }}</td>
																<td><div class="btn-mp-container d-flex justify-content-center_"></div></td>
															</tr>
															@endif
															@if ($curso->cantidad_cuotas == 2)
																@if ($inscription->estado_del_pago == App\Inscripcion::PENDIENTE)
																	<tr>
																		<td class="text-right">Abonar total. - 1 x $ {{ App\Helpers\Utils::formatPrice($curso->unit_price) }}</td>
																		<td><div class="btn-mp-container d-flex justify-content-center_"></div></td>
																	</tr>
																	<tr>
																		<td class="text-right">Abonar cuota. - 2 x $ {{ App\Helpers\Utils::formatPrice($cursoFee->calcularValorCuota()) }}</td>
																		<td><div class="btn-mp-container-fee d-flex justify-content-center_"></div></td>
																	</tr>
																@endif
																@if ($inscription->estado_del_pago == App\Inscripcion::PAGADO_PARCIAL)
																<tr>
																		<td class="text-right">Abonar cuota 2. - $	{{ App\Helpers\Utils::formatPrice($cursoFee->calcularValorCuota()) }}</td>
																		<td><div class="btn-mp-container-fee d-flex justify-content-center_"></div></td>
																	</tr>
																@endif
															@endif
														</tbody>
													</table>
													
													
												</div>
											</div>
											@endif
										
											
											@if (\App\Helpers\Utils::getSetting('paypal_integration_enabled') == '1')										
												<div class="col-lg-12 col-12 mb-3">
													<div class="box featured py-3">
														<h3>Pago Extranjeros</h3>
														{{-- <h4><sup>$</sup>{{ $curso->unit_price }}</h4> --}}
														<ul>
															<li><i class="bx bx-check"></i> Realiza tu pago con PayPal</li>
														</ul>
	
														<table class="table table-borderless">
															<tbody>
																@if ($curso->cantidad_cuotas == 1)
																<tr>
																	<td class="text-right">Abonar total. - 1 x $ {{ App\Helpers\Utils::formatPrice($curso->unit_price) }}</td>
																	<td><a class="btn btn-primary mercadopago-button" href="{{ route('pay_with_paypal', ['inscription' => $inscription->id, 'paymentType' => 'total']) }}">Pagar</a></td>
																</tr>
																@endif
																@if ($curso->cantidad_cuotas == 2)
																	@if ($inscription->estado_del_pago == App\Inscripcion::PENDIENTE)
																		<tr>
																			<td class="text-right">Abonar total. - 1 x $ {{ App\Helpers\Utils::formatPrice($curso->unit_price) }}</td>
																			<td><a class="btn btn-primary mercadopago-button" href="{{ route('pay_with_paypal', ['inscription' => $inscription->id, 'paymentType' => 'total']) }}">Pagar</a></td>
																		</tr>
																		<tr>
																			<td class="text-right">Abonar cuota. - 2 x $ {{ App\Helpers\Utils::formatPrice($cursoFee->calcularValorCuota()) }}</td>
																			<td><a class="btn btn-primary mercadopago-button" href="{{ route('pay_with_paypal', ['inscription' => $inscription->id, 'paymentType' => 'fee']) }}">Pagar cuota</a></td>
																		</tr>
																	@endif
																	@if ($inscription->estado_del_pago == App\Inscripcion::PAGADO_PARCIAL)
																		<tr>
																			<td class="text-right">Abonar cuota 2. - $ {{ App\Helpers\Utils::formatPrice($cursoFee->calcularValorCuota()) }}</td>
																			<td><a class="btn btn-primary mercadopago-button" href="{{ route('pay_with_paypal', ['inscription' => $inscription->id, 'paymentType' => 'fee']) }}">Pagar</a></td>
																		</tr>
																	@endif
																@endif
															</tbody>
														</table>
														
														
														
													</div>
												</div>
											@endif
	
											@if($curso->scriptsDePagos()->count()>0)
											<div class="col-lg-12 col-12">
												<div class="box featured">
													<h3>Otros</h3>
													{{-- <h4><sup>$</sup>{{ $curso->unit_price }}</h4> --}}
													<ul>
														<li><i class="bx bx-check"></i> Realiza tu pago con Paypal</li>
													</ul>
													<!-- SCRIPTS DE PAGO -->
													
														@foreach($curso->scriptsDePagos()->get() as $sp)
															{!! $sp->script !!}
														@endforeach
													<!-- SCRIPTS DE PAGO FIN -->
												</div>
											</div>
											@endif
										</div>
									@endif
											
								</section>
							</div>
						</div>
					</div>	
				@endif	
			</div>
		</div>
	</div>
</section>


@stop


@section('script')
	<script type="text/javascript">

		function initializeCheckoutMP() {
			/**
			 * Checkout pago completo
			*/
			const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
				locale: "es-AR",
			});

			mp.checkout({
				preference: {
				id: '{{ $preference->id }}',
				},
				render: {
				container: ".btn-mp-container",
				label: "Pagar",
				},
				autoOpen: false
			});


			/**
			 * Checkout pago cuota
			*/
			const mpFee = new MercadoPago("{{ config('services.mercadopago.key') }}", {
				locale: "es-AR",
			});
			mpFee.checkout({
				preference: {
					id: '{{ $preferenceFee->id }}',
				},
				render: {
				container: ".btn-mp-container-fee",
				label: "Pagar Cuota",
				},
				autoOpen: false
			});
		}


		initializeCheckoutMP();
	</script>
@stop
