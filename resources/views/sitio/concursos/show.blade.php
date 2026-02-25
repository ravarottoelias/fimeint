@extends('sitio.layout')

@section('title_and_meta')
    <title>Alianza Fundación Instituto de Mediación y Portal Todo Sobre Mediación</title>
    <meta name="description" content="Alianza Fundación Instituto de Mediación y Portal Todo Sobre Mediación">
@stop

@section('mark-up-facebook')
@stop

@section('styles')

@stop


@section('content')

<div>
    @include('sitio.concursos.show-content', [ "concurso" => $post ])
</div>

@stop