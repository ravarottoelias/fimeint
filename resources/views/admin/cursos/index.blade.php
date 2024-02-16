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
	<h1 class="mt-4">Cursos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
  	
	<div class="d-flex justify-content-end mb-2">
  		@if($categoria_id == 1) <!-- Oferta académica -->
	  		<a class="btn btn-primary" href="{{ route('cursos.create') }}"><i class="fas fa-plus"></i> Nuevo</a>
  		@endif
  		@if($categoria_id == 2)<!-- Noticias y novedades -->
	  		<a class="btn btn-primary" href="{{ route('cursos.create') }}?categoria_id=2"><i class="fas fa-plus"></i> Nuevo</a>
  		@endif
  	</div>
    <table class="table table-sm table-hover tabla-cursos-index">
	    <thead>
		    <tr>
		      <th class="w-50">Título y Descripción</th>
		      <th class="w-20">Categoría</th>
		      <th class="w-10">Creado</th>
		      <th class="w-10">Actualizado</th>
		      <th class="text-right"></th>
		    </tr>
	    </thead>
	    <tbody>
	    @foreach($cursos as $curso)
		    <tr>
		      <td>
		      	<p class="mb-0">{{$curso->titulo}}</p>
		      	<span class="text-muted" style="font-size: 13px">{{substr($curso->descripcion, 0, 110)}} ... </span>
		      </td>
		      <td>{{$curso->categoria->nombre}}</td>
		      <td>{{$curso->created_at->format('d-m-Y')}}</td>
		      <td>{{$curso->updated_at->format('d-m-Y')}}</td>
		      <td class="d-flex" style="justify-content: space-around;">
	            <a href="{{ route('show_post', $curso->slug) }}" class="btn btn-sm btn-outline-secondary" title="Ver curso" target="_blank"><i class="fas fa-eye"></i></a>
	            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-outline-primary" title="Editar curso"><i class="fas fa-pencil-alt"></i></a>
		        <form action="{{ url('cursos', ['id' => $curso->id]) }}" method="post">
		            {!! method_field('delete') !!}
		            {!! csrf_field() !!}
		            <button type="submit" onclick="return confirm('Desea eliminar el curso seleccionado?')" class="btn btn-sm btn-danger" title="Eliminar curso"><i class="fa fa-trash"></i></button>
		        </form>
		      </td>
		      @endforeach
		    </tr>
	    </tbody>
    </table>


@stop