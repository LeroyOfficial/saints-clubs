<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = $event->name;
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="min-vh-100 pt-5">
        <div class="mt-5">

        </div>
        <div class="row py-4 mb-4">
            <div class="col-3 d-flex align-items-center justify-content-center">
                <a href="{{asset('Event_Posters/'.$event->poster)}}">
                    <img src="{{asset('Event_Posters/'.$event->poster)}}" style="max-height: 30vh;">
                </a>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-6">
                        <span class="color-second fw-bold">Name</span>
                        <h4 class="mb-2">{{$event->name}}</h4>
                    </div>
                    <div class="col-6">
                        <span class="color-second fw-bold">Venue</span>
                        <h4 class="mb-2">{{$event->venue}}</h4>
                    </div>
                    <div class="col-12">
                        {{-- <span class="color-second fw-bold">Activitites</span>
                        <h4 class="mb-2">
                            @if($event->activities)
                                @foreach ($event->activities as $activity)
                                    {{$activity}},
                                @endforeach
                            @endif
                        </h4> --}}
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                <div>
                    <span class="color-second fw-bold">Date</span>
                    <h1>{{$event->created_at->format('d/m/Y')}}</h1>
                </div>
            </div>
        </div>
        <div class="py-2 mb-4">
            <p>There is going to be an event on the 5th of may where you abc</p>
        </div>
        <div>
            <div class="d-flex justify-content-center">
                <div class="p-1 col-8 col-md-6">
                    <div class="d-flex justify-content-between py-2 mb-2">
                        <h3 class="color-second">Attendance List</h3>
                        <div>

                            @if($willAttend)
                                <a class="btn btn-danger" role="button" href="{{url('student/event/'.$event->id.'/cancel_presevation')}}">Cancel Presevation</a>
                            @else
                                <a class="btn btn-main" role="button" href="{{url('student/event/'.$event->id.'/attend')}}">Attend This Event</a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance_list as $student)
                                    <tr>
                                        <td>
                                            @if ($student->image_url)
                                                <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                            @else
                                                @if($student->gender == 'male')
                                                    <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                                @else
                                                    <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                                @endif
                                            @endif
                                        {{$student->first_name}} {{$student->last_name}}
                                        </td>
                                        <td>{{{$student->class}}}</td>
                                        <td>{{$student->gender}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.student.footer')
</body>

</html>
