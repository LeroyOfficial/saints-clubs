<nav class="fixed-top bg-second text-white px-2 px-md-5 py-3" style="border-bottom-style: solid;border-bottom-color: var(--color-main);">
    <div class="d-flex">
        <div class="col-10 col-md-4">
            <a class="d-flex align-items-center" @auth href="{{url('student/dashboard')}}" @else href="{{url('/')}}" @endauth>
            <img class="vh-10 me-2" src="{{asset('assets/img/logo.png')}}">
            <span class="fw-bold fs-3">
                <span class="me-1" style="color: var(--color-main);">Saints</span>
                <span>Clubs</span>
            </span>
            </a>
        </div>
        <div class="d-none d-md-flex justify-content-end align-items-center col-8 fw-bold fs-5 text-capitalize">
            <a class="me-4" @auth href="{{url('student/dashboard')}}" @else href="{{url('/')}}" @endauth>Home</a>
            <a class="me-4" href="{{url('about')}}">About</a>
            <a class="me-4" @auth href="{{url('student/clubs')}}" @else href="{{url('/clubs')}}" @endauth>Clubs</a>
            <a class="me-4" @auth href="{{url('student/events')}}" @else href="{{url('/events')}}" @endauth>Events</a>
            <a class="me-4" href="{{url('student/help')}}">Help</a>

            @auth
                {{-- <a class="me-4" @auth href="{{url('student/elections')}}" @endauth>Elections</a> --}}

                <form id="logout-form" hidden="" method="POST" action="{{route('logout')}}">
                    @csrf
                </form>

                <a class="btn btn-dark btn-md rounded-pill me-4" role="button" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            @else
                <a class="btn btn-dark btn-md rounded-pill me-4" role="button" href="{{url('register')}}">Sign Up</a>

                <a class="btn btn-light border border-dark btn-md rounded-pill me-4" role="button" href="{{url('login')}}">login</a>
            @endauth
        </div>
        <div class="d-flex justify-content-center align-items-center d-md-none col-2">
            <div class="dropdown">
                <button class="btn p-1" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                <i class="fas fa-align-justify fs-2">
                </i>
            </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" @auth href="{{url('student/dashboard')}}" @else href="{{url('/')}}" @endauth>Home</a>
                    <a class="dropdown-item" href="{{url('about')}}">About</a>
                    <a class="dropdown-item" href="{{url('events')}}">Events</a>
                    <a class="dropdown-item" href="{{url('help')}}">Help</a>

                    @auth
                        <a class="dropdown-item" href="{{url('/student/elections')}}">Elections</a>

                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    @else
                        <a class="dropdown-item" href="{{url('register')}}">Sign up</a>
                        <a class="dropdown-item" href="{{url('login')}}">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
