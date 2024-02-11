@extends('admin.layout')

@section('content')
<div class='content'>
  <!-- Dropzone -->
  <form action="{{route('media_upload_fliles')}}" class='dropzone' id="dropzone-multimedia" >
  	<div class="dz-message" data-dz-message><span><i class="fas fa-upload"></i> Clic o arrastrar los archivos aquí para subir.</span></div>
  </form> 
</div> 

<div class="card">
  <div class="card-body">
    <table class="table table-sm table-hover">
	    <thead>
		    <tr>
		      <th class="w-5">#ID</th>
		      <th class="w-25">Nombre</th>
		      <th class="w-5">Ext</th>
		      <th class="w-40">URL</th>
		      <th class="w-20">Creado</th>
		    </tr>
	    </thead>
	    <tbody class="body-files">
	    @foreach($files as $file)
		    <tr>
		      <td>{{$file->id}}</td>
		      <td title="{{$file->name}}"><a href="{{Storage::disk('uploads')->url($file->path)}}" target="_blank">{{ (strlen($file->name) > 15) ? substr($file->name , 0, 25).'...' : $file->name}}</a>	</td>
		      <td>{{ $file->extension}}</td>
		      <td><input class="form-control form-control-sm" type="text" value="{{Request::root().'/'.$file->public_path}}"  id="{{$file->id}}" onclick="copyClipboard({{$file->id}})"></td>
		      <td>{{$file->created_at->format('d-M-Y H:m')}}</td>
		    </tr>
	      @endforeach
	    </tbody>
    </table>
  </div>
</div>
@stop

@section('script')
<script type="text/javascript">
	


	function additem(file) {
		var hostname = $(location).attr('hostname');
		var tr = `<tr>
		      <td>${file.id}</td>
		      <td title="${file.name}"><a href="${file.public_path}" target="_blank">${file.name}</a>	</td>
		      <td>${file.extension}</td>
		      <td><input class="form-control form-control-sm" type="text" value="${hostname+'/'+file.public_path}"  id="${file.id}" onclick="copyClipboard(${file.id})"></td>
		      <td>${file.created_at}</td>
		    </tr>`;

		$( ".body-files" ).prepend( tr );

	}

	function copyClipboard(id) {
	  /* Get the text field */
	  var copyText = document.getElementById(id);

	  /* Select the text field */
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
	  /* Copy the text inside the text field */
	  document.execCommand("copy");

	  /* Alert the copied text */
	  console.log("Copied the text: " + copyText.value);
	}
</script>
@stop