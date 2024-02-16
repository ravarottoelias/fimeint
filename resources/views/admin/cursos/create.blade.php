@extends('admin.layout')

@section('content')
	
	<h1 class="mt-4">Cursos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/cursos">Cursos</a></li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>

	<div class="card mb-4">
        <div class="card-body"> 
			<form action="{{ route('cursos.store') }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
				{{ csrf_field() }}
				@include('admin.cursos.form')
			</form>
		</div>
	</div>
@stop

