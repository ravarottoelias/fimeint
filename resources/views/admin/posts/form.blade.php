<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group requerido">
					<label class="control-label mb-1">Título</label>
					<input name="titulo" type="text" class="form-control @if ($errors->first('titulo')) is-invalid @endif" value="{{ $post->titulo or old('titulo') }}">
					<div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group requerido">
					<label class="control-label mb-1">Categoría</label>
					<select class="form-control" name="categoria_id" required>
					@if( $post->id )
					 	@foreach( $categorias as $categoria )
						  	<option value="{{$categoria->id}}" @if($post->categoria_id == $categoria->id ) selected @endif >{{$categoria->nombre}}</option>
						@endforeach
					@else
						@foreach( $categorias as $categoria )
						  	<option value="{{$categoria->id}}" @if(request()->get('category') == $categoria->slug ) selected @endif >{{$categoria->nombre}}</option>
						@endforeach
					@endif
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group requerido">
					<label class="control-label mb-1">Estado</label>
					@php
			 			$estado_en_curso = \App\Curso::ESTADO_EN_CURSO;
			 			$estado_finalizado = \App\Curso::ESTADO_FINALIZADO;
			 		@endphp
					<select class="form-control" name="status" required>
						<option value="{{ $estado_en_curso }}" @if ($post->status == $estado_en_curso) selected @endif>{{ $estado_en_curso }}</option>
						<option value="{{ $estado_finalizado }}" @if ($post->status == $estado_finalizado) selected @endif>{{ $estado_finalizado }}</option>
					</select>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group requerido">
			<div class="invalid-feedback">{{ $errors->first('foto') }}</div>
			<div id="div_file" class="dropzone d-flex justify-content-center align-items-center flex-column">
			 	@php
					$portadaWeb = $post->portadas->first();
			 		if ($portadaWeb != null) {
			 			$src = Storage::disk('uploads')->url($portadaWeb->path);
			 		}else{ $src = '/images/default.png'; }
			 	@endphp
				<p>Portada WEB</p>
			 	<img id="previewWeb" class="box-shadow-1" style="border-radius: 5px; height: 100px" src="{{ $src }}">
			    <input type='file' id="portadaWeb" name="foto[]" multiple accept='image/*'>
			 </div>

		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group requerido">
			<div class="invalid-feedback">{{ $errors->first('foto') }}</div>
			<div id="div_file" class="dropzone d-flex justify-content-center align-items-center flex-column">
			 	@php
					$portadaMobile = $post->portadas->slice(1, 1)->first();
			 		if ($portadaMobile != null) {
			 			$src = Storage::disk('uploads')->url($portadaMobile->path);
			 		}else{ $src = '/images/default.png'; }
			 	@endphp
				<p>Portada Mobile</p>
			 	<img id='previewMobile' class="box-shadow-1" style="border-radius: 5px; height: 100px" src="{{ $src }}">
			    <input type='file' id="portadaMobile" name="foto[]" multiple id="file" accept='image/*' onchange='openFile(event)'>
			 </div>
		</div>
	</div>
</div>




<div class="row">
	<div class="col-md-12">
		<label class="control-label mb-1">Contenido</label>
		<textarea name="contenido" class="form-control @if ($errors->first('contenido')) is-invalid @endif" id="editor1">
			{{ $post->contenido or old('contenido') }}
		</textarea>
		<div class="invalid-feedback">{{ $errors->first('contenido') }}</div>
	</div>
</div>



@section('script')
<script type="text/javascript">
	function readyFn( jQuery ) {
    	//CKEDITOR Configuracion
        CKEDITOR.replace( 'editor1', {
		  extraAllowedContent: 'a[data-*]; h1[data-*]; h2[data-*]; h3[data-*]; h4[data-*]; h5[data-*]; button[data-*]; button[aria-*] ',
		  allowedContent: {
                script: true,
                div: true,
                $1: {
                    // This will set the default set of elements
                    elements: CKEDITOR.dtd,
                    attributes: true,
                    styles: true,
                    classes: true
                }
            }
		});
		CKEDITOR.dtd.$removeEmpty['i'] = false;

	


        $("html").css({"overflow-y": "hidden"});

        //SELECT2 Permitir tags
        $(".tags-select").select2({
	      tags: true,
	    });
   }

	$( document ).ready(readyFn);

	function previewImage(inputId, previewId) {
    document.getElementById(inputId).addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById(previewId).src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
}

previewImage('portadaWeb', 'previewWeb');
previewImage('portadaMobile', 'previewMobile');
</script>
@stop