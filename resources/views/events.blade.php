<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Events';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')


    <div class="bg-primary min-vh-100 mt-5 py-5">
        <div class="py-2"></div>
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
