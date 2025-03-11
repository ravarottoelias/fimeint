<div class="list-group">
    @foreach ($user->inscriptions as $i)
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1">{{ $i->curso->titulo }}</h6>
                <small>Created at: {{ $i->created_at->format('Y-m-d') }}</small>
            </div>
            <p class="mb-1">
                <span class=" 
                    @if($i->pagado())badge badge-success @endif
                    @if($i->pagoParcial())badge badge-info @endif
                    @if($i->pagoPendiente())badge badge-dark @endif
                ">
                    <i class="fas fa-money-check-alt"></i> {{ $i->estado_del_pago }}
                </span>
            </p>
            <small></small>
        </a>
    @endforeach
  </div>