<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Election';
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
                        <h3 class="text-dark mb-0">Election Details</h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">{{$election->name}} Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <a href="{{asset('Club_Logos/'.$club->logo)}}">
                                                <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" style="height: 20vh;">
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-8">
                                                    <span>Name</span>
                                                    <h5 class="fw-bold text-capitalize">{{$election->name}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <span>Closing Date</span>
                                                    <h6 class="fw-bold text-capitalize">{{\Carbon\Carbon::parse($election->end_date)->format('d M Y')}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @if($election->winner)
                                                @php
                                                    $winner = $students->where('id',$election->winner)->first();
                                                @endphp
                                                <div class="text-center">
                                                    <span class="text-primary">Winner</span>
                                                </div>
                                                <div class="text-center">
                                                    @if ($winner->image_url)
                                                        <img src="{{asset('Student_Pics/'.$winner->image_url)}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                    @else
                                                        @if($winner->gender == 'male')
                                                            <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                        @else
                                                            <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{url('admin/student/'.$winner->id)}}">
                                                        <h6 class="fw-bold text-capitalize">{{$winner->first_name}} {{$winner->last_name}}</h6>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="text-center d-flex flex-column justify-content-center align-items-center">
                                                    @if(\Carbon\Carbon::parse($election->end_date) < \Carbon\Carbon::now())
                                                        <h6 class="mb-2">Voting time has ended and the winner is</h6>
                                                        @if($votes->count() > 0)
                                                            @php
                                                                $winner = $students->where('id',$top_candidate)->first();
                                                            @endphp

                                                            <h6 class="mb-2">{{$winner->first_name}} {{$winner->last_name}}</h6>


                                                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/election/'.$election->id.'/confirm_winner/'.$top_candidate)}}">
                                                                Confirm Winner
                                                            </a>
                                                        @else
                                                            <h6 class="mb-2">no one coz no votes found</h6>
                                                        @endif
                                                    @else
                                                        <h6 class="mb-2">No winner yet</h6>
                                                        <span class="badge fs-6 @if($election->status == 'in progress') bg-warning @elseif($election->status == 'complete') bg-success @elseif($election->status == 'cancelled') bg-danger @endif">{{$election->status}}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Candidate List</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($candidates as $student)
                                    <div class="col-6 col-md-3 p-2 px-4 text-center">
                                        <div class="student p-2">
                                            <span class="student_id d-none">{{$student->id}}</span>
                                            <div class="">
                                                @if ($student->image_url)
                                                    <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" style="height: 20vh;">
                                                @else
                                                    @if($student->gender == 'male')
                                                        <img src="{{asset('assets/img/face-man.jpg')}}" alt="" style="height: 20vh;">
                                                    @else
                                                        <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" style="height: 20vh;">
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="">
                                                <a href="{{url('admin/student/'.$student->id)}}">
                                                    <h5>{{$student->first_name}} {{$student->last_name}}</h5>
                                                </a>
                                                <h6>{{$student->class}}</h6>
                                            </div>
                                            <div class="text-center">
                                                <h6>{{$votes->where('chosen_candidate',$student->id)->count()}} votes</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Vote @if(!$election->winner)Progress @else Results @endif</p>
                        </div>
                        <div class="card-body">
                            @if ($votes->count() > 0)
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Candidate Chosen</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($votes as $vote)
                                            <tr>
                                                <td>
                                                    @php
                                                        $student = $students->where('id',$vote->student_id)->first();
                                                    @endphp
                                                    @if ($student->image_url)
                                                        <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                    @else
                                                        @if($student->gender == 'male')
                                                            <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                        @else
                                                            <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                        @endif
                                                    @endif
                                                    {{$student->first_name}} {{$student->last_name}}
                                                </td>
                                                <td>
                                                    @php
                                                        $student = $students->where('id',$vote->chosen_candidate)->first();
                                                    @endphp
                                                    @if ($student->image_url)
                                                        <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                    @else
                                                        @if($student->gender == 'male')
                                                            <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                        @else
                                                            <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 5vh;">
                                                        @endif
                                                    @endif
                                                    {{$student->first_name}} {{$student->last_name}}
                                                </td>
                                                <td>{{$vote->reason}}</td>
                                                <td>{{$vote->created_at->format('d M Y')}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="text-center">
                                    <h2>No one has voted yet</h2>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
