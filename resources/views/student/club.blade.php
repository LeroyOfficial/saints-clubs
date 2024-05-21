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
                <h2 class="color-main mb-3">{{$club->name}}</h2>

                <span class="color-second fw-bold">Details</span>
                <p class="color-main mb-4">{{$club->details}}</p>
            </div>
            <div class="col-2 text-center d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-users fs-1 mb-2 color-main"></i>
                <span class="fs-4 fw-bold">{{$members->count()}}</span>
            </div>
            <div class="col-2 text-center d-flex flex-column justify-content-center align-items-center">
                <i class="fas fa-calendar-alt fs-1 mb-2 color-main"></i>
                <span class="fs-4 fw-bold">{{$events->count()}}</span>
            </div>
            <div class="col-md-2 text-center d-flex flex-column justify-content-center align-items-center">
                @if(!$isMember)
                    <p>You are not a member of this Club</p>
                    <a href="{{url('student/join_club/'.$club->id)}}" class="btn btn-main" role="button">Join Club</a>
                @else
                    <p>You are a member of this Club since {{\Carbon\Carbon::parse($history->join_date)->format('d M Y')}}</p>
                    <a href="{{url('student/leave_club/'.$club->id)}}" class="btn btn-danger" role="button">Leave Club</a>
                @endif
            </div>
        </div>
    </div>

    @if($isMember)
        <div id="tab-list" class="p-2 text-center">
            <button class="btn btn-light btn-main border border-dark rounded-0" id="chat-btn" type="button">Chat</button>

            <button id="members-btn" class="btn btn-light border border-dark rounded-0" type="button">Members</button>

            <button id="notifications-btn" class="btn btn-light border border-dark rounded-0" type="button">Notifications</button>

            <button id="events-btn" class="btn btn-light border border-dark rounded-0" type="button">Events</button>

            @php
                $electionInProgress = $elections->count();
            @endphp

            @if($electionInProgress > 0)
                <button id="elections-btn" class="btn btn-light border border-dark rounded-0" type="button">Elections</button>
            @endif
        </div>

        <div id="tab-list" class="p-0 m-0">

            <div id="chat-div" data-aos="fade-down" class="div py-3 px-2 px-md-5">
                {{-- <h2 class="color-second">Chat</h2> --}}
                <div id="club-chat" class="rounded-4 p-2" style="border: 2px solid var(--color-main) ;">
                    <div id="message-list" class="message-list vh-70 overflow-auto py-2 bg-grey">
                        <div id="chat-to-chat" class="d-flex justify-content-center mb-4">
                            <div>
                                <p class="bg-main p-2 rounded">Chat is Protected end to end</p>
                            </div>
                        </div>

                        @if($messages->count() > 0)
                            @foreach ($grouped_messages as $date => $messages )
                                <div id="date" class="date text-center mb-4 p-2">
                                    @if (\Carbon\Carbon::parse($date)->isToday())
                                        <span class="fw-bold bg-white rounded-pill p-1 px-2">Today</span>
                                    @elseif (\Carbon\Carbon::parse($date)->isYesterday())
                                    <span class="fw-bold bg-white rounded-pill p-1 px-2">Yesterday</span>
                                    @else
                                        <span class="fw-bold bg-white rounded-pill p-1 px-2">{{$date}}</span>
                                    @endif
                                </div>
                                @foreach($messages as $message)
                                    <div class="message @if($message->sender_id == $student->id) sent @else recieved @endif mb-4 d-flex">
                                        @php
                                            $student = $students->where('id',$message->sender_id)->first()
                                        @endphp
                                        <div class="px-2">
                                            @if ($student->image_url)
                                                <img src="{{asset('Student_Pics/'.$student->image_url)}}" alt="" class="user-pic rounded-circle">
                                            @else
                                                @if($student->gender == 'male')
                                                    <img src="{{asset('assets/img/face-man.jpg')}}" alt="" class="user-pic rounded-circle">
                                                @else
                                                    <img src="{{asset('assets/img/face-woman.jpg')}}" alt="" class="user-pic rounded-circle">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="message-box p-1 rounded">

                                                <div class="d-flexjustify-content-between mb-1">
                                                    <span class="fw-bold">{{$student->first_name}} {{$student->last_name}}</span>
                                                    @if($club->leader == $message->sender_id)
                                                        <span class="badge bg-white text-dark mx-1">Leader</span>
                                                    @endif
                                                </div>
                                            @if($message->type == 'announcement')
                                                <div class="text-end mb-1">
                                                    <span class="badge bg-white text-dark mx-1">Admin</span>
                                                    <span class="badge bg-danger text-white mx-1">Notification</span>
                                                </div>
                                            @endif

                                            @if($message->image_url)
                                                <img class="rounded mb-2" src="{{asset('Message_Pics/'.$message->image_url)}}">
                                            @endif
                                            <p>{{$message->message}}</p>
                                            <div class="text-end">
                                                <span>{{$message->created_at->format('H:i')}}</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="the-end" class="the-end">
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="col-12 text-center p-2">
                                <h2>No messages sent in this club yet</h2>
                            </div>
                        @endif
                    </div>
                    <div id="img-preview-div" class="preview-div d-flex d-none justify-content-end p-0">
                        <div class="text-end" style="height: 40vh;margin-right: 1vw;width: 30vw;margin-top: -36vh;margin-bottom: -10vh;">
                            <img id="preview" src="">
                        </div>
                    </div>
                    <div class="vh-10 px-2 pt-2">
                        <form method="POST" action="{{url('student/club/'.$club->id.'/send_message')}}" enctype="multipart/form-data" class="d-flex">
                            @csrf
                            <textarea class="form-control" name="message" placeholder="Write Your Message"></textarea>
                            <input id="image-input" type="file" name="image" class="d-none">
                            <div>
                                <button id="add-image-btn" class="btn p-1" type="button">
                                <i class="fas fa-paperclip fs-2 color-main"></i>
                            </button>
                            </div>
                            <div>
                                <button class="btn rounded-pill btn-main btn-md" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="members-div" class="div py-5 px-2 px-md-5 d-none">
                {{-- <h2 class="color-second">Members</h2> --}}
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="background-color: var(--color-main); color: white;">Name</th>
                                    <th style="background-color: var(--color-main); color: white;">Class</th>
                                    <th style="background-color: var(--color-main); color: white;">Gender</th>
                                    <th style="background-color: var(--color-main); color: white;">Messages Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $student)
                                    <tr>
                                        <td>
                                            <span class="me-1">{{$student->first_name}} {{$student->last_name}}</span>
                                            @if($club->leader == $student->id)
                                                <span class="badge bg-main">Leader</span>
                                            @endif
                                        </td>
                                        <td>{{$student->class}}</td>
                                        <td>{{$student->gender}}</td>
                                        <td>{{10}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="notifications-div" class="div py-5 px-2 px-md-5 d-none">
                <div class="rounded-4 p-2 px-4 vh-70 overflow-auto bg-grey" style="border: 2px solid var(--color-main) ;">
                    @forelse($notifications as $notification)
                        <div class="notification bg-white border-bottom border-second border-4 mb-5">
                            <div class="">
                                <span class="badge fs-6 bg-primary">Admin</span>
                                <span class="badge fs-6 bg-second">Notification</span>
                            </div>
                            <p>{{$notification->message}}</p>
                            <div class="">
                                <span>{{$notification->created_at->format('d M Y')}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <h2>no notifications sent in this club</h2>
                        </div>
                    @endforelse
                </div>
            </div>

            <div id="events-div" class="div pt-3 pb-5 px-2 px-md-5 d-none">
                {{-- <h2 class="color-second">Events</h2> --}}
                <div class="row">

                    @forelse ($events as $event)
                        <div data-aos="fade-right" class="col-sm-6 col-md-3 p-2">
                            <div class="bg-second text-white p-2 text-center rounded-4">
                                <div class="bg-white p-1 rounded-4 rounded-bottom">
                                    <img class="vh-30" src="{{asset('Event_Posters/'.$event->poster)}}">
                                </div>
                                <div>
                                    <a href="{{url('student/event/'.$event->id)}}">
                                        <h4>{{$event->name}}</h4>
                                    </a>
                                    <h5>{{$event->venue}}</h5>
                                    <h6>{{\Carbon\Carbon::parse($event->date_and_time)->format('d/m/Y')}}</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                            <div class="col-12 text-center">
                                <h2>This club doesnt have any events yet</h2>
                            </div>
                    @endforelse
                </div>
            </div>

            <div id="elections-div" class="div pt-3 pb-5 px-2 px-md-5 d-none">
                <div class="row">

                    @forelse ($elections as $election)
                        <div data-aos="fade-right" class="col-sm-6 col-md-3 p-2">
                            <div class="bg-second text-white p-2 text-center rounded-4">
                                <div class="bg-white p-1 rounded-4 rounded-bottom">
                                    @php
                                        $club = $clubs->where('id',$election->club_id)->first();
                                    @endphp
                                    <a href="{{asset('Club_Logos/'.$club->logo)}}">
                                        <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" class="vh-30">
                                    </a>
                                </div>
                                <div>
                                    <a href="{{url('student/election/'.$election->id)}}">
                                        <h4>{{$election->name}}</h4>
                                    </a>
                                    <h5>{{$election->venue}}</h5>
                                    <h6>{{$election->created_at->format('d/m/Y')}}</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                            <div class="col-12 text-center">
                                <h2>This club doesnt have any events yet</h2>
                            </div>
                    @endforelse
                </div>
            </div>

            <div id="help-div" class="div pt-3 pb-5 px-2 px-md-5 d-none">
                <div class="rounded-4 p-2 vh-70 over" style="border: 2px solid var(--color-main) ;">

                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <h1>Join This Club to view its content</h1>
        </div>
        @if($history->count() > 0)
            <div class="text-center">
                <h4>You have been a member of this club before</h4>
                <div class="d-flex justify-content-center">
                    <div class="">
                        <table>
                            <thead>
                                <th class="fs-5 px-2">Join Date</th>
                                <th class="fs-5 px-2">Exit Date</th>
                            </thead>
                            <tbody>
                                @foreach($history as $history)
                                    <tr>
                                        <td class="fs-6 px-2">
                                            <span>{{\Carbon\Carbon::parse($history->join_date)->format('d M Y')}}</span>
                                        </td>
                                        <td class="fs-6 px-2">
                                            <span>{{\Carbon\Carbon::parse($history->exit_date)->format('d M Y')}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center">
                <h4>You have never been a member of this club</h4>
            </div>
        @endif
    @endif

    @include('components.student.footer')
    <script src="{{asset('assets/js/club.js')}}"></script>
</body>

</html>
