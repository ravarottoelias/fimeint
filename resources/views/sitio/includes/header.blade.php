@if(Auth::user())
  	@if(Auth::user()->hasRoles(['admin']))
	<nav class="navbar navbar-expand-xs navbar-expand-sm navbar-expand-lg bg-fime-secundary navbar-user-registered d-flex justify-content-between">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{route('dashboard')}}">
					<i class="fas fa-tachometer-alt"></i>
					Panel
				</a>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('edit_profile') }}">
				{{Auth::user()->name}} |
				</a>
			</li>
			<li class="nav-item">
				<a href="#"
				class="nav-link" 
						onclick="event.preventDefault();
								document.getElementById('logout-form').submit()">
					Salir <i class="fas fa-sign-out-alt"></i> 
					</a>
					<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
						{{ csrf_field() }}
					</form>
			</li>
		</ul>
	</nav>
	@else
	<nav class="navbar navbar-expand-xs navbar-expand-sm navbar-expand-lg bg-fime-secundary navbar-user-registered d-flex justify-content-end">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('edit_profile') }}">
				{{Auth::user()->name}} |
				</a>
			</li>
			<li class="nav-item">
				<a href="#"
				class="nav-link" 
				onclick="event.preventDefault();
								document.getElementById('logout-form').submit()">
					Salir <i class="fas fa-sign-out-alt"></i> 
				</a>
				<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</nav>
	@endif
@else
	<nav class="navbar navbar-expand-xs navbar-expand-sm navbar-expand-lg bg-fime-secundary navbar-user-registered d-flex justify-content-end">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">
					<i class="fas fa-sign-in-alt"></i> Iniciar Sesión
				</a>
			</li>
		</ul>
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
				<li class="nav-item"><a href="{{route('concursos')}}" style="border: solid 2px #c75555;
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
