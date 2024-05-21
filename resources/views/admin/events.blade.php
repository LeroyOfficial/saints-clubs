<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Events';
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
                        <h3 class="text-dark mb-0">Events</h3>
                        {{-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/new_club')}}">
                            Create A New Event
                        </a> --}}
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Event List ({{$events->count()}})</h5>        
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        
                                        @forelse ($events as $event)
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
                                        @empty
                                            <div class="col-12 text-center">
                                                <h4>No Events Available</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')
</body>

</html>
