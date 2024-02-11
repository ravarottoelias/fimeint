@extends('sitio.layout')

@section('content')
<style type="text/css">
.form-control.has-error {
    border-color: #dc3545;
}
.has-error .help-block{
    color: #dc3545;
}

body{
    background: url(https://image.freepik.com/free-photo/female-student-uses-keyboard-type-computer_112699-553.jpg);
    background-size: contain;
    background-position: top;
}

</style>

@php
    $paises = \App\Helpers\Helper::getCountries()
@endphp

<section class="registration-area">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-lg-6 mx-auto">
            
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h3 class="text-dark my-3 text-center">Crear Usuario</h3>

                    <hr>

                        <div class="row form-group">
                            <div class="col">
                                <div class="alert alert-info" role="alert">Por favor <b>consignar correctamente sus datos personales</b> ya que con ellos se confeccionarán los certificados correspondientes y no se aceptarán reclamos por errores ajenos a nuestra Organización</div>
                            </div>
                        </div>

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{-- <label for="name" class="col-md-12 control-label">Apellido y Nombre</label> --}}

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombres">
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('name') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{-- <label for="name" class="col-md-12 control-label">Apellido y Nombre</label> --}}

                            <div class="col-md-12">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required placeholder="Apellidos">
                                @if ($errors->has('surname'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('surname') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="row mx-0 {{ $errors->has('documento_tipo') ? ' has-error' : '' }}">
                            <label for="documento_tipo" class="col-md-12 control-label text-muted">Documento Tipo y Número</label>
                            <div class="col-md-5 col-sm-12 form-group">
                                <select id="documento_tipo" class="form-control" name="documento_tipo" value="{{ old('documento_nro') }}" required>
                                    <option value="DNI">DNI</option>
                                    <option value="CUIT">CUIT</option>
                                    <option value="CDI">CDI</option>
                                    <option value="LE">LE</option>
                                    <option value="LC">LC</option>
                                    <option value="CI Extranjera">CI Extranjera</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="CI Policia Federal">CI Policia Federal</option>
                                    <option value="Cert. Migracion">Cert. Migración</option>
                                </select>
                                @if ($errors->has('documento_tipo'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('documento_tipo') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-7 col-sm-12 form-group">
                                <input id="documento_nro" type="text" class="form-control" name="documento_nro" value="{{ old('documento_nro') }}" required autofocus placeholder="Número">
                                @if ($errors->has('documento_nro'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('documento_nro') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div> -->

                        <div class="row mx-0 form-group">
                            <div class="col-md-12">
                                <input id="cuit" type="text" class="form-control" name="cuit" value="{{ old('cuit') }}" autofocus placeholder="CUIT" required>
                                <small id="cuitHelp" class="form-text text-muted">En el caso de ser extranjero, completar este campo con el numero de identificacion personal que posea.</small>
                                @if ($errors->has('cuit'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('cuit') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mx-0 form-group{{ $errors->has('profesion') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="profesion" type="text" class="form-control" name="profesion" value="{{ old('profesion') }}" required autofocus placeholder="Profesión">
                                @if ($errors->has('profesion'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('profesion') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row mx-0">
                            <div class="col-md-6 form-group">
                                <select class="select-paises " name="pais" onchange="buscarProvincias(this)" required>
                                    <option></option>
                                    @foreach($paises['countries'] as $pais)
                                        <option value="{{$pais['country']}}">{{$pais['country']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('pais'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('pais') }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 form-group">
                                <select class="select-provincias" name="provincia" required>
                                    <option></option>
                                </select>
                                @if ($errors->has('provincia'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('provincia') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mx-0 {{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <div class="col-2 pr-0">
                                {{-- <img src="" id="flag-pais" height="30px" style="margin-top: 6px"> --}}
                            </div>
                            <div class="col-3 pr-0">
                                <input type="text" class="form-control codigo-telefono-pais" value="{{ old('codigo_tel_pais') }}" placeholder="Código" name="codigo_tel_pais">
                                {{-- <input id="codigo-telefono-pais" type="text" class="form-control d-none" name="codigo_tel_pais" value="{{ old('codigo_tel_pais') }}" placeholder="Código"> --}}
                                @if ($errors->has('codigo_tel_pais'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('codigo_tel_pais') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-7 form-group">
                                <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required>
                                @if ($errors->has('telefono'))
                                    <div class="text-danger">
                                        <span>{{ $errors->first('telefono') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <hr>

                        <div class="row mx-0 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Correo electrónico">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mx-0 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mx-0 form-group">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" name="password_confirmation" required placeholder="Repetir contraseña">
                            </div>
                        </div>
                        
                        <div class="row form-group form-check mx-1 mb-4">
                            <div class="col-md-12">
                                <input type="checkbox" class="form-check-input" id="peronal_data" required>
                                <label class="form-check-label" for="peronal_data">He consignado correctamente mis datos personales.</label>
                            </div>
                        </div>

                        <div class="row form-group mt-2">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="mu-btn mu-primary">
                                    Regístrate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@stop

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
    axios.get('{{asset('countries-phone-codes.min.json')}}').then(res=>{codes = res.data; console.log(res.data)})

    
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