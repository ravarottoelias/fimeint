@extends('admin.layout')

@section('content')


<h1 class="mt-4">Usuarios</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
    <li class="breadcrumb-item active">{{$user->fullName()}}</li>
</ol>

<div class="card">
	<div class="card-body">
		<div class="w-100 text-right">
			<a href="{{route('user_reset_password', $user->id)}}" type="submit" class="btn btn-sm btn-warning mt-0 mb-4 text" onclick="return confirm('Desea Resetear la contraseña de {{$user->name}}?')" title="Resetear contraseña"><i class="fas fa-key"></i> Resetear Clave</a>
		</div>
		<form action="{{ route('users.update', $user->id) }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">

    		@include('admin.users.form')
    		
    		<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
	let pasises = [];
    let codes = [];  
    axios.get('{{asset('countries.min.json')}}').then(res=>{paises = res.data.countries})
    axios.get('{{asset('countries-phone-codes.min.json')}}').then(res=>{codes = res.data; console.log(res.data)})

    $(document).ready(function() {
        $('.select-paises').select2({
            theme: 'bootstrap4',
            placeholder: "Pais",
        });

        // $('.select-provincias').select2({
        //     theme: 'bootstrap4',
        //     placeholder: "Provincia o Estado",
        // });

        // $('.select-codigo-pais').select2({
        //     theme: 'bootstrap4',
        //     placeholder: "Código",
        // });

    });

    function buscarProvincias(selectObject)
    {

        $(".select-provincias").html('').select2({data: [],  theme: 'bootstrap4', placeholder: "Provincia o Estado",});

        var pais_selected = selectObject.value;  
        var provincias =  jQuery.map(paises, function(pais) {
            if(pais.country === pais_selected)
                 return pais.states; 
        });

        //buscarCodigoTelefono(pais_selected)

        $(".select-provincias").select2({data: provincias,  theme: 'bootstrap4', placeholder: "Provincia o Estado",});
        
    }
</script>
@stop

