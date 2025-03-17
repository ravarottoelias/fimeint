@section('stylesheet')
<style>
	.datepicker td, .datepicker th {
    width: 1.5em;
    height: 1.5em;
}
	</style>
@stop
@php
	$estado_proximo = \App\Curso::ESTADO_PROXIMO;
	$estado_en_curso = \App\Curso::ESTADO_EN_CURSO;
	$estado_finalizado = \App\Curso::ESTADO_FINALIZADO;
	$publicado = \App\Curso::PUBLICADO;
	$no_publicado = \App\Curso::NO_PUBLICADO;
@endphp

<div class="row">


	<div class="col-12 col-md-8">
		<div class="row px-3">
			<div class="col-12 col-md-4">
				<label class="control-label mb-1">Fecha Inicio</label>
				<div class="input-group date">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
					</div>
					<input type="text" class="form-control" value="{{ $curso->fecha_inicio or old('fecha_inicio') }}" name="fecha_inicio" id="datepicker">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<label class="control-label mb-1">Fecha Fin</label>
				<div class="input-group date">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
					</div>
					<input type="text" class="form-control" value="{{ $curso->fecha_fin or old('fecha_fin') }}" name="fecha_fin" id="datepicker2">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<label class="control-label mb-1">Total Hs</label>
				<div class="input-group date">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="far fa-clock"></i></div>
					</div>
					<input type="text" class="form-control" value="{{ $curso->total_hs or old('total_hs') }}" name="total_hs" id="datepicker">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mb-3 px-3">
	<div class="col-12">
		<div class="form-group">
			<label class="control-label mb-1">Homologación</label>
			<input type="text" class="form-control" value="{{ $curso->curso_homologacion or old('curso_homologacion') }}" name="curso_homologacion">
		</div>
	</div>

	<div class="col-12">
		<div class="form-group">
			<label for="cuerpoCertificadoTextarea">Cuerpo Certificado</label>
			<textarea class="form-control" id="cuerpoCertificadoTextarea" rows="3" name="cuerpo_certificado"></textarea>
			<small id="fileHelp" class="form-text text-primary">Variables disponibles: <strong>%ALUMNO%</strong> (Nombre completo del alumno). <strong>%DNI%</strong> (DNI del alumno). <strong>%CURSO%</strong> (Título del curso) <strong>%TOTAL_HS%</strong></small>
		</div>
	</div>

</div>

<div class="row px-3">
	<div class="col-12">

		<h3>Generación masiva de certificados</h3>
		<p>El curso debe estar finalizado para que la generación de certificados</p>
		<a class="btn btn-primary" href="{{ route('curso_cert_generation_form', $curso->id) }}">Continuar</a>
	</div>
</div>
