@extends('admin.layout')

@section('content')


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
                <a href="{{ route('post_admin.index')}}?category=rse" class="btn btn-default mr-3">Atras</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            </div>
      	</form>
    </div>
</div>

@stop

