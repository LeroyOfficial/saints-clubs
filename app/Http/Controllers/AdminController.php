<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Student;

use App\Models\Club;

use App\Models\Event;
use App\Models\EventAttendance;

use App\Models\Election;
use App\Models\Vote;

use App\Models\Chat;
use App\Models\Message;

use App\Models\StudentsClubHistory;


// INSERT INTO `users`(`id`, `name`, `user_type`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES (null,'SpenceOfficial','admin','spence_kabambe@gmail.com',null,'$2y$10$CfCUNyva//xDUPrAgkD1I.8aICgTgFOmbs9/caVX7aCd3SyYPkB9.',null,null,null,null,null,null,null,null)

use PDF;
use Dompdf\Dompdf;

use Carbon\Carbon;

class AdminController extends Controller
{
    //
    public function index()
        {
            $students = Student::all();
            $clubs = Club::all();
            $events = Event::all();
            $announcements = Message::where('type','announcemnts')->get();

            return view('admin.home', compact(
                'students', 'clubs', 'events', 'announcements'
            ));
        }

    public function Students()
        {
            $students = Student::all();

            return view('admin.students', compact('students'));
        }

    public function Student($id)
        {
            $student = Student::find($id);
            if(!$student)
                {
                    return redirect('admin/students');
                }

            $students = Student::all();

            $clubs = Club::all();
            $studentClubs = Club::whereJsonContains('members',$student->id)->get();

            $events_attended = Event::whereJsonContains('attendance_list',$student->id)->get();
            $histories = StudentsClubHistory::where('student_id',$student->id)->get();

            return view('admin.student_details', compact('student','students','clubs','studentClubs','histories','events_attended'));
        }

    public function GenerateStudentReport($id)
        {
            $student = Student::find($id);
            if(!$student)
                {
                    return redirect('admin/students');
                }

            $students = Student::all();

            $clubs = Club::whereJsonContains('members',$student->id)->get();

            $histories = StudentsClubHistory::where('student_id',$student->id)->get();

            $events_attended = Event::whereJsonContains('attendance_list',$student->id)->get();

            $dompdf = new Dompdf();

            $view = view('admin.report_student',
                    compact('student','students','clubs','histories','events_attended')
                );

            $dompdf->loadHtml($view->render());

            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();

            $output = $dompdf->output();

            $date = Carbon::today()->format('d M Y');

            $file_name = 'Saints Club MS - Student report for '. $student->first_name .' '. $student->last_name ." - ".$date.".pdf";

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment;filename='.$file_name,
            ];

