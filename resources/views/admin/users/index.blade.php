@extends('admin.layout')

@section('stylesheet')
@stop

@section('content')

	<h1 class="mt-4">Usuarios</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Usuarios</li>
	</ol>

	@include('admin.includes.flashmessage')

	<div class="card">
		<div class="card-body">
			
				<form action="{{route('users.index')}}" method="get" style="justify-content: flex-end;">
					<div class="row">
						<div class="col-12 col-md-8">
							<div class="form-group row">
								<div class="col-12">
								  
								  <input type="text" class="form-control" name="searchFor" id="searchFor" placeholder="Buscar por nombre, email, dni, cuit, tel. " value="{{app('request')->input('searchFor')}}">
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="input-group">
								<a href="{{route('users.index')}}" class="btn btn-default mb-2 mr-1"> <i class="far fa-trash-alt"></i> Limpiar</a>
								<button type="submit" class="btn btn-primary mb-2 w-90"><i class="fas fa-search"></i> Buscar</button>
							</div>
						</div>
					</div>
				</form>
		</div>
	</div>

	<table class="table table-sm table-hover mt-3">
		<thead>
			<tr>
			<th class="w-5">#ID</th>
			<th class="w-30">Nombre Completo</th>
			<th class="w-40">Contacto</th>
			<th class="w-10 text-right"></th>
			<th class="w-15 text-right"></th>
			</tr>
		</thead>
		<tbody class="body-users">
		@foreach($users as $user)
			<tr>
			<td><a href="{{route('users.edit', $user->id)}}">{{$user->id}}</a></td>
			<td>
				<p class="mb-0">{{$user->fullName()}}</p>
				<span class="text-muted" style="font-size: 13px; font-weight: 600">{{$user->documento_tipo}}</span> <span class="text-muted" style="font-size: 13px">{{$user->documento_nro}}</span>
			</td>
			<td>
				<p class="mb-0">
					@if ($user->confirmed == true)
						<span class="badge badge-pill badge-success">Verificado</span>
					@endif
					{{$user->email}} 
				</p>
				<span class="text-muted" style="font-size: 13px"><b>Tel: </b>{{$user->codigo_tel_pais}} {{$user->telefono}}</span>
			</td>
			
			<td class="text-right">
				<p class="mb-0">Creado: {{$user->created_at->format('Y-m-d h:i:s')}}</p>
				<p class="mb-0">Actualizado: {{$user->updated_at->format('Y-m-d h:i')}}</p>
			</td>
			<td class="text-right">
				<a href="{{route('users.edit', $user->id)}}" type="submit" class="btn btn-sm btn-info" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></a>
			</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div class="d-flex justify-content-center">
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>

@stop

@section('script')

@stop