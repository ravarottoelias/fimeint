
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
    $( "#list-tab-curso #list-form-avanzado" ).click(function() {
		//Dropzone Curso Files - insertar form cuando hace click en el tab.
        if(!document.getElementById('dropzone-curso-files')){
            var newspan = document.createElement('span');
            newspan.innerHTML =`<form class="dropzone" action="{{route('media_upload_fliles')}}" id="dropzone-curso-files">
                                <div class="dz-message" data-dz-message><span><i class="fas fa-upload"></i> Clic o arrastrar los archivos aquí para subir.</span></div>
                              </form>`;

            document.getElementById('content_dropzone').append(newspan);

            var dropzoneCursoFiles = new Dropzone("#dropzone-curso-files",{ 
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf",
             	addRemoveLinks: true,
                removedfile: function(file) {
                	axios
                    	.get('/curso_delete_file/'+file.id)
                    	.then(res=>{
	                    	var _ref;
							return (_ref = file.previewElement)!= null ? _ref.parentNode.removeChild (file.previewElement): void 0;
                    	})
                },
                init: function() {
                    this.on("success", function(file, response) {
                        console.log(response);
                    });
                    //listar archivos
                    var mocks = files;
				    for (var i = 0; i < mocks.length; i++) {
				        var mock = mocks[i];
				        mock.accepted = true;

				        this.files.push(mock);
				        this.emit('addedfile', mock);
				        this.createThumbnailFromUrl(mock, mock.public_path);
				        this.emit('complete', mock);
				    }
                }
            });
            dropzoneCursoFiles.on("sending", function(file, xhr, formData) {
               formData.append("_token", CSRF_TOKEN);
               formData.append("notable_type", "App\\Curso");
               formData.append("notable_id", {{$curso->id}});
            }); 
        }

        // cargar la tabla de links de pago
        getScriptsDePagos();
    });

	function imprimirTablaScripts(scripts)
	{
		$("#body-scripts-de-pagos").html('')

		$.each( scripts, function( key, sp ) {
		  var tr = `<tr>
			      <th scope="row">${sp.id}</th>
			      <td>${sp.titulo}</td>
			      <td>${sp.descripcion}</td>
			      <td>${sp.script}</td>
			      <td class="text-right">
			      	<a href="#" class="btn btn-sm btn-danger" onclick="eliminarScriptDePago(${sp.id})"><i class="fa fa-trash"></i></a>
			      </td>
			    </tr>`;
			$("#body-scripts-de-pagos").append(tr);
		});
	}

	function getScriptsDePagos()
	{
		var curso_id = $('#scriptsPagosModal [name ="curso_id"]').val()
		axios
			.get('/curso_scripts/'+curso_id)
			.then(res=>{
				imprimirTablaScripts(res.data)
			})
	}

	function guardarScriptDePago()
	{
		var sp = {};

		sp.curso_id = $('#scriptsPagosModal [name ="curso_id"]').val()
		sp.sp_titulo = $('#scriptsPagosModal [name ="sp_titulo"]').val()
		sp.sp_descripcion = $('#scriptsPagosModal [name ="sp_descripcion"]').val()
		sp.sp_script = $('#scriptsPagosModal [name ="sp_script"]').val()
		console.log(sp)
		axios
			.post('/curso_add_scripts', sp)
			.then(res=>{
				$('#scriptsPagosModal').modal('toggle');
				$('#scriptsPagosModal [name ="sp_titulo"]').val('')
				$('#scriptsPagosModal [name ="sp_descripcion"]').val('')
				$('#scriptsPagosModal [name ="sp_script"]').val('')
				getScriptsDePagos();
			})
	}

	function eliminarScriptDePago(sp_id)
	{
		var url = '/curso_delete_scripts/'+sp_id;
		console.log(url)
        var eliminar = confirm("Eliminar el item seleccionado?");

        if (eliminar) {
            axios
                .post(url)
                .then(res=>{
                    getScriptsDePagos();
                })
        }
	}


    function copy() {
		/* Get the text field */
		var copyText = document.getElementById("curso-token");

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/* Copy the text inside the text field */
		document.execCommand("copy");
	}

	function editarInscripcion(insc)
	{
		$('#modalEditarInscripcion #input-alumno').val('');
		$('#modalEditarInscripcion #select-estado-del-pago').val('');
		$('#modalEditarInscripcion #inscripcion_id').val('');

		$('#modalEditarInscripcion #inscripcion_id').val(insc.id);
		$('#modalEditarInscripcion #input-alumno').val(insc.alumno.name);
		$('#modalEditarInscripcion #select-estado-del-pago').val(insc.estado_del_pago);
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
        
</script>
@stop