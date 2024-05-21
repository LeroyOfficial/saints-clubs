<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Event';
@endphp
<head>
    @include('components.admin.css')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('components.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('components.admin.top-nav')
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Event Details</h3>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">{{$event->name}} Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <a href="{{asset('Event_Posters/'.$event->poster)}}">
                                                <img src="{{asset('Event_Posters/'.$event->poster)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span>Name</span>
                                                    <h5 class="fw-bold text-capitalize">{{$event->name}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <span>Venue</span>
                                                    <h5 class="fw-bold text-capitalize">{{$event->venue}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <span>Date and time</span>
                                                    <h6 class="fw-bold text-capitalize">{{\Carbon\Carbon::parse($event->date_and_time)->format('d M Y')}} at {{\Carbon\Carbon::parse($event->date_and_time)->format('H:i')}}</h6>
                                                </div>
                                            </div>
                                            <span>Details</span>
                                            <p class="fw-bold">{{$event->details}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Attendance List</p>
                        </div>
                        <div class="card-body">
                            @if ($attendance_list->count() > 0)
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Age</th>
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
                            @else
                                <div class="text-center">
                                    <h2>No one has attended this event yet</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
