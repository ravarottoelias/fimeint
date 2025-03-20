<div class="list-group">
    @forelse ($certificates as $cert)
        <a href="{{ route('certificates_show', [$cert->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1">{{ $cert->cursoNombre }}</h6>
                <small>Codigo: {{ $cert->codigoQr }}</small>
            </div>
            <p class="mb-1">
                <span class="badge badge-success">
                    Nro {{ $cert->certificadoNumero }}
                </span>
                <span class="badge badge-dark">
                    T.F {{ $cert->tfCertificadoNumero }}
                </span>
                <span class="badge badge-info">
                    Homologacion {{ $cert->cursoHomologacion }}
                </span>
            </p>
            <small></small>
        </a>
    @empty    
        <div class="alert alert-dismissible alert-light">
            <strong>Nada por aqui!</strong> No se encontraron certificados para el usuario.
        </div>
    @endforelse
  </div>