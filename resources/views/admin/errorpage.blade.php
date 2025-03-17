@extends('admin.layout')

@section('content')
@if ($errorCode >= 400)
<h5>BAD REQUEST</h5>
<p>{{ $errorMessage }}</p>
    
@endif

@if ($errorCode == 500)
<h5>INTERNAL SERVER ERROR</h5>
<p>{{ $errorMessage }}</p>
@endif
@stop



