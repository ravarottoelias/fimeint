@extends('layouts.myaccount')

@section('content')

<ol class="breadcrumb my-4">
    <li class="breadcrumb-item active">PANEL</li>
</ol>

<div class="row">
    <div class="col-12">
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

    <div class="card border-secondary mb-3"">
        <div class="card-header bg-primary text-white">ÚLTIMOS CURSOS</div>
        <div class="list-group">
            @foreach (Auth::user()->inscriptions()->latest()->take(3)->get() as $i)
            @if(isset($i->curso) && $i->curso)
                <a href="#" class="list-group-item list-group-item-actionD">{{ $i->curso->titulo }}</a>
            @endif
            @endforeach
            <a href="{{ route('account_my_courses', Auth::user()->id) }}" class="list-group-item list-group-item-actionD">Ver todos <i class="fas fa-arrow-right"></i></a>
          </div>
    </div>    
    
    <div class="card border-secondary mb-3"">
        <div class="card-header bg-primary text-white">ÚLTIMOS CERTIFICADOS</div>
        <div class="list-group">
            @forelse ($certificates->data as $cert)
                <a href="{{ route('public_certificates_pdf', $cert->uuid) }}" class="list-group-item list-group-item-actionD"><i class="far fa-file-pdf"></i> {{ $cert->cursoNombre}} - {{ explode(' ', $cert->createdAt, )[0]  }}</a>
            @empty
                <div class="alert alert-dismissible alert-light">
                    <strong>Nada por aqui!</strong> No se encontraron certificados.
                </div>
            @endforelse
            <a href="{{ route('account_my_certificates', Auth::user()->id) }}" class="list-group-item list-group-item-actionD">Ver todos <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>

    



@endsection

@section('script')

@stop