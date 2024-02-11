@extends('sitio.layout')

@section('title_and_meta')
    <title>Inscripción - Estado de mi pago</title>
    <meta name="description" content="Inscripción">
@stop

@section('mark-up-facebook')
@stop


@section('styles')
	<link rel="stylesheet" href="{{asset('css/course-single.css')}}" />	
    <style>
    .table-step-payment.table-borderless.no-border th,
    .table-step-payment.table-borderless.no-border td{
        border: none;
    }
    .table-step-payment.table-borderless.no-border th{
        max-width: 70px;;
    }
    .fs-100{
        font-size: 100%;
    }
    </style>
@stop



@section('content')

<!-- Start Breadcrumb -->
<div id="mu-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb" role="navigation">
				  <ol class="breadcrumb mu-breadcrumb">
				    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
				    <li class="breadcrumb-item"><a href="/">Oferta Académica</a></li>
				    <li class="breadcrumb-item"><a href="/">{{ $curso->titulo }}</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Inscripción</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumb -->	

<section id="mu-blog" class="mt-3">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="mu-blog-left">
				 
				    @include('sitio.includes.flash-message')	

                    <div class="container-stepwizard" id="container-stepwizard">
                        <div class="wizard-header text-center">
                            <h3 class="heading">Inscripción</h3>
                            <p>Seguí los pasos para inscribirte al curso {{ $curso->titulo }} </p>
                        </div>

                        <div class="stepwizard">
                            <div class="stepwizard-row py-3">
                                <div class="stepwizard-step">
                                    <button type="button" class="btn btn-default btn-circle"><i class="fas fa-user-check"></i></button>
                                    <p class="d-none d-sm-block">Cuenta</p>
                                </div>
                                <div class="stepwizard-step">
                                    <button type="button" class="btn btn-default btn-circle"><i class="fas fa-pencil-alt"></i></button>
                                    <p class="d-none d-sm-block">Inscripción</p>
                                </div>
                                {{-- ACTIVO --}}
                                <div class="stepwizard-step">
                                    <button type="button" class="btn btn-default btn-circle"><i class="fas fa-money-check-alt"></i></button>
                                    <p class="text-dark d-none d-sm-block">Pago</p>
                                </div>
                                <div class="stepwizard-step">
                                    <button type="button" class="btn btn-primary btn-circle"><i class="fas fa-check"></i></button>
                                    <p class="d-none d-sm-block">Hecho</p>
                                </div>  
                            </div>
                            <div class="stepwizard-contenido d-flex justify-content-center">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="btn-mp-container d-flex justify-content-center my-3"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-11">
                                            <table class="table table-step-payment table-borderless no-border table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Curso</th>
                                                        <td>{{ $curso->titulo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Alumno</th>
                                                        <td>{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Fecha de inscripción</th>
                                                        <td colspan="2">{{ $inscription->created_at->format('Y-m-d | H:i') }}</td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                
                                                <table class="table table-step-payment table-borderless no-border table-sm mb-md-5">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">Estado del pago</th>
                                                        <td colspan="2"> 
                                                            @switch($inscription->estado_del_pago)
                                                                @case(\App\Inscripcion::PAGADO)
                                                                    <span class="badge badge-success fs-100">{{ $inscription->estado_del_pago }}</span>
                                                                    @break
                                                            
                                                                @default
                                                                    <span class="badge badge-dark fs-100">{{ $inscription->estado_del_pago }}</span>
                                                                    
                                                            @endswitch
                                                        </td>
                                                        <tr>
                                                            <th scope="row">Fecha del pago</th>
                                                            <td colspan="2">{{ $inscription->fecha_del_pago }}</td>
                                                        </tr>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>					
			</div>
		</div>
	</div>
</section>


@stop
