@extends('layouts.myaccount')

@section('content')

<ol class="breadcrumb my-4">
    <li class="breadcrumb-item"><a href="{{ route('my_panel', Auth::user()->id) }}">Inicio</a></li>
    <li class="breadcrumb-item active">Mis Cursos</li>
</ol>

<div class="list-group">
    @foreach ($inscriptions as $i)
        @if(isset($i->curso) && $i->curso) 
        <a href="#" class="list-group-item list-group-item-action ">
            <div class="row">
                <div class="col-9 px-2">
                    <h5 class="mb-1">{{ $i->curso->titulo }}</h5>
                </div>
                <div class="col-3 px-2 d-flex justify-content-end">
                    <small>{{ $i->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="row">
                <div class="col-12 px-2">
                    <p class="mb-1">{{ $i->curso->categoria->nombre }}</p>
                    <span class="badge 
                        {{ $i->curso->estado == 'Finalizado' ? 'badge-success' : 'badge-primary' }}
                    ">
                        {{ $i->curso->estado }}
                    </span>
                </div>
            </div>
        </a>
        @endif
    @endforeach
    
  </div>

  @stop