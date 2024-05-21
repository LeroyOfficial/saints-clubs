<!DOCTYPE html>
<html>
<head>
    <title>Saints Clubs - Student Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            text-align: left;
        }
    </style>
</head>

<body>
    <div style="text-align: center">
        <h2 style="font-weight: bold;">
            Saints Club Management System
        </h2>

        <h3>{{$student->first_name}} {{$student->last_name}} Student Report</h3>

        <h3>Gender {{$student->gender}}  |   Class {{$student->class}}</h3>
    </div>

    <div class="" style="margin-bottom: 20px;">
        <h4>Clubs which @if($student->gender == 'male')he @else she @endif is a member of ({{$clubs->count()}})</h4>
        @if ($clubs->count() > 0)
            <table>
                <thead style="font-weight: bold">
                    <tr>
                        <td style="background-color: #03424c; color:white;">Name</td>
                        <td style="background-color: #03424c; color:white;">Details</td>
                        <td style="background-color: #03424c; color:white;">Leader</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clubs as $club)
                        <tr>
                            <td>
                                {{-- <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" class="rounded-circle me-2" style="height: 30px;"> --}}
                                {{$club->name}}
                            </td>
                            <td>{{$club->details}}</td>
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
        @else
            <h4>This Student hasnt joined any clubs yet</h4>
        @endif
    </div>

    <div class="" style="margin-bottom: 20px;">
        <h4>Club Histoy</h4>
        @if ($clubs->count() > 0)
            <table>
                <thead style="font-weight: bold">
                    <tr>
                        <td style="background-color: #03424c; color:white;">Name</td>
                        <td style="background-color: #03424c; color:white;">Join Date</td>
                        <td style="background-color: #03424c; color:white;">Exit Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>
                                @php
                                    $club = $clubs->where('id',$history->club_id)->first();
                                @endphp
                                {{-- <img src="{{asset('Club_Logos/'.$club->logo)}}" alt="" class="rounded-circle me-2" style="height: 30px;"> --}}
                                {{$club->name}}
                            </td>
                            <td>{{\Carbon\Carbon::parse($history->join_date)->format('d M Y')}}</td>
                            <td>
                                @if ($history->exit_date)
                                    {{\Carbon\Carbon::parse($history->exit_date)->format('d M Y')}}
                                @else
                                    still a member
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4>no club history</h4>
        @endif
    </div>

    <div class="">
        <h4>Events Attended ({{$events_attended->count()}})</h4>
        @if ($events_attended->count() > 0)
            <table>
                <thead style="font-weight: bold">
                    <tr>
                        <td style="background-color: #03424c; color:white;">Name</td>
                        <td style="background-color: #03424c; color:white;">Venue</td>
                        <td style="background-color: #03424c; color:white;">Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events_attended as $event)
                        <tr>
                            <td class="col-3">{{$event->name}}</td>
                            <td class="col-auto">{{$event->venue}}</td>
                            <td class="col-auto">{{$event->date_and_time->format('d M Y')}} at {{$event->created_at->format('H:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4>This student hasn't attended any events yet</h4>
        @endif
    </div>
</body>
</html>
