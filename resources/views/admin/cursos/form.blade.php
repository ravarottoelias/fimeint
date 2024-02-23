
@if($errors->any())
<div class="alert alert-danger" role="alert">
    {!! implode('', $errors->all('<div><i class="fa-regular fa-circle-xmark"></i> :message</div>')) !!}
  </div>
@endif
	<div class="row">
		<div class="col-12">
			<div class="list-group list-group-horizontal" id="list-tab-curso" role="tablist">
				<a class="list-group-item list-group-item-action active" id="list-form-curso" data-toggle="list" href="#list-home" role="tab" aria-controls="home"><i class="fas fa-pencil-alt"></i> Curso</a>
				<a class="list-group-item list-group-item-action" id="list-form-avanzado" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="fa fa-cog"></i> Avanzado</a>
				<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages"><i class="fa fa-users"></i> Inscriptos</a>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
		  <div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade py-3 show active" id="list-home" role="tabpanel" aria-labelledby="list-form-curso">@include('admin.cursos.form-basic')</div>
			<div class="tab-pane fade py-3" id="list-profile" role="tabpanel" aria-labelledby="list-form-avanzado">@include('admin.cursos.form-avanzado')</div>
			<div class="tab-pane fade py-3" id="list-messages" role="tabpanel" aria-labelledby="list-form-inscriptos">@include('admin.cursos.form-inscripciones')</div>
		  </div>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-12">
			<a href="{{ URL::previous() }}" class="btn btn-secondary">
			  Cancelar
			</a>
			<button type="submit" class="btn btn-success">
			  Guardar
			</button>
		</div>
	</div>


