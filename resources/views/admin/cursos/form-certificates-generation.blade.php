@extends('admin.layout')

@section('content')

<h1 class="mt-4">Cursos</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/cursos">Cursos</a></li>
    <li class="breadcrumb-item">{{ $curso->titulo }}</li>
    <li class="breadcrumb-item active">Generación de certificados</li>
</ol>
<div class="card mb-4">
    <div class="card-body"> 
        <h3 class="mb-3">Generación de certificados</h3>    
            
            @include('admin.includes.flashmessage')

            @if (session('result'))
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
            @endif 
            
            <div class="row my-4">
                <div class="col-lg-10 col-12">
                    <form action="{{ route('curso_cert_generation', $curso->id) }}" method="POST" enctype="multipart/form-data" files="true">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" name="excel_file" id="file_excel" aria-describedby="file_excel">
                            <label class="custom-file-label" for="file_excel">Seleccionar excel</label>
                            </div>
                            <div class="input-group-append">
                            <button class="btn btn-success" type="submit" onclick="submit_form_cert_generation" id="file_excel">Procesar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop
