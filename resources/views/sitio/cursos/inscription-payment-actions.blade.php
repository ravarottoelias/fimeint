<div class="row my-md-5 my-sm-5">
    <div class="col d-flex justify-content-center">
        @if(Auth::user())
            @if (Auth::user()->estaInscriptoEn($curso->id))
                @php
                    $inscription = Auth::user()->getInscriptionByCursoId($curso->id);
                @endphp
                @switch($inscription->estado_del_pago)
                    @case(\App\Inscripcion::PAGADO)
                        <div class="alert alert-success" role="alert">
                            Gracias por inscribirte <i class="far fa-smile"></i>. Tu <b>pago fué registrado con éxito <i class="fas fa-check-circle"></i></b>.
                        </div>
                    @break
                    @case(\App\Inscripcion::PAGADO_PARCIAL)
                        <div class="alert alert-success" role="alert">
                            Gracias por inscribirte <i class="far fa-smile"></i>. Tienes un <b>pago pendiente</b>. Completalo <a href="#" class="alert-link"><b>aquí</b></a>.
                        </div>
                    @break
                    @case(\App\Inscripcion::PENDIENTE)
                        <div class="alert alert-info" role="alert">
                            Gracias por inscribirte <i class="far fa-smile"></i>. Aún <b>no registramos tu pago</b>. Completalo <a href="#" class="alert-link"><b>aquí</b></a>.
                        </div>
                    @break
                        
                @endswitch
            @else
                <a class="mu-primary-btn" href="{{ route('curso_inscription', $curso->slug) }}"> Quiero inscribirme <i class="fas fa-arrow-right"></i></a>
            @endif     
        @else
            <a class="mu-primary-btn" href="{{ route('curso_inscription', $curso->slug) }}"> Quiero inscribirme <i class="fas fa-arrow-right"></i></a>
        @endif  
    </div>
</div>
