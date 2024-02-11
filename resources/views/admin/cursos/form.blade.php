
<div class="card-body">
	<div class="wrapper">
		<div class="tabs-curso cf">
			<input type="radio" name="tabs-curso" id="tab1" checked>
			<label for="tab1" class="tab-label">
	        	<i class="fas fa-pencil-alt"></i> Curso
	      	</label>
			<input type="radio" name="tabs-curso" id="tab2" @if(!$curso->id) disabled @endif>
			<label for="tab2" class="tab-label">
		        <i class="fa fa-cog"></i> Avanzado
	      	</label>
			<input type="radio" name="tabs-curso" id="tab3" @if(!$curso->id) disabled @endif>
			<label for="tab3" class="tab-label">
		        <i class="fa fa-users"></i> Inscriptos
	      	</label>

			<div id="tab-content1" class="tab-content">
				@include('admin.cursos.form-basic')
			</div>
			<div id="tab-content2" class="tab-content">
				@include('admin.cursos.form-avanzado')
			</div>
			<div id="tab-content3" class="tab-content">
				@include('admin.cursos.form-inscripciones')
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
</div>

