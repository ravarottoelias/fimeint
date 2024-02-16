@extends('admin.layout')

@section('content')
<style type="text/css">
	body{
		line-height: 1.15;
	}
	.tabla-cursos-index{
		font-size: 15px;
	}
</style>

@php
	$category = \App\Categoria::where('slug', app('request')->input('category'))->first();
@endphp

	<h1 class="mt-4">{{$category->nombre}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{$category->nombre}}</li>
    </ol>


  	<div class="d-flex justify-content-end mb-2">
  		<a class="btn btn-primary" href="{{ route('post_admin.create') }}?category=rse"><i class="fas fa-plus"></i> Nuevo</a>
  	</div>
    <table class="table table-sm table-hover tabla-cursos-index">
	    <thead>
		    <tr>
		      <th class="w-70">Título</th>
		      <th class="w-10">Estado</th>
		      <th class="w-10">Creado</th>
		      <th class="w-10 text-right"></th>
		    </tr>
	    </thead>
	    <tbody>
	    @foreach($posts as $post)
		    <tr>
		      <td>
		      	<p class="mb-1">{{$post->titulo}}</p>
		      	<span class="text-muted">{{ $post->categoria->nombre }}</span>
		      </td>
		      <td>{{$post->status}}</td>
		      <td>{{$post->created_at->format('d-M-Y')}}</td>
		      <td class="d-flex" style="justify-content: space-around;">
	            <a href="{{ route('post_admin.edit', $post->id) }}" class="btn btn-sm btn-info" title="Editar post"><i class="fas fa-pencil-alt"></i></a>
		        <form action="{{ url('post_admin', ['id' => $post->id]) }}" method="post">
		            {!! method_field('delete') !!}
		            {!! csrf_field() !!}
		            <button type="submit" onclick="return confirm('Desea eliminar el post seleccionado?')" class="btn btn-sm btn-danger" title="Eliminar post"><i class="fa fa-trash"></i></button>
		        </form>
		      </td>
		      @endforeach
		    </tr>
	    </tbody>
    </table>


@stop