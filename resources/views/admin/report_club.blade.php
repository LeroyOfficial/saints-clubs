<!DOCTYPE html>
<html>
<head>
    <title>Saints Clubs - All Clubs Report</title>
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

        <h3>{{$club->name}} Club Report</h3>
    </div>

    <div class="" style="margin-bottom: 20px;">
        <h3>Members</h3>
        @if($members->count() > 0)
            <table>
                <thead style="font-weight: bold">
                    <tr>
                        <td style="background-color: #03424c; color:white;">Name</td>
                        <td style="background-color: #03424c; color:white;">Gender</td>
                        <td style="background-color: #03424c; color:white;">Class</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td class="col-3">{{$member->first_name}} {{$member->last_name}}</td>
                            <td class="col-auto">{{$member->gender}}</td>
                            <td class="col-auto">{{$member->class}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4>This Club doesn't have Members</h4>
        @endif
    </div>

    <div class="">
        <h3>Events</h3>
        @if($events->count() > 0)
            <table>
                <thead style="font-weight: bold">
                    <tr>
                        <td style="background-color: #03424c; color:white;">Name</td>
                        <td style="background-color: #03424c; color:white;">Venue</td>
                        <td style="background-color: #03424c; color:white;">Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="col-3">{{$event->name}}</td>
                            <td class="col-auto">{{$event->venue}}</td>
                            <td class="col-auto">{{$event->created_at->format('d M Y')}} at {{$event->created_at->format('H:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4>This Club hasn't hosted any events yet</h4>
        @endif
    </div>

</body>
</html>
