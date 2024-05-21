<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Student';
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
                        <h3 class="text-dark mb-0">Student Details</h3>

                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/student/'.$student->id.'/generate_report')}}">
                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">{{$student->name}} Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            @if ($student->image_url)
                                                <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" class="rounded-circle me-2" style="height: 20vh;">
                                            @else
                                                @if($student->gender == 'male')
                                                    <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 20vh;">
                                                @else
                                                    <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 20vh;">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <span class="text-primary">Name</span>
                                            <h6 class="fw-bold text-capitalize">{{$student->first_name}} {{$student->last_name}}</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="text-primary">Gender</span>
                                            <h6 class="fw-bold text-capitalize">{{$student->gender}}</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="text-primary">Class</span>
                                            <h6 class="fw-bold text-capitalize">{{$student->class}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Clubs which @if($student->gender == 'male')he @else she @endif is a member of ({{$clubs->count()}})</p>
                        </div>
                        <div class="card-body">
                            @if ($studentClubs->count() > 0)
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>Leader</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentClubs as $club)
                                            <tr>
                                                <td>
                                                    <a href="{{url('admin/club/'.$club->id)}}">
                                                        <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" class="me-2" style="height: 30px;">
                                                        {{$club->name}}
                                                    </a>
                                                </td>
                                                <td>{{{$club->details}}}</td>
                                                <td>
                                                    @if ($club->leader)
                                                        @php
                                                            $student = $students->where('id',$club->leader)->first();
                                                        @endphp
                                                        {{$student->first_name}} {{$student->last_name}}
                                                    @else
                                                        this club doesn't have a leader yet
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="text-center">
                                    <h2>This Student hasnt joined any clubs yet</h2>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Club History</p>
                        </div>
                        <div class="card-body">
                            @if($histories->count() > 0)
                                <div class="row">
                                    @foreach ($clubs as $club)
                                        <div class="event col-6 col-md-3">
                                            <div class="mb-1 text-center">
                                                <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="{{$club->name}}'s poster">
                                            </div>
                                            <div class="text-center">
                                                <h4>
                                                    <a style="text-decoration: none;" href="{{url('admin/club/'.$club->id)}}">{{$club->name}}</a>
                                                </h4>
                                            </div>
                                            <div class="">
                                                @if($histories->where('club_id',$club->id)->count())
                                                    @foreach($histories as $history)
                                                        @if($history->club_id == $club->id)
                                                            <span>was member from {{\Carbon\Carbon::parse($history->join_date)->format('d M Y')}}</span>
                                                            @if($history->exit_date)
                                                                <span>to {{\Carbon\Carbon::parse($history->exit_date)->format('d M Y')}}</span>
                                                            @else
                                                                <span>till now</span>
                                                            @endif
                                                        @endif
                                                        <br/>
                                                    @endforeach
                                                @else
                                                    <div class="text-center">
                                                        <span>never been a member</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h4>no club history available</h4>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
                            <p class="text-primary m-0 fw-bold">Events Attended ({{$events_attended->count()}})</p>
                        </div>
                        <div class="card-body">
                            @if ($events_attended->count() > 0)
                                <div class="row">
                                    @foreach ($events_attended as $event)
                                        <div class="event col-6 col-md-3">
                                            <div class="mb-1">
                                                <img src="{{asset('Event_Posters/'.$event->poster)}}" alt="{{$event->name}}'s poster">
                                            </div>
                                            <div class="text-center">
                                                <h4>
                                                    <a style="text-decoration: none;" href="{{url('admin/event/'.$event->id)}}">{{$event->name}}</a>
                                                </h4>
                                                <p class="text-truncate">{{$event->details}}</p>
                                                <span>{{$event->date_and_time->format('d/m/y')}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <h2>This student hasn't attended any events yet</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
