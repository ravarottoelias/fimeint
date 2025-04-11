@extends('layouts.myaccount')

@section('content')

<ol class="breadcrumb my-4">
    <li class="breadcrumb-item"><a href="{{ route('my_panel') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Cambiar contraseña</li>
</ol>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 col-lg-8 mx-auto">
                
                <div class="card border-default mb-3">
                    <div class="card-body">
                        <h3 class="text-dark mb-4"><i class="fas fa-key"></i> Cambiar Contraseña</h3>
                        <p class="text-muted">Ingrese su contraseña actual y luego la nueva</p>
                        <hr>
                        @include('admin.includes.flashmessage')
                        
                        <form action="{{ route('profile_change_password', $user->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" files="true" novalidate>
                            {{ csrf_field() }}   
                            <div>
                                <label for="current_password">Contraseña Actual:</label>
                                <input class="form-control" type="password" name="current_password" required>
                            </div>
                        
                            <div>
                                <label for="new_password">Nueva Contraseña:</label>
                                <input class="form-control" type="password" name="new_password" required>
                            </div>
                        
                            <div>
                                <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label>
                                <input class="form-control" type="password" name="new_password_confirmation" required>
                            </div>
                            <div class="mt-3">

                                <button class="btn btn-primary" type="submit">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('.select-paises').select2({
            theme: 'bootstrap4',
            placeholder: "Pais",
        });

        $('.select-provincias').select2({
            theme: 'bootstrap4',
            placeholder: "Provincia o Estado",
            tags: true
        });

        $('.select-codigo-pais').select2({
            theme: 'bootstrap4',
            placeholder: "Código",
        });

    });

    let pasises = [];
    let codes = [];  
    axios.get('{{asset('countries.min.json')}}').then(res=>{paises = res.data.countries})
    axios.get('{{asset('countries-phone-codes.min.json')}}').then(res=>{codes = res.data})

    
    function buscarProvincias(selectObject)
    {

        $(".select-provincias").html('').select2({data: [],  theme: 'bootstrap4', placeholder: "Provincia o Estado", tags: true});

        var pais_selected = selectObject.value;  
        var provincias =  jQuery.map(paises, function(pais) {
            if(pais.country === pais_selected)
                 return pais.states; 
        });

        buscarCodigoTelefono(pais_selected)

        $(".select-provincias").select2({data: provincias,  theme: 'bootstrap4', placeholder: "Provincia o Estado", tags: true});
        
    }

    function buscarCodigoTelefono(pais_selected)
    {
        var pais = codes.find(item => {
           return item.name == pais_selected
        })

        if (pais != null) {
            $('.codigo-telefono-pais').val(pais.number)
            $('#codigo-telefono-pais').val(pais.number)
            $('#flag-pais').attr("src", pais.flag);
        }
    }
</script> --}}
@stop