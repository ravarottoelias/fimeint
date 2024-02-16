@extends('admin.layout')

@section('content')

    <h1 class="mt-4">Inscripciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('inscriptions') }}">Cursos</a></li>
        <li class="breadcrumb-item active">{{ $inscription->id }}</li>
    </ol>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p class="font-weight-bold text-muted"> <i class="fas fa-graduation-cap"></i> Detalle</p>
                        <table class="table table-sm table-borderless ml-2">
                            <tbody>
                                <tr>
                                    <th scope="row">#ID</th>
                                    <td>{{ $inscription->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha incripción</th>
                                    <td>{{ $inscription->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Estado del Pago</th>
                                    <td>{{ $inscription->estado_del_pago }}</td>
                                </tr>                              
                            </tbody>
                        </table>

                        
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <p class="font-weight-bold text-muted"> <i class="fas fa-graduation-cap"></i> Curso</p>
                        <table class="table table-sm table-borderless ml-2">
                            <tbody>
                                <tr>
                                    <th scope="row">Título</th>
                                    <td>{{ $inscription->curso->titulo }}</td>
                                </tr>                             
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="font-weight-bold text-muted"> <i class="fas fa-user"></i> Alumno</p>      
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <th>Nombre y Apellido</th>
                                <td>{{ $inscription->alumno->fullname() }}</td>
                            </tr>
                            <tr>
                                <th>Tipo y Nro Identificación</th>
                                <td>{{ $inscription->alumno->documento_tipo}} -  {{ $inscription->alumno->documento_nro}}</td>
                            </tr>
                            <tr>
                                <th>CUIT</th>
                                <td>{{ $inscription->alumno->cuit}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{  $inscription->alumno->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                          

                                <table class="table table-sm table-borderless ">
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            
                        
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="far fa-money-bill-alt"></i> Pagos
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Gateway</th>
                            <th scope="col">Monto</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse  ($inscription->payments()->orderBy('payment_date', 'DESC')->get() as $payment)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('payment_details', $payment->payment_identifier) }}"> {{ $payment->payment_identifier }} <i class="fas fa-external-link-alt"></i></a>
                                    </th>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d H:i') }}</td>
                                    <td>{{ $payment->status }}</td>
                                    <td>{{ $payment->gateway }}</td>
                                    <td> $ {{ $payment->amount }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        No se registron pagos
                                    </td>
                                </tr>
                            @endforelse 
                        
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

  


@stop