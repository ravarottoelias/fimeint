@extends('admin.layout')

@section('content')
<h1 class="mt-4">Panel {{ env('APP_NAME') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Panel</li>
    </ol>

	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center mb-3">
                        <div>
                            <h4 class="card-title">Inscripciones</h4>
                            <p class="card-subtitle">Últimas inscripciones</p>
                        </div>
                        {{-- <div class="ml-auto">
                            <div class="dl">
                                <select class="custom-select">
                                    <option value="0" selected="">Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <!-- title -->
					<div class="table-responsive">
						<table class="table table-sm v-middle">
							<thead>
								<tr class="bg-light">
									<th class="border-top-0">#ID</th>
									<th class="border-top-0">Usuario</th>
									<th class="border-top-0">Curso</th>
									<th class="border-top-0">Pago</th>
									<th class="border-top-0">Fecha</th>
								</tr>
							</thead>
							<tbody>
								@foreach ( $inscriptions as $inscription)
								<tr>
									<td><a href="{{ route('inscription_show', $inscription->id) }}"> {{ $inscription->id }}</a></td>
									<td>{{ $inscription->alumno->fullname() }}</td>
									<td>{{ $inscription->curso->titulo }}</td>
									<td><span class="badge @if($inscription->pagado()) badge-success @else badge-dark @endif">{{ $inscription->estado_del_pago }}</span></td>
									<td>{{ $inscription->created_at->format('Y-m-d') }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
            </div>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<!-- title -->
					<div class="d-md-flex align-items-center mb-3">
						<div>
							<h4 class="card-title">Pagos</h4>
							<p class="card-subtitle">Últimos pagos</p>
						</div>
						{{-- <div class="ml-auto">
							<div class="dl">
								<select class="custom-select">
									<option value="0" selected="">Monthly</option>
									<option value="1">Daily</option>
									<option value="2">Weekly</option>
									<option value="3">Yearly</option>
								</select>
							</div>
						</div> --}}
					</div>
					<!-- title -->

					<div class="table-responsive">
						<!--Table-->
						<table class="table table-sm table-sm-text-sm">

							<!--Table head-->
							<thead>
								<tr>
									<th>#ID</th>
									<th>Estado</th>
									<th>Alumno</th>
									<th>Curso</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<!--Table head-->

							<!--Table body-->
							<tbody>
							@foreach ( $payments as $payment)
								<tr class="">
									<td><a href="{{ route('payment_details', $payment->payment_identifier) }}"> {{ $payment->payment_identifier }}</a></td>
									<td><span class="badge @if(\App\Constants\MPIntegrationConstants::PAYMENT_STATUS_APPROVED == $payment->status) badge-success @else badge-danger @endif">{{ $payment->status }}</span></td>
									<td>{{ $payment->inscription->alumno->fullName() }}</td>
									<td>{{ $payment->inscription->curso->titulo }}</td>
									<td>{{ $payment->created_at->format('Y-m-d') }}</td>
								</tr>
							@endforeach
							</tbody>
							<!--Table body-->
						</table>
						<!--Table-->
					</div>
				</div>
			</div>
		</div>

	</div>


@stop
