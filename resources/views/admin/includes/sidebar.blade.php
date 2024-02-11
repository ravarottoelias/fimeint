<ul class="list-unstyled">
    {{-- <li>
        <a href="#ul_leads" data-toggle="collapse">
            <i class="fas fa-envelope"></i> Leads
        </a>
        <ul id="ul_leads" class="list-unstyled collapse">
            <li><a href="#">Contacto</a></li>
        </ul>
    </li> --}}
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="fas fa-chart-line"></i>
            Panel
        </a>
        <a href="/cursos">
            <i class="fas fa-graduation-cap"></i>
            Cursos
        </a>
        <a href="/post_admin?category=rse">
            <i class="far fa-newspaper"></i>
            RSE
        </a>
        <a href="/post_admin?category=concursos">
            <i class="far fa-newspaper"></i>
            Concursos
        </a>
        <a href="{{route('media')}}">
            <i class="far fa-images"></i>
            Multimedia
        </a>
        <a href="{{route('subscriber')}}">
            <i class="fas fa-rss"></i>
            Suscriptores
        </a>
        <a href="/users">
            <i class="fas fa-users"></i>
            Usuarios
        </a>
    </li>
    <li><a href="/"><i class="fas fa-globe"></i> Sitio</a></li>
</ul>