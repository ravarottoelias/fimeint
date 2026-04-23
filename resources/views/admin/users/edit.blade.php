@extends('admin.layout')

@section('content')


<h1 class="mt-4">Usuarios</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
    <li class="breadcrumb-item active">{{$user->fullName()}}</li>
</ol>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#profile"> <i class="far fa-user-circle"></i> Perfil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#inscriptions"><i class="fas fa-pen-square"></i> Inscripciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#certificates"><i class="fas fa-certificate"></i> Certificados</a>
        </li>
    </ul>
    <div class="card mb-3">
        <div class="card-body">
            <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active show" id="profile">
                @include('admin.includes.flashmessage')
                @include('admin.users.form-delete-reset-password')
                @include('admin.users.form')
            </div>
            <div class="tab-pane fade" id="inscriptions">
                @include('admin.users.form-inscriptions')
            </div>
            <div class="tab-pane fade" id="certificates">
                @include('admin.users.form-certificates')
            </div>
            </div>
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

