<a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
<a class="navbar-brand" href="#">FIMe</a>

<div class="navbar-collapse collapse">
    <ul class="navbar-nav ml-auto">
        {{--         
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li> 
        --}}
        <li class="nav-item dropdown">
            <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                <a href="#" 
                   class="dropdown-item" 
                   onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit()">
                	<i class="fas fa-sign-out-alt"></i> Salir
                </a>
                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>
</div>