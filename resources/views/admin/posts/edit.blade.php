@extends('admin.layout')

@section('content')

<div>

	<h1 class="mt-4">{{ $post->categoria->nombre }}</h1>
	
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">{{ $post->categoria->nombre }}</li>
	</ol>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title"></strong>
    </div>
    <div class="card-body">
    	<form action="{{ route('post_admin.update', $post->id) }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">
			
            @include('admin.posts.form')

            <div class="card-footer text-right">
                <a href="{{ route('post_admin.index')}}?category={{ $post->categoria->slug }}" class="btn btn-default mr-3">Atras</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            </div>
      	</form>
    </div>
</div>

@stop

