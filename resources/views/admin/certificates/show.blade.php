@extends('admin.layout')

@section('content')

<h1 class="mt-4">Certificados</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certificates') }}">Certificados</a></li>
    <li class="breadcrumb-item active">ID#{{ $certificate->id }}</li>
</ol>
@include('admin.includes.flashmessage')

<div class="card">
	<div class="card-body">
        <div class="row">
            <div class="col">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="mx-1"><a href="{{ route('certificates_delete', $certificate->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a></div>
                    <div class=""><a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10 col-md-3 text-center">
                <img class="img-fluid" src="data:image/png;base64, {{ $qrcode }}" alt="Código QR">
                <p class="text-center">{{ $certificate->codigoQr }}</p>
            </div>
            <div class="col-12 col-md-9">

              <h3>{{ $certificate->alumnoNombreCompleto }}</h3>
              <p><span class="text-muted">CUIT:</span> <strong>{{ $certificate->alumnoCuit }} </strong></p>

              <h3>{{ $certificate->cursoNombre }}</h3>
              <p><span class="text-muted">Fecha:</span> <strong>{{ $certificate->cursoFechaInicio }}</strong> / <strong>{{ $certificate->cursoFechaFin }}</strong> - <span class="text-muted">Total HS:</span> <strong>{{ $certificate->cursoTotalHs }}</strong></p>

              <hr>  
                
              <h3>Certificado Nro: <strong>{{ $certificate->certificadoNumero }}</strong></h3>
              <p>Habilitacion Nro: <strong>{{ $certificate->habilitacionNumero }}</strong> - Tomo/Folio: <strong>{{ $certificate->tfCertificadoNumero }}</strong></p>
              <p class="text-muted">Creado: {{ $certificate->createdAt }} - Actualizado: {{ $certificate->updatedAt }}</p>
                
                
            </div>
        </div>
	</div>
</div>
@stop
