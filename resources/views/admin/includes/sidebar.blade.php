<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
            <a class="nav-link" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Panel
            </a>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                Sitio
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                Cursos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/cursos">Cursos</a>
                    <a class="nav-link" href="{{ route('inscriptions') }}">Inscripciones</a>
                    <a class="nav-link" href="{{ route('payments') }}">Pagos</a>
                </nav>
            </div>
            <a class="nav-link" href="/post_admin?category=rse">
                <div class="sb-nav-link-icon"><i class="far fa-newspaper"></i></div>
                RSE
            </a>
            <a class="nav-link" href="/post_admin?category=concursos">
                <div class="sb-nav-link-icon"><i class="far fa-newspaper"></i></div>
                Concursos
            </a>
            <a class="nav-link" href="{{route('media')}}">
                <div class="sb-nav-link-icon"><i class="far fa-images"></i></div>
                Multimedia
            </a>
            <a class="nav-link" href="{{route('subscriber_index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-rss"></i></div>
                Suscriptores
            </a>
            <a class="nav-link" href="/users">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Usuarios
            </a>
            <div class="sb-sidenav-menu-heading">Dev</div>
            <a class="nav-link" href="{{ route('log_viwer') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-code"></i></div>
                Logs
            </a>
            {{-- <div class="sb-sidenav-menu-heading">Interface</div> --}}
            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                Cursos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    
                    <a class="nav-link" href="layout-sidenav-light.html">Inscripciones</a>
                    <a class="nav-link" href="layout-sidenav-light.html">Pagos</a>
                </nav>
            </div> --}}
            
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->fullName() }}
    </div>
</nav>