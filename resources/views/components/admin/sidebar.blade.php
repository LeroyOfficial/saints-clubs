<nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{url('admin/dashboard')}}">
            <div class="sidebar-brand-icon">
                <img class="border rounded-circle img-profile" style="height:7vh;" src="{{asset('admin/assets/img/logo.jpeg')}}">
            </div>
            <div class="sidebar-brand-text mx-3">
                <span>Saints Club</span>
            </div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item">
                <a class="nav-link @if($page_title == 'Dashboard') active @endif" href="{{url('admin/dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($page_title == 'Students' || $page_title == 'Student') active @endif" href="{{url('admin/students')}}">
                    <i class="fas fa-user"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($page_title == 'Clubs' || $page_title == 'Club' || $page_title == 'Create A New Club') active @endif" href="{{url('admin/clubs')}}">
                    <i class="fas fa-table"></i>
                    <span>Clubs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($page_title == 'Events' || $page_title == 'Event') active @endif" href="{{url('admin/events')}}">
                    <i class="fas fa-calendar fa-2x"></i>
                    <span>Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($page_title == 'Elections' || $page_title == 'Election') active @endif" href="{{url('admin/elections')}}">
                    <i class="fas fa-calendar fa-2x"></i>
                    <span>Elections</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();
                ">
                    <i class="far fa-user-circle"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        <div class="text-center d-none d-md-inline">
            <button class="btn rounded-circle border-0" id="sidebarToggle" type="button">
            </button>
        </div>

        <form id="logout-form" hidden="" method="POST" action="{{route('logout')}}">
            @csrf
        </form>
    </div>
</nav>
