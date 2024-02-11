@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <h5 class="card-header">Detalles del pago</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del pago</p>
                        <table class="table table-sm table-borderless ml-2">
                            <tbody>
                                <tr>
                                    <td scope="row">Id Mercadopago</td>
                                    <td>{{ $payment->id }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Fecha creación</td>
                                    <td>{{ $payment->date_created }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Fecha aprobación</td>
                                    <td>{{ $payment->date_approved }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Estado del pago</td>
                                    <td>{{ $payment->status }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del producto</p>
                        <table class="table table-sm table-borderless  ml-2">
                            <tbody>
                                <tr>
                                    <td scope="row">Titulo</td>
                                    <td>{{ $payment->additional_info['items'][0]['title'] }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Precio unitario</td>
                                    <td>$ {{ $payment->additional_info['items'][0]['unit_price'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-md-4 mb-sm-2">
                        <p class="font-weight-bold">Detalles del Alumno</p>
                        <table class="table table-sm table-borderless  ml-2">
                            <tbody>
                                <tr>
                                    <td scope="row">Nombre y Apellido</td>
                                    <td>{{ $payment->student['name'] }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Email</td>
                                    <td>{{ $payment->student['email'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

@stop