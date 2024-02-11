@extends('sitio.layout')

@section('content')

<section class="main recuperar-contrasenia py-5">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-lg-6 mx-auto text-center">
        	@if($user)
	        	<div class="w-100 text-center">
	        		<img src="https://img.icons8.com/color/144/000000/check-all.png"/>
	        	</div>
        		<p class="text-center my-3" style="font-size: 18px">Se ha enviado una nueva contraseña a su correo electrónico.</p>
        		<a class="text-center my-3" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
        	@else
	        	<div class="w-100 text-center">
	        		<img src="https://img.icons8.com/cute-clipart/64/000000/nothing-found.png"/ width="100">
	        	</div>
        		<p class="text-center my-3" style="font-size: 18px">Lo sentimos, el email ingresado no se encuentra registrado en nuestra base de datos.</p>
        		<a href="{{route('reset_password')}}"><i class="fas fa-arrow-left"></i> Volver</a>
        	@endif
        </div>
    </div>
</div>
</section>

@stop