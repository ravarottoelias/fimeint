@extends('admin.layout')

@section('content')


<ol class="breadcrumb my-3">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/cursos">Cursos</a></li>
    <li class="breadcrumb-item">{{ $curso->titulo }}</li>
    <li class="breadcrumb-item active">Generación de certificados</li>
</ol>
<h2>CURSOS</h2>
<p>Generación de certificados por lote. {{ $curso->titulo }}</p>
@include('admin.includes.flashmessage')
@if (session('result'))
    <div class="card mb-4">
        <div class="card-body">   
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="alert alert-dismissible alert-light">
                        <span class="badge badge-primary badge-pill">{{ count(session('result')->success) }}</span> Registros procesados con éxitos.
                        <ul class="mb-0">
                            @foreach (session('result')->success as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="alert alert-dismissible alert-light">
                        <span class="badge badge-danger badge-pill">{{ count(session('result')->fails) }}</span> Registros fallidos.
                        <ul class="mb-0">
                            @foreach (session('result')->fails as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif 
            

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-primary mb-3"">
            <div class="card-header"><i class="fas fa-certificate"></i> Generación de certificados</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Último número certificado</label>
                            <input type="number" value="{{ $settings['last_certificate_number'] }}" class="form-control" name="last_certificate_number">
                            <small id="emailHelp" class="form-text text-muted">El próximo certificado a crear usará éste valor.</small>
                        </div>
                    </div>
                </div>
                <form action="{{ route('curso_cert_generation', $curso->id) }}" method="POST" enctype="multipart/form-data" files="true">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Cantidad folios por tomo</label>
                                <input type="number" value="{{ $settings['quantity_folio_por_tomo'] }}" class="form-control" name="quantity_folio_por_tomo" required>
                                <small id="emailHelp" class="form-text text-muted">Cantidad de folios que posee el tomo actual.</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Último número tomo</label>
                                <input type="number" value="{{ $settings['last_certificate_tomo'] }}" class="form-control" name="last_certificate_tomo" required>
                                <small id="emailHelp" class="form-text text-muted">El próximo certificado a crear usará éste valor de tomo.</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Último número folio</label>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="number" value="{{ $settings['last_certificate_folio'] }}" class="form-control" name="last_certificate_folio" required>
                                    </div>
                                    <div class="col-1 d-flex justify-content-center align-items-center">
                                        Y
                                    </div>
                                    <div class="col-5">
                                        <input type="number" value="{{ $settings['last_certificate_folio'] +1 }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">El próximo certificado a crear usará éstos valores de folios.</small>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        </div> --}}

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="excel_file" aria-describedby="file_excel" required>
                            <label class="custom-file-label" for="file_excel">Seleccionar excel</label>
                        </div>
                        
                        
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-success" type="submit" onclick="submit_form_cert_generation"><i class="fas fa-arrow-right"></i> Procesar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        
 


@stop

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.querySelector('.custom-file-input');
        fileInput.addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name || 'Seleccionar excel';
            const label = e.target.nextElementSibling;
            if (label) {
                label.textContent = fileName;
            }
        });
    });
    </script>
@stop