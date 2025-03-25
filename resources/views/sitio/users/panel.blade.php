@extends('layouts.myaccount')

@section('content')

<h1 class="mt-4 mb-1">Mi Panel</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Inicio</li>
</ol>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card border-primary mb-3"">
            {{-- <div class="card-header">Mis Cursos</div> --}}
            <div class="card-body">
              <h4 class="card-title">Mis cursos</h4>
              <p class="card-text">Últimos cursos realizados.</p>
            </div>
            <div class="list-group">
                @foreach (Auth::user()->inscriptions()->latest()->take(3)->get() as $i)
                    <a href="#" class="list-group-item list-group-item-actionD">{{ $i->curso->titulo }}</a>
                @endforeach
                <a href="#" class="list-group-item list-group-item-actionD">Ver todos <i class="fas fa-arrow-right"></i></a>
              </div>
          </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card border-primary mb-3"">
            {{-- <div class="card-header">Mis Cursos</div> --}}
            <div class="card-body">
              <h4 class="card-title">Mis Certificados</h4>
              <p class="card-text">Últimos certificados</p>
            </div>
            <div class="list-group">
                @forelse ($certificates as $cert)
                    <a href="#" class="list-group-item list-group-item-actionD"><i class="far fa-file-pdf"></i> {{ $cert->cursoNombre}} - {{ explode(' ', $cert->createdAt, )[0]  }}</a>
                @empty
                    <div class="alert alert-dismissible alert-light">
                        <strong>Nada por aqui!</strong> No se encontraron certificados.
                    </div>
                @endforelse
                <a href="#" class="list-group-item list-group-item-actionD">Ver todos <i class="fas fa-arrow-right"></i></a>
              </div>
          </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card border-primary mb-3"">
            {{-- <div class="card-header">Mis Cursos</div> --}}
            <div class="card-body">
              <h4 class="card-title">Mis datos</h4>
              <p class="card-text">Ver y actualizar datos. Cambio de contraseña</p>
            </div>
            <div class="list-group">
                <a href="{{route('show_account', Auth::user()->id) }}" class="list-group-item list-group-item-actionD">Ver mis datos <i class="fas fa-arrow-right"></i></a>
              </div>
          </div>
    </div>
</div>

@endsection

@section('script')

@stop