<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Clubs';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="bg-cream min-vh-100 mt-5 py-5">
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

    @include('components.student.footer')
</body>

</html>
