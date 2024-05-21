<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = $club->name;
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div id="club-details" class="pt-5 pb-3 px-2 px-md-5">
        <div class="mt-5 py-5 row">
            <div class="col-md-2 text-center">
                <a href="{{asset('Club_Logos/'.$club->logo)}}">
                    <img src="{{asset('Club_Logos/'.$club->logo)}}">
                </a>
            </div>
            <div class="col-md-4">
                <span class="color-second fw-bold">Name</span>
                <h2 class="color-main mb-3">{{$election->name}}</h2>
            </div>

            <div class="col-2 text-center d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-users fs-1 mb-2 color-main"></i>
                <span class="fs-4 fw-bold">{{count(json_decode($election->candidates))}}</span>
            </div>
            <div class="col-2 text-center d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-calendar-alt fs-1 mb-2 color-main"></i>
                <span class="fs-4 fw-bold">{{$votes->count()}}</span>
            </div>
        </div>
    </div>

    @php
        $voted = false;

        if($votes->where('student_id',$student->id))
        {
            $voted = true;
        }
    @endphp

    @if(!$voted)
        <div class="p-2 p-md-4">
            <h5 class="color-second mb-4">Choose the perfect leader for your Club</h5>
            <form action="{{url('student/election/'.$election->id.'/post_vote')}}" method="post">
                @csrf
                <div class="row mb-4">
                    @forelse ($candidates as $student)
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
                            <div class="h4">No Candidates Available</div>
                        </div>
                    @endforelse

                </div>

                <input id="selected_candidate" class="d-none" name="selected_candidate" placeholder="Selected Candidate" required>

                <div class="mb-4">
                    <label for="reason" class="color-second fw-bold">Reason (optional)</label>
                    <br/>
                    <textarea name="reason" id="reason" class="form-control"></textarea>
                </div>

                <div class="text-center">
                    <button class="btn btn-main btn-md" type="submit">Vote</button>
                </div>
            </form>
        </div>
    @else
        <div class="p-2 text-center">
            <h4>You have already voted for a candidate</h4>
            <h5>please be patient as you wait for the results</h5>
        </div>
    @endif

    @include('components.student.footer')
    <script src="{{asset('assets/js/vote.js')}}"></script>
</body>

</html>
