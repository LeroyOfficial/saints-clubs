<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Dashboard';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="min-vh-100 py-5 px-2 px-md-4">
        <div class="mt-5 pt-4 text-center">
            <h1>Welcome {{$student->first_name}}</h1>
        </div>
        <div class="mb-5">
            <h2>My Clubs ({{$clubs->count()}})</h2>
            <div class="row py-2">
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
                                <div class="text-center">
                                    <span>joined on {{\Carbon\Carbon::parse($joinDate->where('club_id',$club->id)->value('join_date'))->format('d M Y')}}</span>
                                </div>
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
                    <div class="col-12 text-center">
                        <h1>It seems that you havent joined any clubs yet</h1>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mb-5">
            <h2>Events ({{$events->count()}})</h2>
            <div class="row py-2">

                @forelse ($events as $event)
                    <div data-aos="fade-right" class="col-sm-6 col-md-3 p-2">
                        <div class="bg-second text-white p-2 text-center rounded-4">
                            <div class="bg-white p-1 rounded-4 rounded-bottom">
                                <img class="vh-30" src="{{asset('Event_Posters/'.$event->poster)}}">
                            </div>
                            <div>
                                <a href="{{url('student/event/'.$event->id)}}">
                                    <h4>{{$event->name}}</h4>
                                </a>
                                <h5>{{$event->venue}}</h5>
                                <h6>{{$event->created_at->format('d/m/Y')}}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                        <div class="col-12 text-center">
                            <h2>No events available yet</h2>
                        </div>
                @endforelse

            </div>
        </div>
    </div>
    @include('components.student.footer')
</body>

</html>
