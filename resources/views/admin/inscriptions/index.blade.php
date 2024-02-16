@extends('admin.layout')

@section('content')

	<h1 class="mt-4">Inscripciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Inscripciones</li>
    </ol>


    <table class="table table-sm v-middle">
        <thead>
            <tr class="bg-light">
                <th class="border-top-0">#ID</th>
                <th class="border-top-0">Usuario</th>
                <th class="border-top-0">Curso</th>
                <th class="border-top-0">Pago</th>
                <th class="border-top-0">Creado en</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $inscriptions as $inscription)
            <tr>
                <td><a href="{{ route('inscription_show', $inscription->id) }}"> {{ $inscription->id }}</a></td>
                <td>{{ $inscription->alumno->fullName() }}</td>
                <td>{{ $inscription->curso->titulo }}</td>
                <td>{{ $inscription->estado_del_pago }}</td>
                <td>{{ $inscription->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">

        {{ $inscriptions->links('vendor.pagination.bootstrap-4') }}
    </div>


@stop