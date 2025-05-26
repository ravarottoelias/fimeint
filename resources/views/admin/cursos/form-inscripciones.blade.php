@php
  $pagado = \App\Inscripcion::PAGADO;
  $pendiente = \App\Inscripcion::PENDIENTE;
@endphp
<div class="row mb-3">
  <div class="col-12 d-flex justify-content-end">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
      <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn btn-outline-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid #ccc">
          <i class="fas fa-download"></i> Descargar
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <a class="dropdown-item" href="{{route('export_inscriptos', $curso->id)}}?payment_status=all"><i class="far fa-file-excel"></i> Todos</a>
          <a class="dropdown-item" href="{{route('export_inscriptos', $curso->id)}}?payment_status={{$pagado}}"><i class="far fa-file-excel"></i> Pagados</a>
          <a class="dropdown-item" href="{{route('export_inscriptos', $curso->id)}}?payment_status={{$pendiente}}"><i class="far fa-file-excel"></i> No Pagados</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mb-3">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 d-flex justify-content-center align-items-center">
                      <div class="icon2 bg-primary text-white d-flex justify-content-center align-items-center">
                          <i class="fas fa-th-list"></i>
                      </div>
                    </div>
                  <div class="col">
                      <p class="card-title text-muted mb-0">Inscriptos</p>
                      <span class="h2 font-weight-bold mb-0">{{ $curso->inscripciones->count() }}</span>
                  </div>
                </div>
            </div>
          </div>
        </div>
    <div class="col-xl-3 col-lg-3 col-md-4">
        <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
            <div class="row">
                <div class="col-5 d-flex justify-content-center align-items-center">
                <div class="icon2 bg-success text-white d-flex justify-content-center align-items-center">
                    <i class="fas fa-dollar-sign indicator-icon"></i>
                </div>
                </div>
            <div class="col">
                <p class="card-title text-muted mb-0">Pagado</p>
                <span class="h2 font-weight-bold mb-0">{{ $inscriptionsIndicator['pagado'] }}</span>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4">
        <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
            <div class="row">
                <div class="col-5 d-flex justify-content-center align-items-center">
                <div class="icon2 bg-warning text-white d-flex justify-content-center align-items-center">
                    <i class="fas fa-dollar-sign indicator-icon"></i>
                </div>
                </div>
            <div class="col">
                <p class="card-title text-muted mb-0">Parcial</p>
                <span class="h2 font-weight-bold mb-0">{{ $inscriptionsIndicator['parcial'] }}</span>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4">
        <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
            <div class="row">
                <div class="col-5 d-flex justify-content-center align-items-center">
                <div class="icon2 bg-dark text-white d-flex justify-content-center align-items-center">
                    <i class="far fa-clock"></i>
                </div>
                </div>
            <div class="col">
                <p class="card-title text-muted mb-0">Pendiente</p>
                <span class="h2 font-weight-bold mb-0">{{ $inscriptionsIndicator['pendiente'] }} </span>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<div class="row my-2">
  <div class="col-12">
    <div class="form-inline">
      <div class="form-group w-100">
        <label for="input-filter" class="sr-only"><i class="fas fa-filter"></i> Filtrar</label>
        <input type="text" class="form-control w-100" id="input-filter-inscriptos" placeholder="Filtrar">
      </div>
    </div>
  </div>
</div>

<table class="table table-hover" id="inscriptos-table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">ALUMNO</th>
      <th scope="col">DNI</th>
      <th scope="col">INSCRIPCIÓN</th>
      <th scope="col">PAGO</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @php $c = 0 @endphp
	@foreach($curso->inscripciones as $i)
    @php $c++ @endphp
    <tr id="tr-inscripcion_id-{{$i->id}}">
      <td id="td-record-nro">
        {{ $c }}
      </td>
      <td id="td-alumno-{{$i->id}}">
        <p class="mb-0"><a href="{{ route('users.edit', $i->alumno->id) }}" target="_blank" class="text-decoration-none">{{ $i->alumno->fullName() }}</a></p>
        <span class="text-muted" style="font-size: 13px; font-weight: 500">{{$i->alumno->email}}</span>
      </td>
      <td id="td-dni-{{$i->id}}">
        {{ $i->alumno->documento_nro }}
      </td>
      <td id="td-created_at-{{$i->id}}">{{$i->created_at->format('Y-m-d H:i')}}</td>
      <td id="td-estado_del_pago-{{$i->id}}" class="text-center">
        @if($i->estado_del_pago == \App\Inscripcion::PAGADO) 
          <span class="badge badge-success">{{$i->estado_del_pago}}</span>
        @endif
        @if($i->estado_del_pago == \App\Inscripcion::PAGADO_PARCIAL) 
         <span class="badge  badge-warning">{{$i->estado_del_pago}}</span>
        @endif
        @if($i->estado_del_pago == \App\Inscripcion::PENDIENTE) 
         <span class="badge  badge-dark">{{$i->estado_del_pago}}</span>
        @endif
      </td>
      <td id="td-actions-{{$i->id}}" class="text-center">
        <a href="{{ route('inscription_show', $i->id) }}" class="btn btn-secondary btn-sm" title="Ver Inscripcón"><i class="fas fa-eye"></i></a>  
        @if ($i->ms_certificate_id != null)
          <a href="{{ route('certificates_show', $i->ms_certificate_id)}}" class="btn btn-success btn-sm" title="Ver Certificado"><i class="fas fa-certificate"></i></a>  
        @else
          <a href="{{ route('certificates_create_step_two', ['inscripcionId' => $i->id])}}" class="btn btn-secondary btn-sm" title="Generar Certificado"><i class="fas fa-certificate"></i></a>
        @endif
        <a href="#" class="btn btn-danger btn-sm" title="Eliminar Inscripción" onclick="eliminarInscripcion({{$i}})"><i class="fa fa-user-times"></i></a>
      </td>
    </tr>
	@endforeach
    
  </tbody>
</table>

<div class="modal" tabindex="-1" role="dialog" id="modalEditarInscripcion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Inscripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label >Alumno</label>
          <input type="text" class="form-control" readonly id="input-alumno" name="">
          <input type="hidden" id="inscripcion_id" value="">
        </div>
        <div class="form-group">
          <label >Estado del pago</label>
          <select class="form-control" id="select-estado-del-pago">
            <option value="{{\App\Inscripcion::PAGADO}}">{{\App\Inscripcion::PAGADO}}</option>
            <option value="{{\App\Inscripcion::PENDIENTE}}">{{\App\Inscripcion::PENDIENTE}}</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateInscripcion()">Save changes</button>
      </div>
    </div>
  </div>
</div>