@php
    $esPreInscripcion = $curso->unit_price < 1 ? true : false;
    if ($esPreInscripcion) {
        $btnText = 'Quiero pre inscribirme';
    } else {
        $btnText = ' Quiero inscribirme';
    }
@endphp
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
                            Gracias por inscribirte <i class="far fa-smile"></i>. La primer cuota fué abonada. Puedes abonar la segunda <a href="{{ route('curso_step_inscription_payment', $curso->slug) }}" class="alert-link"><b>aquí</b></a>.
                        </div>
                    @break
                    @case(\App\Inscripcion::PENDIENTE)
                        <div class="alert alert-info" role="alert">
                            Gracias por inscribirte <i class="far fa-smile"></i>. Aún <b>no registramos tu pago</b>. Completalo <a href="{{ route('curso_step_inscription_payment', $curso->slug) }}" class="alert-link"><b>aquí</b></a>.
                        </div>
                    @break
                        
                @endswitch
            @else
                @if(empty(Auth::user()->documento_nro))
                    <div class="alert alert-secondary">
                        <div class="row">
                            <div class="col-sm-12 col-md-1 px-2 py-3 d-flex justify-content-center align-items-center">
                                <i class="fas fa-exclamation-circle" style="font-size: 38px"></i>
                            </div>
                            <div class="col-sm-12 col-md-11">
                                <strong>Importante!</strong> Para poder inscribirte al curso, es necesario que tengas cargado tu tipo y número de documento en tu perfil. Podés hacerlo fácilmente ingresando al siguiente enlace: <a href="{{ route('show_account', Auth::user()->id) }}" class="a_lert-link"><i class="fas fa-link"></i> Mis datos</a>.
                            </div>
                        </div>
                    </div>
                @else
                    <a class="mu-primary-btn" href="{{ route('curso_inscription', $curso->slug) }}"> {{ $btnText }} <i class="fas fa-arrow-right"></i></a>
                @endif
            @endif     
        @else
            <a class="mu-primary-btn" href="{{ route('curso_inscription', $curso->slug) }}"> {{ $btnText }} <i class="fas fa-arrow-right"></i></a>
        @endif  
    </div>
</div>
