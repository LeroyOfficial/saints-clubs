<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = $club->name;
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
                        <h3 class="text-dark mb-0">Club Details</h3>

                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/club/'.$club->id.'/generate_report')}}">
                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report
                        </a>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">{{$club->name}} Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <a href="{{asset('Club_Logos/'.$club->logo)}}">
                                                        <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" style="height: 20vh;">
                                                    </a>
                                                </div>
                                                <div class="col-md-9">
                                                    <span class="text-primary">Name</span>
                                                    <h4 class="fw-bold text-capitalize">{{$club->name}}</h4>
                                                    <span>Details</span>
                                                    <p>{{$club->details}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @if($club->leader)
                                                @php
                                                    $leader = $members->where('id',$club->leader)->first();
                                                @endphp
                                                <div class="text-center">
                                                    <span class="text-primary">Leader</span>
                                                </div>
                                                <div class="text-center">
                                                    @if ($leader->image_url)
                                                        <img src="{{asset('Student_Pics/'.$leader->image_url)}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                    @else
                                                        @if($leader->gender == 'male')
                                                            <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                        @else
                                                            <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 15vh;">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{url('admin/student/'.$leader->id)}}">
                                                        <h6 class="fw-bold text-capitalize">{{$leader->first_name}} {{$leader->last_name}}</h6>
                                                    </a>
                                                </div>
                                            @else
                                                @php
                                                    $electionInProgress = false;
                                                    if($elections->where('status','in progress')->count()> 0)
                                                        {
                                                            $electionInProgress = true;
                                                        }
                                                @endphp
                                                @if($electionInProgress)
                                                    <div class="text-center">
                                                        <h6>Election in progress</h6>
                                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/election/'.$elections->where('status','in progress')->first()->value('id') )}}">
                                                            Check Election Progress
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <h6 class="mb-2">This Club doesnt have a Leader</h6>
                                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/club/'.$club->id.'/new_election')}}">
                                                            Host an Election
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                            <p class="text-primary m-0 fw-bold">Members List ({{$members->count()}})</p>
                            {{-- @if(!$club->leader)
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/club/'.$club->id.'/new_election')}}">
                                    Host an Election
                                </a>
                            @endif --}}
                        </div>
                        <div class="card-body">
                            @if ($members->count() > 0)
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>
                                                    <a href="{{url('admin/student/'.$member->id)}}">
                                                        @if ($member->image_url)
                                                            <img src="{{asset('Student_Pics/'.$member->image_url)}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                                        @else
                                                            @if($member->gender == 'male')
                                                                <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                                            @else
                                                                <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="rounded-circle me-2" style="height: 30px;">
                                                            @endif
                                                        @endif
                                                        {{$member->first_name}} {{$member->last_name}}
                                                    </a>
                                                </td>
                                                <td>{{{$member->class}}}</td>
                                                <td>{{$member->gender}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="text-center">
                                    <h2>This Club doesnt have any members yet</h2>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
                            <p class="text-primary m-0 fw-bold">Club Events ({{$events->count()}})</p>

                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/club/'.$club->id.'/new_event')}}">
                                Add an Event
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($events->count() > 0)
                                <div class="row">
                                    @foreach ($events as $event)
                                        <div class="event col-6 col-md-3">
                                            <div class="mb-1">
                                                <img src="{{asset('Event_Posters/'.$event->poster)}}" alt="{{$event->name}}'s poster">
                                            </div>
                                            <div class="text-center">
                                                <h4>
                                                    <a style="text-decoration: none;" href="{{url('admin/event/'.$event->id)}}">{{$event->name}}</a>
                                                </h4>
                                                <p class="text-truncate">{{$event->details}}</p>
                                                <span>{{$event->created_at->format('d/m/y')}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <h2>This Club doesnt have any events yet</h2>
                                    <a href="{{url('admin/club/'.$club->id.'/new_event')}}" class="fs-4">click here to add an event</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
