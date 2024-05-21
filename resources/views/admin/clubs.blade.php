<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Clubs';
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
                        <h3 class="text-dark mb-0">Clubs</h3>
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{url('admin/new_club')}}">
                            Create A New CLub
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Club List ({{$clubs->count()}})</h5>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        
                                        @forelse ($clubs as $club)
                                            <div class="club text-center col-6 col-md-3 p-2">
                                                <div class="">
                                                    <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="{{$club->name}}'s logo">
                                                </div>
                                                <div class="">
                                                    <h4>
                                                        <a style="text-decoration: none;" href="{{url('admin/club/'.$club->id)}}">{{$club->name}}</a>
                                                    </h4>
                                                    <p class="text-truncate">{{$club->details}}</p>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center">
                                                <h4>No Clubs Available</h4>
                                                <a href="{{url('admin/new_club')}}" class="fs-6">click here to add a new club</a>
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
