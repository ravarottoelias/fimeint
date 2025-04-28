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



<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="row ">
					<div class="col-12 col-md-8">
						<div class="form-group requerido">
							<label class="control-label mb-1">Estado</label>
							<select class="form-control"  name="estado">
								<option>Seleccionar</option>
								<option value="{{$estado_proximo}}" @if($curso->estado == $estado_proximo) selected @endif> {{$estado_proximo}} </option>
								<option value="{{$estado_en_curso}}" @if($curso->estado == $estado_en_curso) selected @endif> {{$estado_en_curso}} </option>
								<option value="{{$estado_finalizado}}" @if($curso->estado == $estado_finalizado) selected @endif> {{$estado_finalizado}} </option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group requerido">
							<label class="control-label mb-1">Publicado</label>
							<select class="form-control"  name="publicado">				 		
								<option value="{{$publicado}}" @if($curso->publicado == $publicado) selected @endif> SI </option>
								<option value="{{$no_publicado}}" @if($curso->publicado == $no_publicado) selected @endif> NO </option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-3">
			<div class="col-12">
				<h5>INSCRIPCIÓN Y PAGO</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group requerido">
							<label class="control-label mb-1">Permitir Inscripción</label>
							<select class="form-control"  name="permitir_inscripcion">
						 		<option value="1" @if($curso->permitir_inscripcion == 1) selected @endif> SI </option>
						 		<option value="0" @if($curso->permitir_inscripcion == 0) selected @endif> NO </option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							@php
								$interest = config('custom.payments.course_fee_tax')*100;
							@endphp
							<label class="control-label mb-1">Cantidad de cuotas</label>
							<select class="form-control"  name="cantidad_cuotas">
						 		<option value="1" @if($curso->cantidad_cuotas == 1) selected @endif> 1 x $ {{ App\Helpers\Utils::formatPrice($curso->unit_price) }} </option>
						 		<option value="2" @if($curso->cantidad_cuotas == 2) selected @endif> 2 x $ {{ App\Helpers\Utils::formatPrice($curso->calcularValorCuota()) }} ({{ $interest }} % de interés)</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<label class="control-label mb-1">Precio Unitario</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input name="unit_price" type="text" 
									class="form-control @if ($errors->first('unit_price')) is-invalid @endif" 
									value="{{ $curso->unit_price or old('unit_price') }}"
									placeholder="3500.50">
							<small id="unitPriceHelp" class="form-text text-muted">Precio sin separador de miles y separador de decimales con (.)</small>
							<div class="invalid-feedback">{{ $errors->first('unit_price') }}</div>
						</div>
					</div>
				</div>


			</div>
		</div>
		<div class="row">
			<div class="col-12">

				<div class="form-group">
					<label class="control-label mb-1">URL y Token</label>
					<div class="input-group">
						<input type="text" class="form-control" readonly value="https://fimeint.org/verificar-pago/{{$curso->token}}" id="curso-token">
						<div class="input-group-append">
						<button type="button" class="btn btn-secondary" onclick="copy()"><i class="fa fa-file-alt"></i> Copy</button>
						</div>
						</div>
						<small id="emailHelp" class="form-text text-muted">Pega esta URL en el botón de Mercadopago o Paypal para  registrar el pago.</small>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="card border-light mb-3">
					<div class="card-header">SCRIPT DE PAGOS</div>
					<div class="card-body">
						<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#scriptsPagosModal">
							<i class="fa fa-plus"></i> Nuevo
						</button>
						<div class="form-group form-group-link-pago requerido">
							<table class="table table-hover table-sm" style="border-bottom: 1px #e9ecef solid">
								<thead>
								<tr>
									<th scope="col">#Id</th>
									<th scope="col">Título</th>
									<th scope="col">Descripción</th>
									<th scope="col">Script</th>
									<th scope="col"></th>
								</tr>
								</thead>
								<tbody id="body-scripts-de-pagos">
									
								</tbody>
							</table>
						</div>				
					</div>
				  </div>
			</div>
		</div>
		
	</div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="scriptsPagosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">AGREGAR SCRIPT DE PAGO</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			{{ csrf_field() }}
			<input type="hidden" name="curso_id" value="{{$curso->id}}">
			<div class="row my-2">
				<div class="col-md-12">
					<div class="form-group">
						<input type="text" class="form-control" name="sp_titulo" value="" placeholder="Titulo" required>
					</div>
				</div>
			</div>
			<div class="row my-2">
				<div class="col-md-12">
					<div class="form-group">
						<input type="text" class="form-control" name="sp_descripcion" value="" placeholder="Descripción">
					</div>
				</div>
			</div>
			<div class="row my-2">
				<div class="col-md-12">
					<div class="form-group">
						<textarea name="sp_script" class="form-control" required>Script de pago</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" id="spCloseBtnModal" data-dismiss="modal">Cancelar</button>
		  <button type="button" class="btn btn-primary" onclick="guardarScriptDePago()">Guardar</button>
		</div>
	  </div>
	</div>
  </div>