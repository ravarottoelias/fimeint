<div class="mu-sidebar-widget mu-sidebar-subscribe-widget pb-3">
	<h2 class="mu-sidebar-widget-title">Noticias y Novedades</h2>

	<p class="px-3 text-muted">Dejanos tu dirección de correo y número para whatsapp y recibe las últimas noticias y novedades </p>
	<div class="text-danger">{{ $errors->first('email') }}</div>
	<div class="text-danger">{{ $errors->first('telefono') }}</div>
	<form class="mu-subscribe-form mt-1 px-3" 
		  action="{{ route('subscriber') }}" 
		  method="POST">
		{{ csrf_field() }}
		<input class="mb-1" placeholder="Ingrese su whatsapp" type="text" name="telefono" required>

		<input placeholder="Ingrese su email" type="email" name="email" required>
		<button type="submit" class="mu-subscribe-btn">Enviar</button>
	</form>

</div>