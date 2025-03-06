@extends('admin.layout')

@section('content')

<h1 class="mt-4">Certificados</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certificates') }}">Certificados</a></li>
    <li class="breadcrumb-item active">#{{ $certificate->id }}</li>
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
            <div class="col-12 col-md-3">
                <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/3/31/MM_QRcode.png" alt="">
            </div>
            <div class="col-12 col-md-9">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <th scope="row">QR</th>
                        <td>{{ $certificate->codigoQr }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Alumno</th>
                        <td>{{ $certificate->alumnoNombreCompleto }}</td>
                    </tr><tr>
                        <th scope="row">CUIT</th>
                        <td>{{ $certificate->alumnoCuit }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Curso</th>
                        <td>{{ $certificate->cursoNombre }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha Curso</th>
                        <td>{{ $certificate->cursoFecha }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Creado / Actualizado</th>
                        <td>{{ $certificate->createdAt }} / {{ $certificate->updatedAt }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
@stop
