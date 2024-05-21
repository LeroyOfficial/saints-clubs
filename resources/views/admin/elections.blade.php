<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Elections';
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
                        <h3 class="text-dark mb-0">Elections</h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Election List ({{$elections->count()}})</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        @forelse ($elections as $election)
                                            <div class="club text-center col-6 col-md-3 p-2">
                                                <div class="">
                                                    @php
                                                        $club = $clubs->where('id',$election->club_id)->first();
                                                    @endphp
                                                    <a href="{{asset('Club_Logos/'.$club->logo)}}">
                                                        <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="">
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <h4>
                                                        <a style="text-decoration: none;" href="{{url('admin/election/'.$election->id)}}">{{$election->name}}</a>
                                                    </h4>
                                                    <span class="badge fs-6 @if($election->status == 'in progress') bg-warning @elseif($election->status == 'completed') bg-success @elseif($election->status == 'cancelled') bg-danger @endif">{{$election->status}}</span>
                                                    @if ($election->status == 'in progress')
                                                        <p>closing date is {{\Carbon\Carbon::parse($election->end_date)->format('d M Y')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center">
                                                <h4>No Elections Hosted yet</h4>

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
