@extends('sitio.layout')

@section('content')

@php 
    $paises = \App\Helpers\Helper::getCountries()
@endphp

<section class="registration-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-lg-6 mx-auto">
                
                <div class="card border-default mb-3">
                    <div class="card-body">
                        <h3 class="text-dark mb-4"><i class="fas fa-user-circle"></i> Perfil</h3>
                        <p class="text-muted"> Por favor consignar correctamente sus datos personales ya que con ellos se confeccionarán los certificados correspondientes y no se aceptarán reclamos por errores ajenos a nuestra Organización</p>
                        <hr>
                        <form action="{{ route('update_profile', $user->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" files="true">
                        {{ csrf_field() }}   
                        <div class="col-12">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="Apellidos">Apellidos</label>
                                        <input name="surname" type="text" class="form-control" id="apellidos" value="{{$user->surname or old('surname')}}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="Apellido y Nombre">Nombres</label>
                                            <input name="name" type="text" class="form-control" id="nombre" value="{{$user->name or old('name')}}">
                                            </div>
                                        <div class="form-group col-4">
                                            <label>Documento Tipo</label>
                                            <select class="form-control" name="documento_tipo" required>
                                                <option @if($user->documento_tipo == 'DNI') selected @endif value="DNI">DNI</option>
                                                <option @if($user->documento_tipo == 'CUIT') selected @endif value="CUIT">CUIT</option>
                                                <option @if($user->documento_tipo == 'CDI') selected @endif value="CDI">CDI</option>
                                                <option @if($user->documento_tipo == 'LE') selected @endif value="LE">LE</option>
                                                <option @if($user->documento_tipo == 'LC') selected @endif value="LC">LC</option>
                                                <option @if($user->documento_tipo == 'CI Extranjera') selected @endif value="CI Extranjera">CI Extranjera</option>
                                                <option @if($user->documento_tipo == 'Pasaporte') selected @endif value="Pasaporte">Pasaporte</option>
                                                <option @if($user->documento_tipo == 'CI Policia Federal') selected @endif value="CI Policia Federal">CI Policia Federal</option>
                                                <option @if($user->documento_tipo == 'Cert. Migración') selected @endif value="Cert. Migracion">Cert. Migración</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Documento Número</label>
                                            <input type="text" class="form-control" name="documento_nro" value="{{$user->documento_nro or old('documento_nro')}}" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                        <label>CUIT</label>
                                            <input id="cuit" type="text" class="form-control" name="cuit" value="{{ $user->cuit or old('cuit') }}" placeholder="CUIT">
                                            <small id="cuitHelp" class="form-text text-muted">En el caso de ser extranjero, completar este campo con el numero de identificacion personal que posea.</small>
                                            @if ($errors->has('cuit'))
                                                <div class="text-danger">
                                                    <span>{{ $errors->first('cuit') }}</span>
                                                </div>
                                            @endif
                                        
                                        </div>
                                    </div>

                                    <div class="row mx-0 {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                        
                                        <div class="col-2 pr-0">
                                            <img src="" id="flag-pais" height="30px" style="margin-top: 6px">
                                        </div>
                                        <div class="col-3 pr-0">
                                            <input type="text" class="form-control codigo-telefono-pais" name="codigo_tel_pais"  value="{{ $user->codigo_tel_pais or old('codigo_tel_pais') }}" placeholder="Código">
                                            
                                            @if ($errors->has('codigo_tel_pais'))
                                                <div class="text-danger">
                                                    <span>{{ $errors->first('codigo_tel_pais') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-7 form-group">
                                            <input id="telefono" type="number" class="form-control" name="telefono" value="{{ $user->telefono or old('telefono') }}" placeholder="Teléfono" required>
                                            @if ($errors->has('telefono'))
                                                <div class="text-danger">
                                                    <span>{{ $errors->first('telefono') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$user->email or old('email')}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label>Pais</label>
                                        <select class="form-control select-paises" name="pais" onchange="buscarProvincias(this)" id="input_select_pais">
                                            <option></option>
                                            @foreach($paises['countries'] as $pais)
                                            <option @if($user->pais == $pais['country']) selected @endif>{{$pais['country']}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label>Provincia o estado</label>
                                        <select class="form-control select-provincias" name="provincia">
                                            <option value="{{$user->provincia}}">{{$user->provincia}}</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Profesión</label>
                                            <input type="text" class="form-control" name="profesion" value="{{$user->profesion or old('profesion')}}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
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
</script>
@stop