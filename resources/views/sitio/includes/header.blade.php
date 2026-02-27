@if(Auth::user())
	<nav class="navbar navbar-expand-lg navbar-dark bg-fime-primary py-2 ">
		<a class="text-white py-0" href="#"><i class="far fa-hand-paper"></i> Hola {{ Auth::user()->name }}</a>
		<a class="btn btn-sm text-white d-md-block d-lg-none" href="{{ route('my_panel') }}"><i class="fas fa-user-circle"></i> Mi Cuenta</a>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto"></ul>
			@if(Auth::user()->hasRoles(['admin']))
				<a class="btn btn-sm text-white" href="{{ route('dashboard') }}"><i class="fas fa-user-circle"></i> Mi Cuenta</a>
			@else
				<a class="btn btn-sm text-white" href="{{ route('my_panel') }}"><i class="fas fa-user-circle"></i> Mi Cuenta</a>
			@endif
		</div>
	</nav>
@else
	<nav class="navbar navbar-expand-lg navbar-dark bg-fime-primary py-2">
		<ul class="navbar-nav mr-auto"></ul>
		<a class="btn btn-dark btn-sm my-sm-0 mr-1" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
		<a class="btn btn-dark btn-sm my-sm-0" href="{{ route('register') }}"><i class="fas fa-user-edit"></i> Registrarse</a>	
	</nav>
@endif


<header id="mu-hero" class="box-shadow-1">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light mu-navbar">
			<!-- Text based logo -->
			<a class="navbar-brand mu-logo" href="/" style="max-width: 235px;">
				<img src="{{asset('images/nuevo-logo-fime.png')}}">
			</a>
			<!-- image based logo -->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="fa fa-bars"></span>
		  </button>

		  <button type="button" id="sidebarCollapse" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" class="navbar-btn collapsed active">
		  	<span></span> <span></span> <span></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto mu-navbar-nav">
				<li class="nav-item"><a href="/" class="ascent">Inicio</a></li>
				<li class="nav-item dropdown">
					<a class="dropdown-toggle" href="blog.html" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quiénes Somos</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('quienes_somos')}}#mision-vision-valores">Misión, Visión y Valores</a>
						<a class="dropdown-item" href="{{route('quienes_somos')}}#equipo">Equipo</a>
						{{-- <a class="dropdown-item" href="{{route('quienes_somos')}}#antecedentes">Antecedentes</a> --}}
					</div>
				</li>
				<li class="nav-item"><a href="{{route('servicios')}}" class="ascent">Servicios</a></li>
				<li class="nav-item dropdown">
					<a class="dropdown-toggle" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RSE</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('proyectos_rse')}}">Proyectos y Programas</a>
					</div>
				</li>
				<li class="nav-item dropdown">
				<a class="dropdown-toggle" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Capacitaciones</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('all_posts')}}?categoria=oferta-academica">Oferta Académica</a>
					<a class="dropdown-item" href="{{route('cursos_homologados')}}">Cursos Homologados</a>
					<a class="dropdown-item" href="{{route('cursos_otros')}}">Otras Propuestas</a>
				</div>
				</li>
				<li class="nav-item"><a href="{{route('concursos', ['status' => 'En Curso'])}}" style="border: solid 2px #c75555;
					background-color: #c75555;
					color: white;">Concurso</a></li>
				<li class="nav-item"><a href="{{route('aula_virtual')}}">Aula Virtual</a></li>
				<li class="nav-item"><a href="{{route('consultoria_pymes_familiares')}}">Consultoría a Pymes Familiares</a></li>
				<li class="nav-item"><a href="{{route('alianza')}}"><img class="mr-1" style="height: 55px" src="/images/alianza-fime-tsm-icon.png">Alianza</a></li>
				<li class="nav-item"><a href="{{route('contacto')}}">Contacto</a></li>
		    </ul>
		  </div>
		</nav>
	</div>
</header>
