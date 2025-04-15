@extends('admin.layout')

@section('content')

	<h1 class="mt-4">Certificados</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Certificados</li>
    </ol>

	@include('admin.includes.flashmessage')

	<div class="d-flex justify-content-end mb-2">
		<a class="btn btn-primary" href="{{ route('certificates_create_step_one') }}">
			<i class="fa-solid fa-plus"></i> Nuevo
		</a>
	</div>

	<!-- Buscador -->
	<div class="card">
		<div class="card-body">
				<form action="{{route('certificates')}}" method="get" style="justify-content: flex-end;">
					<div class="row">
						<div class="col-12 col-md-8 col-lg-9">
							<div class="row">
								<div class="col-12">
									<input type="text" class="form-control" name="searchFor" id="searchFor" placeholder="Buscador" value="{{app('request')->input('searchFor')}}">
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 col-lg-3">
							<div class="input-group">
								<a href="{{route('certificates')}}" class="btn btn-default mb-2 mr-1"> <i class="far fa-trash-alt"></i> Limpiar</a>
								<button type="submit" class="btn btn-primary mb-2 w-90"><i class="fas fa-search"></i> Buscar</button>
							</div>
						</div>
					</div>
				</form>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-sm table-hover mt-3">
			<thead>
				<tr>
					<th>Certificado</th>
					<th>Alumno</th>
					<th>Curso</th>
					<th></th>
				</tr>
			</thead>
			<tbody class="body-files">
			@foreach($certificates->data as $cert)
				<tr>
					<td>
						<p class="mb-0"><strong>N° {{$cert->certificadoNumero}}</strong> - {{$cert->tfCertificadoNumero}}</p>
						<span class="text-muted small ">Creado: {{$cert->createdAt}}</span>
					</td>
					<td>
						<p class="mb-0">{{$cert->alumnoNombreCompleto}}</p>
						<span class="text-muted small ">{{$cert->alumnoCuit}}</span>
					</td>
					<td>
						<p class="mb-0">{{substr($cert->cursoNombre, 0, 50)}} ...</p>
						<span class="text-muted small ">{{$cert->cursoFecha}}</span>
					</td>
					<td><a href="{{route('certificates_show', $cert->uuid)}}" class="btn btn-sm btn-primary" title="Administrar"><i class="fas fa-cog"></i></a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@if ($certificates->data)
			@include('admin.includes.paginationApi', ['data' => $certificates])
		@else
		<div class="alert alert-dismissible alert-light">
			<strong>Nada por aqui!</strong> No se encontraron certificados.
		</div>
		@endif
	</div>

@stop

@section('script')
<script type="text/javascript">
	
	
</script>
@stop