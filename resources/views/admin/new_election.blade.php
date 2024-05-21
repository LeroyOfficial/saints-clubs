<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Add a New Election';
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
                        <h3 class="text-dark mb-0">Add an Election for {{$club->name}}</h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Add an Election for {{$club->name}}</h5>

                                </div>
                                <div class="card-body">
                                    <form action="{{url('admin/club/'.$club->id.'/post_new_election')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">
                                                        <strong>Election Name</strong>
                                                    </label>
                                                    <input class="form-control" type="text" id="name" placeholder="Election Name" name="name" value="{{$club->name}} Election" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="details">
                                                        <strong>Choose Candidates</strong>
                                                    </label>
                                                    <div class="row">
                                                        @forelse ($students as $student)
                                                            <div class="col-6 col-md-3 p-2 px-4 text-center" style="cursor: pointer;">
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
                                                                        <h5>{{$student->first_name}} {{$student->last_name}}</h5>
                                                                        <h6>{{$student->class}}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="col-12 text-center">
                                                                <div class="h4">No Members Available</div>
                                                            </div>
                                                        @endforelse

                                                    </div>
                                                    <input id="candidate_list_input" class="d-none" name="candidates" placeholder="Candidate List" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="end_date">
                                                        <strong>End Date</strong>
                                                    </label>
                                                    <input class="form-control" name="end_date" type="datetime-local" id="end_date" placeholder="Date And Time" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.admin.footer')

            <script src="{{asset('assets/js/new_election.js')}}"></script>
</body>

</html>
