@extends('admin.layout')

@section('content')

	<h1 class="mt-4">Certificados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Certificados</li>
    </ol>

	<div class="d-flex justify-content-end mb-2">
		<a class="btn btn-primary" href="{{ route('certificates_create_step_one') }}">
			<i class="fa-solid fa-plus"></i> Nuevo
		</a>
	</div>

	@include('admin.includes.flashmessage')

	<div class="table-responsive">
		<table class="table table-sm table-hover mt-3">
			<thead>
				<tr>
				<th>#QR</th>
				<th>Alumno</th>
				<th>Curso</th>
				<th></th>
				</tr>
			</thead>
			<tbody class="body-files">
			@foreach($certificates->data as $cert)
				<tr>
					<td>{{$cert->codigoQr}}</td>
					<td>
						<p class="mb-0">{{$cert->alumnoNombreCompleto}}</p>
						<span class="text-muted small ">{{$cert->alumnoCuit}}</span>
					</td>
					<td>
						<p class="mb-0">{{substr($cert->cursoNombre, 0, 50)}} ...</p>
						<span class="text-muted small ">{{$cert->cursoFecha}}</span>
					</td>
					<td><a href="{{route('certificates_show', $cert->id)}}" class="btn btn-sm btn-primary" title="Administrar"><i class="fas fa-cog"></i></a></td>
				</tr>
			@endforeach
			</tbody>
		</table>

		  @include('admin.includes.paginationApi', ['data' => $certificates])
	</div>

@stop

@section('script')
<script type="text/javascript">
	
	
</script>
@stop