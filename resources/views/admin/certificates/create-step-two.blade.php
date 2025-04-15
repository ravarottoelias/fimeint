@extends('admin.layout')

@section('content')

<h1 class="mt-4">Certificados</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certificates') }}">Certificados</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
</ol>
@include('admin.includes.flashmessage')

<div class="card mb-3">
	<div class="card-body">
        <legend>Confirmar Datos</legend>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <a href="{{ route('users.edit', $alumno->id) }}" class="btn btn-secondary"  target="_blank"><i class="fas fa-user"></i> Editar</a>
                        </div>
                        <input class="form-control" type="text" value="{{ $alumno->fullName() }} - DNI: {{ $alumno->documento_nro }}"  readonly>
                      </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-secondary" type="button" target="_blank"><i class="fas fa-graduation-cap"></i> Editar</a>
                        </div>
                        <input class="form-control" type="text" value="{{ $curso->titulo }}"  readonly>
                      </div>
                      @if ($inscripcion->pagado())
                                <span class="badge badge-success"><i class="fas fa-check"></i> {{ $inscripcion->estado_del_pago }}</span>
                            @else
                                <span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> Pago {{ $inscripcion->estado_del_pago }}</span>
                        @endif
                        @if ($curso->isFinalizado())
                            <span class="badge badge-success"><i class="fas fa-check"></i> Curso Finalizado</span>
                        @else
                            <span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> {{ $inscripcion->estado_del_pago }}</span>
                        @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" value="Inicio: {{ $curso->fecha_inicio }}"  readonly>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" value="Fin: {{ $curso->fecha_fin }}"  readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" value="Total HS: {{ $curso->total_hs }}"  readonly>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" type="text" value="Homologación: {{ $curso->curso_homologacion }}"  readonly>
                </div>
            </div>
        </div>
        
        <form action="{{ route('certificates_store') }}" method="POST"">
            {{ csrf_field() }}
            <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Certificado Número</label>
                        <input type="text" class="form-control" name="certificado_numero" value="{{ $certificado_nro or old('certificado_numero') }}" readonly>
                    </div>
                </div><div class="col-6">
                    <div class="form-group">
                        <label>Tomo y Folio</label>
                        <input type="text" class="form-control" name="tf_certificado_numero" value="{{$tomo_folio or old('tf_certificado_numero') }}" readonly>
                    </div>
                </div>
            </div>
            <div class="w-100">
                @if (!$inscripcion->pagado())
                <div class="alert alert-dismissible alert-warning">
                    <p class="mb-0"><i class="fas fa-exclamation-circle"></i> La inscripción no registra el total de los pagos. <a href="{{ route('inscription_show', $inscripcion->id) }}" target="_blank" class="alert-link">ver pagos</a>.</p>
                </div>
                @endif
                
                @if (!$curso->isFinalizado() || $curso->fecha_inicio == null || $curso->fecha_fin == null || $curso->total_hs == null || $curso->curso_homologacion == null)
                <div class="alert alert-dismissible alert-warning">
                    <p class="mb-0"><i class="fas fa-exclamation-circle"></i> El curso no se encuentra finalizado o faltan datos. <a href="/cursos/{{ $curso->id }}/edit" target="_blank" class="alert-link">ver detalles del curso</a>.</p>
                </div>
                @endif
            
            </div>
            <div class="w-100 d-flex justify-content-end">
                
                <button type="submit" class="btn btn-primary text-right">Generar</button>
            </div>
        </form>
       
	</div>
</div>
@stop

@section('script')

@stop
