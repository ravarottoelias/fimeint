
		<div class="row">
			<div class="col-md-12">
				<div class="form-group requerido">
					<label class="control-label mb-1">Título</label>(*)
					<input name="titulo" type="text" class="form-control @if ($errors->first('titulo')) is-invalid @endif" value="{{ $curso->titulo or old('titulo') }}">
					<div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group requerido">
					<div class="invalid-feedback">{{ $errors->first('foto') }}</div>
					<div id="div_file" class="dropzone d-flex justify-content-center align-items-center flex-column">
						<img id='output' class="box-shadow-1" style="border-radius: 5px; height: 100px" src="{{Storage::disk('uploads')->url($curso->foto)}}" alt="">
						<p class="texto text-muted mt-2">Portada. Click o Arrastrar para cambiar la imagen.</p>
						<input type='file' name="foto" id="file" accept='image/*' onchange='openFile(event)'>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6">
						
							<label class="control-label mb-1">Categoría</label>(*)
							<select name="categoria_id" id="select-categoria" class="form-control">
								@foreach($categorias as $c)
									<option value="{{$c->id}}" @if($curso->categoria_id == $c->id || $request->categoria_id == $c->id) selected @endif>{{$c->nombre}}</option>
								@endforeach
							</select>
						
						<div class="invalid-feedback">{{ $errors->first('categoria_id') }}</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-lugar requerido">
							<label class="control-label mb-1">Lugar</label>
							<input name="lugar" type="text" class="form-control @if ($errors->first('lugar')) is-invalid @endif" value="{{ $curso->lugar or old('lugar') }}">
							<div class="invalid-feedback">{{ $errors->first('lugar') }}</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group requerido">
							<label class="control-label mb-1">Descripción</label>(*)
							<textarea name="descripcion" type="text" class="form-control @if ($errors->first('descripcion')) is-invalid @endif">{{ $curso->descripcion or old('descripcion') }}</textarea>
							<div class="invalid-feedback">{{ $errors->first('descripcion') }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group requerido">
					<label class="control-label mb-1">Etiquetas</label>
					<select class="tags-select form-control"  multiple="multiple" name="tags[]">
				 	@foreach( $tags as $tag )
					  	<option value="{{$tag->nombre}}" @if($curso->tags->contains('id', $tag->id)) selected @endif >{{$tag->nombre}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group requerido">
					<label class="control-label mb-1">Contenido</label>
					<textarea name="contenido" class="form-control" id="editor1">
						{{ $curso->contenido or old('contenido') }}
					</textarea>
					<div class="invalid-feedback">{{ $errors->first('contenido') }}</div>
				</div>
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-12">
				<div class="row px-3">
					<div class="col-md-12">
						<label>Adjuntar Archivos</label>
						<div class="content" id="content_dropzone"></div>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="form-group">
			<label for="document">Documents</label>
			<div class="needsclick dropzone" id="document-dropzone">
	
			</div>
		</div>



@section('script')
<script type="text/javascript">
	var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
            reader.onload = function(){
              var dataURL = reader.result;
              var output = document.getElementById('output');
              output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
    };

    //permitir tags select2
    $(".tags-select").select2({
      tags: true,
    });

    // mostrar u ocultar lugar dependiendo categoria del curso
    $('#select-categoria').on('change', function() {
      if (this.value == 1) {
        $('.form-group-lugar').show();
      }
      if (this.value == 2) {
        $('.form-group-lugar').hide();
      }
    });

    function readyFn( jQuery ) {
		fimeint.getScriptsDePagos();

    	//CKEDITOR Configuracion
        CKEDITOR.replace( 'editor1', {
		  extraAllowedContent: 'a[data-*]; h1[data-*]; h2[data-*]; h3[data-*]; h4[data-*]; h5[data-*]'
		} );
		 CKEDITOR.dtd.$removeEmpty['i'] = false;
        $("html").css({"overflow-y": "hidden"});

        // mostrar u ocultar lugar dependiendo categoria del curso
        var categoria_id = $('#select-categoria').val();
        if (categoria_id == 1) {
            $('.form-group-lugar').show();
        }
        if (categoria_id == 2) {
            $('.form-group-lugar').hide();
        }

        //Buscador de inscriptos
        $(function() {
		  $("#input-filter-inscriptos").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#inscriptos-table > tbody > tr").filter(function() { 
		    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});
        //END - Buscador de inscriptos

    }


    $( document ).ready(readyFn);


    // click en el tab de formulario avanzado
    let files = {!! $curso->files()->get() !!}


	const guardarScriptDePago = () => {
		fimeint.saveScriptDePago();	
	}

	const eliminarScriptDePago = (sp_id) => {
		fimeint.deleteScriptDePago(sp_id);
	}


	const editarInscripcion = (insc) => {
		$('#modalEditarInscripcion #input-alumno').val('');
		$('#modalEditarInscripcion #select-estado-del-pago').val('');
		$('#modalEditarInscripcion #inscripcion_id').val('');

		$('#modalEditarInscripcion #inscripcion_id').val(insc.id);
		$('#modalEditarInscripcion #input-alumno').val(insc.alumno.name);
		$('#modalEditarInscripcion #select-estado-del-pago').val(insc.estado_del_pago);
	}


    function copy() {
		var copyText = document.getElementById("curso-token");
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/
		document.execCommand("copy");
	}



	function updateInscripcion()
	{
		let inscripcion = {}

		inscripcion.id = $('#modalEditarInscripcion #inscripcion_id').val();
		inscripcion.pago = $('#modalEditarInscripcion #select-estado-del-pago').val();
		axios
			.post('/inscripcion_update_pago', inscripcion)
			.then(res=>{
				var i = res.data;
				var tr = `<td id="td-alumno-${i.id}">
				    			<p class="mb-0">${i.alumno.name}</p>
        						<span class="text-muted" style="font-size: 13px; font-weight: 500">${i.alumno.email}</span>
						      </td>
						      <td>${i.created_at}</td>
						      <td>
						        ${i.estado_del_pago}
						      </td>
						      <td>${i.fecha_del_pago}</td>
						      <td>
						        <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalEditarInscripcion" onclick="editarInscripcion(${i})"><i class="fa fa-edit" title="Editar Inscripcion"></i></a>
						        <a href="#" class="btn btn-danger btn-sm" title="Eliminar Inscripcion"><i class="fa fa-user-times"></i></a>
						      </td>`;
				$("#tr-inscripcion_id-"+i.id).html(tr);
				$('#modalEditarInscripcion').modal('toggle');
				
			})
	}

	function eliminarInscripcion(insc)
	{
		 var eliminar = confirm("Eliminar la inscripción seleccionada?");

        if (eliminar) {
			axios
			.post('/inscripcion_eliminar', insc)
			.then(res=>{
				$("#tr-inscripcion_id-"+insc.id).fadeOut("slow", function() {
			        $(this).remove();
			    });
			})
			.catch(err=>{
				alert('Algo salió mal. '+err)
			})
		}
	}

	var uploadedDocumentMap = {};
	new Dropzone("#document-dropzone",{
		url: '{{ route('projects.storeMedia') }}',
		maxFilesize: 10, // MB
		addRemoveLinks: true,
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},
		success: function (file, response) {
			$('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
			uploadedDocumentMap[file.name] = response.name
		},
		removedfile: function (file) {
			file.previewElement.remove()
			var name = ''
			if (typeof file.name !== 'undefined') {
				name = file.name
			} else {
				name = uploadedDocumentMap[file.name]
			}
			$('form').find('input[name="document[]"][value="' + name + '"]').remove()
		},
		init: function () {
			@if(isset($curso) && $curso->files)
				var files =
				{!! json_encode($curso->files) !!}
				for (var i in files) {
					console.log(files[i])
					var file = files[i]
					this.options.addedfile.call(this, file)
					file.previewElement.classList.add('dz-complete')
					$('form').append('<input type="hidden" name="document[]" value="' + file.name + '">')
				}
			@endif
		}
	});

	$('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#datepicker2').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
  
        
</script>
@stop

