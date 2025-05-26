@extends('admin.layout')

@section('content')
    @php
    $paypalImageB64 = "data:image/png;base64,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";
    $mercadopagoImageB64 = "data:image/webp;base64,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";
    $imageGateway = $paymentDetails->gateway === App\Constants\MPIntegrationConstants::MP_GATEWAY_NAME 
                        ? $mercadopagoImageB64 
                        : $paypalImageB64
        
    @endphp

    <h1 class="mt-4">Pagos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('payments') }}">Pagos</a></li>
        <li class="breadcrumb-item active">{{ $paymentDetails->identifier }}</li>
    </ol>

    <div class="card border-primary mb-3">
        <div class="card-header">
            DETALLE TRANSACCIÓN
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="mb-md-4 mb-sm-2">
                        <div class="row">
                            <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                                <img src="{{ $imageGateway }}" alt="">
                            </div>
                            <div class="col-md-9 col-12">
                                <table class="table table-sm table-borderless ml-2">
                                    <tbody>
                                        <tr>
                                            <td scope="row">Identificador</td>
                                            <td>{{ $paymentDetails->identifier }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Fecha creación</td>
                                            <td>{{ $paymentDetails->dateCreated }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Fecha aprobación</td>
                                            <td>{{ $paymentDetails->dateApprobed }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Estado del pago</td>
                                            <td>{{ $paymentDetails->status }}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del pago</p>
                        <table class="table table-sm ml-2">
                            <tbody>
                                <tr>
                                    <td>Monto Cobrado</td>
                                    <td> <b>$ @precio($paymentDetails->totalAmount) </b></td>
                                </tr>
                                <tr>
                                    <td>Monto Recibido</td>
                                    <td> <b>$ @precio( $paymentDetails->netReceivedAmount) </b></td>
                                </tr>
                            </tbody>
                          </table>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del producto</p>

                        <table class="table table-sm ml-2">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">ITEM</th>
                                <th scope="col">PRECIO UNITARIO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentDetails->items as $item)
                                <tr>
                                    <td>{{ $item->itemDetail }}</td>
                                    <td> <b> $ @precio($item->itemUnitPrice) </b></td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del Alumno</p>
                        <table class="table table-sm table-borderless  ml-2">
                            <tbody>
                                <tr>
                                    <td scope="row">Nombre y Apellido</td>
                                    <td>{{ $paymentDetails->inscription->alumno->fullName }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Email</td>
                                    <td>{{ $paymentDetails->inscription->alumno->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


@stop