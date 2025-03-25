<nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
    <div class="sb-sidenav-menu h-100 d-flex justify-content-between flex-column    ">
        <div class="nav">
            {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
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