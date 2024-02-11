@extends('admin.layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-5">
			<div class="card">
				<h5 class="card-header">En Curso</h5>
				<div class="card-body">
					<table class="table table-sm table-striped_ w-auto">
					<thead>
						<tr>
							<th>#Id</th>
							<th>Titulo</th>
						</tr>
					</thead>
						<tbody>
							@foreach ( $cursos as $curso)
							<tr class="">
								<td><a href="{{ route('cursos.edit', $curso->id) }}"> {{ $curso->id }} </a></td>
								<td>{{ substr($curso->titulo, 0, 40) . '...' }} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-7">
			<div class="card">
				<h5 class="card-header">Últimos pagos</h5>
				<div class="card-body">
					<!--Table-->
					<table class="table table-sm table-striped_ w-auto">

					<!--Table head-->
					<thead>
						<tr>
						<th>#Id</th>
						<th>Detalles</th>
						<th>Fecha</th>
						</tr>
					</thead>
					<!--Table head-->

					<!--Table body-->
					<tbody>
					@foreach ( $payments as $payment)
						<tr class="">
						<th scope="row"><a href="{{ route('payment_details', $payment->paymentIdMP) }}"><i class="fas fa-external-link"></i> {{ $payment->paymentIdMP }}</a></th>
						<td><span class="badge badge-success">{{ $payment->paymentSatus }}</span>
							<p class="mb-1">{{ $payment->userName }} </p>
						</td>
						<td>{{ $payment->paymentDate }}</td>
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
