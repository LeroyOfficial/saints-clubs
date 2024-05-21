<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
@php
    $page_title = 'Students';
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
                        <h3 class="text-dark mb-0">Students</h3>
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#">
                            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    {{-- @php
                        $classes = [
                            ''
                        ];
                    @endphp

                    @foreach ($classes as $class)

                    @endforeach --}}

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary fw-bold m-0">Student List ({{$students->count()}})</h5>
                                    <div class="dropdown no-arrow">
                                        <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                            <i class="fas fa-ellipsis-v text-gray-400"></i>
                                        </button>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                            <p class="text-center dropdown-header">dropdown header:</p>
                                            <a class="dropdown-item" href="#">&nbsp;Action</a>
                                            <a class="dropdown-item" href="#">&nbsp;Another action</a>
                                            <div class="dropdown-divider">
                                            </div>
                                            <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        @forelse ($students as $student)
                                            <div class="student col-6 col-md-3 p-2 text-center">
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
                                            </div>
                                        @empty
                                            <div class="col-12 text-center">
                                                <h4>No Students Available</h4>
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
