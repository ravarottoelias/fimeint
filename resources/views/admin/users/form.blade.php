@php
  $paises = \App\Helpers\Helper::getCountries()
@endphp

@include('admin.includes.flashmessage')
<div class="row">
  <div class="col-12 text-right">
    <form action="{{ route('users.destroy', $user->id) }}" id="formEliminarUsuario" method="POST" onsubmit="return confirmarEliminacion();">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i> Eliminar
    </button>
</form>
    <a class="btn btn-info" href="{{ route('user_reset_password', $user->id) }}">Resetear Contraseña</a>
  </div>
</div>
  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="Apellidos">Apellidos</label>
        <input name="surname" type="text" class="form-control" id="Apellido y Nombre" value="{{$user->surname or old('surname')}}">
      </div>
      <div class="form-group col-md-6">
        <label for="Nombres">Nombres</label>
        <input name="name" type="text" class="form-control" id="Apellido y Nombre" value="{{$user->name or old('name')}}">
      </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>Documento Tipo</label>
      <select class="form-control" name="documento_tipo">
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
    <div class="form-group col-md-4">
      <label>Documento Número</label>
      <input type="text" class="form-control" name="documento_nro" value="{{$user->documento_nro or old('documento_nro')}}">
    </div>
    <div class="form-group col-md-4">
      <label>Cuit</label>
        <input id="cuit" type="text" class="form-control" name="cuit" value="{{ $user->cuit or old('cuit') }}" autofocus placeholder="CUIT">
        @if ($errors->has('cuit'))
            <div class="text-danger">
                <span>{{ $errors->first('cuit') }}</span>
            </div>
        @endif
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Teléfono</label>
      <div class="form-row">
        <div class="col-md-4">
          <input type="text" class="form-control" name="codigo_tel_pais" value="{{$user->codigo_tel_pais}}">
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="telefono" value="{{$user->telefono}}">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label>Email</label>
      <input type="email" class="form-control" name="email" value="{{$user->email or old('email')}}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Email Verificado</label>
      <select name="confirmed" class="form-control">
        <option @if($user->confirmed == 1) selected @endif value="1">SI</option>
        <option @if($user->confirmed == 0) selected @endif value="0">NO</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Pais</label>
      <select class="form-control select-paises" name="pais" onchange="buscarProvincias(this)">
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