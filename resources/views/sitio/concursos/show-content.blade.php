<article class="mb-5 mb-md-0">

    {{-- @php
        if ($concurso->portada != null) {
            $src = Storage::disk('uploads')->url($concurso->portada->path);
        }else{ $src = '/images/default.png'; }
    @endphp
    <img class="img-fluid rounded" src="{{ $src }}"> --}}
    <img class="img-fluid d-none d-sm-block d-md-block" src="/images/concurso-web.png">
    <img class="img-fluid d-block d-sm-none" src="/images/concurso-mobile.png">

    <div class="container">
        <h1 class="mu-blog-item-title">{{$concurso->titulo}}</h1>
        
        <ul class="mu-blog-meta">
            @if($concurso->lugar)
            <li class="text-muted"><i class="fas fa-map-marker-alt"></i> {{$concurso->lugar}}</li>
            @endif
            <li class="text-muted"><i class="far fa-calendar-alt"></i> Publicado {{$concurso->created_at->diffForHumans()}}</li>
        </ul>

        <p>{{$concurso->descripcion}}</p>

        <div class="contenido-del-post">
            {!! $concurso->contenido !!}
        </div>

    </div>

</article>
