<article class="mb-5 mb-md-0">

    @php
        $portadaWeb = $concurso->portadas->first();
        if ($portadaWeb != null) {
            $srcWeb = Storage::disk('uploads')->url($portadaWeb->path);
        }else{ $srcWeb = '/images/default.png'; }

        $portadaMobile = $concurso->portadas->slice(1, 1)->first();
			 		if ($portadaMobile != null) {
			 			$srcMobile = Storage::disk('uploads')->url($portadaMobile->path);
			 		}else{ $srcMobile = '/images/default.png'; }
    @endphp

    <img class="img-fluid d-none d-sm-block d-md-block" src="{{ $srcWeb }}">
    <img class="img-fluid d-block d-sm-none" src="{{ $srcMobile }}">

    <div class="container">
        <h1>{{$concurso->titulo}}</h1>
        
        <ul class="mu-blog-meta">
            @if($concurso->lugar)
            <li class="text-muted"><i class="fas fa-map-marker-alt"></i> {{$concurso->lugar}}</li>
            @endif
            <li class="text-muted"><i class="far fa-calendar-alt"></i> Publicado {{$concurso->created_at->diffForHumans()}}</li>
            <li>
                @switch($post->status)

                    @case(\App\Post::ESTADO_EN_CURSO)
                        <span class="badge badge-primary">
                            {{ $concurso->status }}
                        </span>
                        @break

                    @case(\App\Post::ESTADO_FINALIZADO)
                        <span class="badge badge-dark">
                            {{ $concurso->status }}
                        </span>
                        @break

                    @default
                        <span class="badge badge-dark">
                            {{ $concurso->status }}
                        </span>

                @endswitch
            </li>
        </ul>

        <p>{{$concurso->descripcion}}</p>

        <div class="contenido-del-post">
            {!! $concurso->contenido !!}
        </div>
    

    </div>

</article>
