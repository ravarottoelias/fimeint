@extends('admin.layout')

@section('content')

	<h1 class="mt-4">Pagos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pagos</li>
    </ol>


    <table class="table table-sm table-sm-text-sm">

        <!--Table head-->
        <thead>
            <tr>
                <th>#ID</th>
                <th>Estado</th>
                <th>Alumno</th>
                <th>Creado en</th>
            </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody>
        @foreach ( $payments as $payment)
            <tr class="">
                <td><a href="{{ route('payment_details', $payment->payment_identifier) }}"> {{ $payment->payment_identifier }}</a></td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->inscription->alumno->fullName() }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
        <!--Table body-->
    </table>

    <div class="d-flex justify-content-center">

        {{ $payments->links('vendor.pagination.bootstrap-4') }}
    </div>


@stop