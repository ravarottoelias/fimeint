@extends('layouts.myaccount')

@section('content')


    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item"><a href="{{ route('my_panel', Auth::user()->id) }}">Inicio</a></li>
        <li class="breadcrumb-item active">Mis datos</li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 col-lg-8 mx-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="text-dark mb-4"><i class="fas fa-user-circle"></i> Mis datos</h3>
                        
                            <form action="{{ route('update_account', $user->id) }}" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data" files="true">
                                {{ csrf_field() }}                    
                                @include('sitio.users.account.form')
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                            </form>
                        
                    </div>
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

