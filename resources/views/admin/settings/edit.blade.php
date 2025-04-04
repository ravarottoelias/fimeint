@extends('admin.layout')

@section('content')

<h1 class="mt-4">Ajustes</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ajustes</li>
</ol>

@include('admin.includes.flashmessage')

<div class="row mb-4">
    <div class="col-12">
        <form action="{{ route('settings') }}" method="POST">
            {{ csrf_field() }}
            <div class="card border-primary mb-3"">
                <div class="card-header"><i class="fas fa-certificate"></i> CERTIFICADOS</div>
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
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Cantidad folios por tomo</label>
                                <input type="number" value="{{ $settings['quantity_folio_por_tomo'] }}" class="form-control" name="quantity_folio_por_tomo">
                                <small id="emailHelp" class="form-text text-muted">Cantidad de folios que posee el tomo actual.</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Último número tomo</label>
                                <input type="number" value="{{ $settings['last_certificate_tomo'] }}" class="form-control" name="last_certificate_tomo">
                                <small id="emailHelp" class="form-text text-muted">El próximo certificado a crear usará éste valor de tomo.</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Último número folio</label>
                                <input type="number" value="{{ $settings['last_certificate_folio'] }}" class="form-control" name="last_certificate_folio">
                                <small id="emailHelp" class="form-text text-muted">El próximo certificado a crear usará éste valor de folio.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
        </form>
    </div>
</div>




@stop
