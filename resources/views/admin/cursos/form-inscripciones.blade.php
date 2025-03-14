@php
  $pagado = \App\Inscripcion::PAGADO;
  $pendiente = \App\Inscripcion::PENDIENTE;
@endphp
<div class="row mb-5">
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

<div class="row">
  <div class="col-12">
    <div class="form-inline">
      <div class="form-group mb-2 w-100">
        <label for="input-filter" class="sr-only">Email, Nombre o Apellido</label>
        <input type="text" class="form-control w-100" id="input-filter-inscriptos" placeholder="Email, Nombre o Apellido">
      </div>
    </div>
  </div>
</div>

<table class="table table-hover table-sm" id="inscriptos-table">
  <thead>
    <tr>
      <th scope="col">Alumno</th>
      <th scope="col">Fecha Insc.</th>
      <th scope="col">Pago</th>
      <th scope="col">Detalles</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
	@foreach($curso->inscripciones as $i)
    <tr id="tr-inscripcion_id-{{$i->id}}">
      <td id="td-alumno-{{$i->id}}">
        <p class="mb-0">{{$i->alumno->fullName()}}</p>
        <span class="text-muted" style="font-size: 13px; font-weight: 500">{{$i->alumno->email}}</span>
      </td>
      <td id="td-created_at-{{$i->id}}">{{$i->created_at->format('Y-m-d H:i')}}</td>
      <td id="td-estado_del_pago-{{$i->id}}">
        @if($i->estado_del_pago == \App\Inscripcion::PAGADO) 
          <span class="badge badge-pill badge-success">{{$i->estado_del_pago}}</span>
        @endif
        @if($i->estado_del_pago == \App\Inscripcion::PAGADO_PARCIAL) 
         <span class="badge badge-pill badge-warning">{{$i->estado_del_pago}}</span>
        @endif
        @if($i->estado_del_pago == \App\Inscripcion::PENDIENTE) 
         <span class="badge badge-pill badge-dark">{{$i->estado_del_pago}}</span>
        @endif
      </td>
      <td id="td-mercadopago-status-{{$i->id}}">
          <a href="{{ route('inscription_show', $i->id) }}"> Ver </a>
      </td>
      <td id="td-actions-{{$i->id}}">
        @if ($i->ms_certificate_id != null)
          <a href="{{ route('certificates_show', $i->ms_certificate_id)}}" class="btn btn-success btn-sm" title="Ver Certificado"><i class="fas fa-certificate"></i></a>  
        @else
          <a href="{{ route('certificates_create_step_two', ['inscripcionId' => $i->id])}}" class="btn btn-primary btn-sm" title="Generar Certificado"><i class="far fa-file-alt"></i></a>
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