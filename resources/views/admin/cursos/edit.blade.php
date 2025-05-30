@extends('admin.layout')

@section('stylesheet')
<style type="text/css">

.icon2 {
    width: 3rem;
    height: 3rem;
}
.indicator-icon{
    font-size: 1.5rem;
}
.fs-11{
    font-size: 11px;
}
</style>
@stop

@section('content')

<h1 class="mt-4">Cursos</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/cursos">Cursos</a></li>
    <li class="breadcrumb-item active">{{ $curso->titulo }}</li>
</ol>
<div class="card mb-4">
    <div class="card-body">            
            @include('admin.includes.flashmessage')
            <form action="{{ route('cursos.update', $curso->id) }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include('admin.cursos.form')
              </form>
        </div>
    </div>


@stop