            return response()->streamDownload(function () use ($output) {
                echo $output;
            }, $file_name, $headers);
        }

    public function Clubs()
        {
            $clubs = Club::all();
            return view('admin.clubs',compact('clubs'));
        }

    public function Club($id)
        {
            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

            $memberIds = $club->members;

            if (empty($memberIds)) {
                $members = Student::where('id',0)->get();
                }
            else
                {
                    $members = Student::whereIn('id', $memberIds)->get();
                }

            $elections = Election::where('club_id',$club->id)->get();

            $messages = Message::where('club_id',$club->id)->get();

            $events = Event::where('club_id',$club->id)->get();

            return view('admin.club_details', compact('club','members','elections','messages','events'));
        }

    public function GenerateClubReport($id)
        {
            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

            $memberIds = $club->members;

            if (empty($memberIds)) {
                $members = Student::where('id',0)->get();
                }
            else
                {
                    $members = Student::whereIn('id', $memberIds)->get();
                }

            $elections = Election::where('club_id',$club->id)->get();

            $messages = Message::where('club_id',$club->id)->get();

            $events = Event::where('club_id',$club->id)->get();

            $dompdf = new Dompdf();

            $view = view('admin.report_club',
                    compact('club','members','elections','messages','events')
                );

            $dompdf->loadHtml($view->render());

            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();

            $output = $dompdf->output();

            $date = Carbon::today()->format('d M Y');

            $file_name = 'Saints Club MS - Club report for '.$club->name." - ".$date.".pdf";

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment;filename='.$file_name,
            ];

            return response()->streamDownload(function () use ($output) {
                echo $output;
            }, $file_name, $headers);
        }

    public function NewClub()
        {
            return view('admin.new_club');
        }

    public function PostNewClub(Request $request)
        {
            $club_name = $request->name;
            $logo = $request->logo;

            $imagename = $club_name.' - Logo'.time().'.'.$logo->getClientoriginalExtension();
            $logo->move('Club_Logos',$imagename);

            $club = new Club;
            $club->name = $club_name;
            $club->logo = $imagename;
            $club->details = $request->details;
            $club->members = [];

            $club->save();

            $announcement = new Message;

            $message = $announcement;

            $message->type = 'announcement';
            $message->sender_id = Auth::user()->id;
            $message->message = 'A new Club has been created! go to the clubs tab for more info';
            $message->save();

            return redirect('admin/club/'.$club->id);
        }

    public function Events()
        {
            $events = Event::all();

            return view('admin.events', compact('events'));
        }

    public function ClubEvents($id)
        {
            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

                $events = Event::where('club_id',$club->id)->get();

                return view('admin.club_events', compact('events'));
        }

    public function Event($id)
        {
            $event = Event::find($id);
            if(!$event)
                {
                    return redirect('admin/events');
                }

            $students = Student::all();
            $memberIds = $event->attendance_list;

            if (empty($memberIds)) {
                $attendance_list = Student::where('id',0)->get();
            }
            else
                {
                    $attendance_list = Student::whereIn('id', $memberIds)->get();
                }

            return view('admin.event_details', compact('event','attendance_list','students'));
        }

    public function NewEvent($id)
        {
            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

            return view('admin.new_event', compact('club'));
        }

    public function PostNewEvent(Request $request, $id)
        {
            $club_id = $id;

            $event_name = $request->name;
            $poster = $request->poster;

            $imagename = $event_name.' - Poster'.time().'.'.$poster->getClientoriginalExtension();
            $poster->move('Event_Posters',$imagename);

            $event = new Event;
            $event->name = $event_name;
            $event->poster = $imagename;
            $event->details = $request->details;
            $event->venue = $request->venue;
            $event->date_and_time = $request->date_and_time;
            $event->club_id = $club_id;
            $event->attendance_list = [];
            $event->save();

            // $event_attend_list = new EventAttendance;
            // $event_attend_list->event_id = $event->id;
            // $event_attend_list->save();

            $announcement = new Message;

            $message = $announcement;

            $message->type = 'announcement';
            $message->sender_id = Auth::user()->id;
            $message->club_id = $club_id;
            $message->message = 'A new Event has been posted! go to the events tab for more info';
            $message->save();

            return redirect('admin/event/'.$event->id);
        }

    public function Elections()
        {
            $elections = Election::all();
            $clubs = Club::all();

            return view('admin.elections', compact('elections','clubs'));
        }

    public function Election($id)
        {
            $election = Election::find($id);

            if(!$election)
                {
                    return redirect('admin/elections/');
                }

            $club = Club::find($election->club_id);


            $students = Student::all();

            $candidateIds = json_decode($election->candidates);

            if (empty($candidateIds)) {
                $candidates = Student::where('id',0)->get();
                }
            else
                {
                    $candidates = Student::whereIn('id', $candidateIds)->get();
                }

            $votes = Vote::where('election_id',$election->id)->get();

            if($votes->count() > 0)
                {
                    $top_candidate = Vote::where('election_id',$election->id)->select('chosen_candidate')->groupBy('chosen_candidate')->orderByRaw('Count(*) Desc')->first()->value('chosen_candidate');
                }

            $top_candidate = Vote::where('election_id',0);


            return view('admin.election_details', compact('club','election','candidates','students','votes','top_candidate'));
        }

    public function NewElection($id)
        {
            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

                $memberIds = $club->members;

                if (empty($memberIds)) {
                    $students = Student::where('id',0)->get();
                    }
                else
                    {
                        $students = Student::whereIn('id', $memberIds)->get();
                    }

            return view('admin.new_election',compact('club','students'));
        }

    public function PostNewElection(Request $request, $id)
        {
            $club_id = $id;
            $club = Club::find($club_id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

            $election = new Election;
            $election->club_id = $club_id;
            $election->name = $request->name;
            $election->candidates = $request->candidates;
            $election->status = 'in progress';
            $election->end_date = $request->end_date;

            $election->save();

            return redirect('admin/election/'.$election->id);

        }

    public function ConfirmElectionWinner($election_id, $winner_id)
        {
            $election = Election::find($election_id);
            if(!$election)
                {
                    return redirect('admin/elections');
                }

            $club = Club::find($election->club_id);
            if(!$club)
                {
                    return redirect('admin/clubs');
                }

            $winner = $winner_id;
            $election->winner = $winner;
            $election->status = 'completed';
            $election->save();

            $club->leader = $winner;
            $club->save();

            $student = Student::where('id',$winner)->first();

            $announcement = new Message;

            $message = $announcement;

            $message->type = 'announcement';
            $message->sender_id = Auth::user()->id;
            $message->club_id = $club->id;
            $message->message = $election->name.' election results.. and the winner is '.$student->first_name.' '.$student->last_name;
            $message->save();

            return redirect('admin/club/'.$club->id);
        }

    public function Announcements()
        {
            $announcements = Message::where('type','announcement')->get();

            return view('admin.announcements', compact('announcements'));
        }

    public function NewAnnouncement()
        {
            return view('admin.new_announcemnt');
        }

    public function PostNewAnnouncement(Request $request)
        {
            $announcement = new Message;

            $message = $announcement;

            $message->type = 'announcement';
            $message->sender_id = Auth::user()->id;
            $message->message = $request->message;

            $image = $request->image;

            if($image)
                {
                    $imagename = 'IMG-'.time().'.'.$image->getClientoriginalExtension();
                    $image->move('Message_Pics',$imagename);

                    $message->image_url = $imagename;
                }

            $message->save();

            return redirect('admin/announcements');
        }

    public function GenerateReport()
        {

        }
}
