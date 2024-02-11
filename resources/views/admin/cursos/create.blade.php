@extends('admin.layout')

@section('content')
<div class="card">
	<form action="{{ route('cursos.store') }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
		{{ csrf_field() }}
	    <div class="card-header">
	        <strong class="card-title">Curso</strong>
	    </div>
	    @include('admin.cursos.form')
	    
  	</form>
</div>
@stop

