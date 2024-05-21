<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Home';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div id="hero" class="hero min-vh-100 row">
        <div class="bounce animated col-md-6">
            <h1>Welcome to<br>Saints Club <br>Student Portal</h1>
            <p>A space where current students can interact with their peers in groups.</p>
            <div class="fs-4 d-flex justify-content-evenly align-items-center">
                <a class="btn btn-dark btn-md rounded-pill me-4" role="button" href="{{url('register')}}">Sign Up Now</a>
                <a class="btn btn-light border border-dark btn-md rounded-pill me-4" role="button" href="{{url('login')}}">login</a>
            </div>
        </div>
        <div class="bounce animated col-md-6">
            <img src="{{asset('assets/img/4708ee58-c2fc-4e29-8b5d-18b8b7679a6c.svg')}}">
        </div>
    </div>
    <div class="bg-cream min-vh-100 py-5">
        <div data-aos="fade-down" class="text-center">
            <h1>Saints Club at a glance</h1>
            <p>As a research university and nonprofit institution, Saints Club is focused on creating educational opportunities for people from many lived experiences.</p>
        </div>
        <div class="row">
            <div data-aos="fade-right" class="col-md-6 text-center">
                <img src="{{asset('assets/img/971bd135-8dcd-4262-ad98-735b356e8321.svg')}}">
            </div>
            <div data-aos="fade-left" class="col-md-6">
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2021</h3>
                    <p>Saints Club was established</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2022</h3>
                    <p>reached 100+ clubs</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2023</h3>
                    <p>reached 500 students</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2024</h3>
                    <p>reached 1000 students</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-cream min-vh-100 py-5">
        <div data-aos="fade-down" class="text-center">
            <h1>Clubs</h1>
            <p>Check out our clubs 👇</p>
        </div>
        <div class="row px-2 px-md-5">

            @forelse ($clubs as $club)
                <div data-aos="fade-right" class="col-sm-6 col-md-3 p-2">
                    <div class="bg-second text-white p-2 text-center rounded-4">
                        <div class="bg-white p-1 rounded-4 rounded-bottom">
                            <img class="vh-30" src="{{asset('Club_Logos/'.$club->logo)}}">
                        </div>
                        <div>
                            <a href="{{url('student/club/'.$club->id)}}">
                                <h2>{{$club->name}}</h2>
                            </a>
                            <div class="d-flex justify-content-evenly p-1 fw-bold fs-5">
                                <div>
                                    <span class="me-1">{{count($club->members)}}</span>
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <span class="me-1">{{$events->where('club_id',$club->id)->count()}}</span>
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div data-aos="fade" class="col-12 p-2 d-none">
                    <div class="bg-white p-4 text-center">
                        <h1>No Clubs Available</h1>
                        <h4>Tell Admin to add come clubs</h4>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
    <div class="bg-primary min-vh-100 py-5">
        <div data-aos="fade-down" class="text-center text-white">
            <h1>Events</h1>
            <p>Check out upcoming events 👇</p>
        </div>
        <div class="row px-2 px-md-5">

            @forelse ($events as $event)
                <div data-aos="fade-right" class="col-sm-6 col-md-3 p-2">
                    <div class="bg-white p-2 text-center rounded-4">
                        <div>
                            <img src="{{asset('Event_Posters/'.$event->poster)}}">
                        </div>
                        <div>
                            <a href="{{url('student/event/'.$event->id)}}">
                                <h2>{{$event->name}}</h2>
                            </a>
                            <h4>{{$event->venue}}</h4>
                            <h4>{{$event->created_at->format('d/m/Y')}}</h4>
                        </div>
                    </div>
                </div>
            @empty
                <div data-aos="fade" class="col-12 p-2 d-none">
                    <div class="bg-white p-4 text-center">
                        <h1>No Clubs Available</h1>
                        <h4>Tell Admin to add come clubs</h4>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
    @include('components.student.footer')
</body>

</html>
