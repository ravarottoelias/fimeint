<nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
    <div class="sb-sidenav-menu h-100 d-flex justify-content-between flex-column    ">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Mi cuenta</div>
            <a class="nav-link" href="{{ route('show_account', Auth::user()->id) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                 Datos Personales
            </a>
            <a class="nav-link" href="{{ route('profile_form_change_password', Auth::user()->id) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                 Cambiar Contraseña
            </a>
            <div class="sb-sidenav-menu-heading">Cursos</div>
            <a class="nav-link" href="{{ route('account_my_courses', Auth::user()->id) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                 Mis Cursos
            </a>
            <a class="nav-link" href="{{ route('account_my_certificates', Auth::user()->id) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-certificate"></i></div>
                 Mis Certificados
            </a>
            <div class="sb-sidenav-menu-heading">Otros</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                Sitio FIMe
            </a> 
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->fullName() }}
    </div>
</nav>