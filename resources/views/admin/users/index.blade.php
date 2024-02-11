@extends('admin.layout')

@section('stylesheet')
@stop

@section('content')
<div class="card">
	<div class="card-header">Usuarios y Roles</div>
		<div class="card-body">

			<div class="mb-3">
				<form class="form-inline" action="{{route('users.index')}}" method="get" style="justify-content: flex-end;">
					<label class="sr-only" for="name">Name</label>
					<div class="input-group mb-2 w-35">
						<input type="text" class="form-control mb-2 mr-sm-2" name="name" id="name" placeholder="Nombre" value="{{app('request')->input('name')}}">
					</div>

					<label class="sr-only" for="email">Email</label>
					<div class="input-group mb-2 w-35">
						<input type="text" class="form-control mb-2 mr-sm-2" name="email" id="email" placeholder="Email" value="{{app('request')->input('email')}}">
					</div>

					<div class="input-group mb-2 w-30">
					<a href="{{route('users.index')}}" class="btn btn-default mb-2 mr-1"> <i class="far fa-trash-alt"></i> Limpiar</a>
					<button type="submit" class="btn btn-primary mb-2 w-90"><i class="fas fa-search"></i> Buscar</button>
					</div>
				</form>
			</div>

			<table class="table table-sm table-hover">
				<thead>
					<tr>
					<th class="w-5">#ID</th>
					<th class="w-30">Nombre Completo</th>
					<th class="w-25">Contacto</th>
					<th class="w-15">Roles</th>
					<th class="w-10 text-right">Registrado</th>
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
						<p class="mb-0">{{$user->email}}</p>
						<span class="text-muted" style="font-size: 13px"><b>Tel: </b>{{$user->codigo_tel_pais}} {{$user->telefono}}</span>
					</td>
					<td>
						@foreach($user->roles as $role)
							@if($role->id == 1)
							<span class="badge badge-dark">{{$role->display_name}}</span>
							@else
							<span class="badge badge-primary">Estudiante</span>
							@endif
						@endforeach
					</td>
					<td class="text-right">{{$user->created_at->format('Y-m-d')}}</td>
					<td class="text-right">
							<a href="{{route('users.edit', $user->id)}}" type="submit" class="btn btn-sm btn-info" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></a>
					</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop

@section('script')

@stop