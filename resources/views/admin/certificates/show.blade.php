@extends('admin.layout')

@section('content')

<h1 class="mt-4">Certificados</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certificates') }}">Certificados</a></li>
    <li class="breadcrumb-item active">ID#{{ $certificate->id }}</li>
</ol>
@include('admin.includes.flashmessage')

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#basic"> Vista General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#details">Detalles</a>
    </li>
</ul>
<div class="card mb-3">
    <div class="card-body">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="basic">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="mx-1"><a href="{{ route('certificates_delete', $certificate->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a></div>
                        <div class=""><a href="#" class="btn btn-primary"><i class="far fa-file-pdf"></i> Ver</a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10 col-md-3 text-center">
                    <img class="img-fluid" src="data:image/png;base64, {{ $qrcode }}" alt="Código QR">
                    <p class="text-center"><a href="{{ $qrDecoded }}">{{ $qrDecoded }}</a></p>
                </div>
                <div class="col-12 col-md-9">
    
                  <h3>{{ $certificate->alumnoNombreCompleto }}</h3>
                  <p><span>CUIT:</span> <strong>{{ $certificate->alumnoCuit }} </strong></p>
    
                  <h3>{{ $certificate->cursoNombre }}</h3>
                  <p><span>Fecha:</span> <strong>{{ $certificate->cursoFechaInicio }}</strong> / <strong>{{ $certificate->cursoFechaFin }}</strong> - <span class="">Total HS:</span> <strong>{{ $certificate->cursoTotalHs }}</strong></p>
    
                  <hr>  
                    
                  <h3>Certificado Nro: <strong>{{ $certificate->certificadoNumero }}</strong></h3>
                  <p>Habilitacion Nro: <strong>{{ $certificate->habilitacionNumero }}</strong> - Tomo/Folio: <strong>{{ $certificate->tfCertificadoNumero }}</strong></p>
                  <p class="text-muted">Creado: {{ $certificate->createdAt }} - Actualizado: {{ $certificate->updatedAt }}</p>
                    
                    
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="details">
            @if ($inscription == null)
            <div class="alert alert-dismissible alert-light">
                <strong>Algo anda mal!</strong> No se encontró inscripcion del alumno al curso {{ $certificate->cursoNombre }}
            </div>
            @else
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Alumno</h5>
                        <small>#{{ $inscription->user_id }}</small>
                    </div>
                    <p class="mb-1">{{ $inscription->alumno->fullName()}} - Cuit:  {{ $inscription->alumno->cuit }} - Email: {{ $inscription->alumno->email }}</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Curso</h5>
                            <small class="text-muted">#{{ $inscription->curso_id }}</small>
                        </div>
                        <p class="mb-1">{{ $inscription->curso->titulo }} - Fecha: {{ $inscription->curso->fecha_inicio }} al {{ $inscription->curso->fecha_inicio }}</p>
                        
                    </a>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Inscripción</h5>
                            <small class="text-muted">#{{ $inscription->id }}</small>
                        </div>
                        <p class="mb-1">Pago: {{ $inscription->estado_del_pago }} - Certificado ID: {{ $inscription->ms_certificate_id }} - Creado en: {{ $inscription->created_at }}</p>
                        
                    </a>
                </div>
            @endif
        </div>
    
    </div>
</div>

@stop
