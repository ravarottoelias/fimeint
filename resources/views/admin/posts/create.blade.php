@extends('admin.layout')

@section('content')

@php
	$category = \App\Categoria::where('slug', app('request')->input('category'))->first();
@endphp

<div class="card border-info">
	<form action="{{ route('post_admin.store') }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
		{{ csrf_field() }}
		<input type="number" name="categoria_id" value="{{$category->id}}" class="d-none">
	    <div class="card-header">
	        <strong class="card-title">Nuevo</strong>
	    </div>
	    <div class="card-body">
	    	@include('admin.posts.form')
	    </div>
	    <div class="card-footer text-right">
	    	<a href="{{ route('post_admin.index')}}?category=rse" class="btn btn-default mr-3">Atras</a>
	    	<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
	    </div>
	    
  	</form>
</div>
@stop

