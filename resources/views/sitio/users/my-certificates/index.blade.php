@extends('layouts.myaccount')

@section('content')

<ol class="breadcrumb my-4">
    <li class="breadcrumb-item"><a href="{{ route('my_panel', Auth::user()->id) }}">Inicio</a></li>
    <li class="breadcrumb-item active">Mis Certificados</li>
</ol>

<div class="list-group mb-4">
    @forelse ($certificates->data as $cert)
         
    <a href="{{ route('public_certificates_pdf', $cert->uuid) }}" target="_blank" class="list-group-item list-group-item-action ">
        <div class="row">
            <div class="col-9 px-2">
                <h5 class="mb-1">{{ $cert->cursoNombre }}</h5>
            </div>
            <div class="col-3 px-2 d-flex justify-content-end">
                <small>{{ $cert->createdAt }}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-2">
                <p class="mb-1">Fecha Curso: {{ $cert->cursoFechaInicio }} al {{ $cert->cursoFechaFin }}</p>
                <span class="badge badge-dark">
                    Nro: {{ $cert->certificadoNumero }}
                </span>
            </div>
        </div>
    </a>
    @empty
    <div class="alert alert-dismissible alert-light">
        <strong>Nada por aqui!</strong> No se encontraron certificados.
    </div>
    @endforelse
    
  </div>

  @stop