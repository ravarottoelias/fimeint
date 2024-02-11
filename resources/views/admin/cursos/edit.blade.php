@extends('admin.layout')

@section('content')


<div class="card">
    <div class="card-header">
        <strong class="card-title">Editar curso</strong>
    </div>
    <div class="card-body">
    	<form action="{{ route('cursos.update', $curso->id) }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">
			@include('admin.cursos.form')
      	</form>
    </div>
</div>

@stop


