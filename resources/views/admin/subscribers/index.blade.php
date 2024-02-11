@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <table class="table table-sm table-hover">
	    <thead>
		    <tr>
		      <th class="w-5">#ID</th>
		      <th class="w-20">Teléfono</th>
		      <th class="w-20">Email</th>
		      <th class="w-10">Subscripto</th>
		    </tr>
	    </thead>
	    <tbody>
	    @foreach($subscribers as $s)
		    <tr>
		      <td>{{$s->id}}</td>
		      <td>{{$s->telefono}}</td>
		      <td>{{$s->email}}</td>
		      <td>{{$s->created_at->format('Y-m-d H:m')}}</td>
		      @endforeach
		    </tr>
	    </tbody>
    </table>
  </div>
</div>

@stop