@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <h5 class="card-header">Inscripción</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold text-muted"> <i class="fas fa-graduation-cap"></i> Curso</p>
                    
                        <table class="table table-sm table-borderless ml-2">
                            <tbody>
                                <tr>
                                    <th scope="row">Título</th>
                                    <td>{{ $inscription->curso->titulo }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descripción</th>
                                    <td>{{ $inscription->curso->descripcion }}</td>
                                </tr>                              
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold text-muted"> <i class="fas fa-user"></i> Alumno</p>
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-sm table-borderless  ml-2">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nombre y Apellido</th>
                                            <td>{{ $inscription->alumno->fullname() }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{  $inscription->alumno->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm table-borderless  ml-2">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tipo y Nro Identificación</th>
                                            <td>{{ $inscription->alumno->documento_tipo}} -  {{ $inscription->alumno->documento_nro}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">CUIT</th>
                                            <td>{{ $inscription->alumno->cuit}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
                                    @foreach ($inscription->payments()->orderBy('payment_date', 'DESC')->get() as $payment)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('payment_details', $payment->payment_identifier) }}"> {{ $payment->payment_identifier }} <i class="fas fa-external-link-alt"></i></a>
                                            </th>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d H:i') }}</td>
                                            <td>{{ $payment->status }}</td>
                                            <td>{{ $payment->gateway }}</td>
                                            <td> $ {{ $payment->amount }}</td>
                                        </tr>
                                    @endforeach
                                
                                </tbody>
                              </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

@stop