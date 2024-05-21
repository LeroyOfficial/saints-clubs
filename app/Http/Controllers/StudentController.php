<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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

use Carbon\Carbon;

class StudentController extends Controller
{
    //
    public function index()
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $clubs = Club::whereJsonContains('members',$student->id)->get();

            $joinDate = StudentsClubHistory::where('student_id',$student->id)->latest()->get();

            $events = Event::all();

            return view('student.home', compact('student','clubs','events','joinDate'));
        }

    public function Clubs()
        {
            $clubs = Club::all();
            $events = Event::all();

            return view('clubs', compact('clubs','events'));
        }

    public function MyClubs()
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $clubs - Club::whereJsonContains('members',$student->id)->get();

            return view('student.my_clubs', compact('clubs'));
        }

    public function Club($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $students = Student::all();

            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('student/clubs');
                }

            $memberIds = $club->members;

            if (empty($memberIds)) {
                $members = Student::where('id',0)->get();
            }
            else
                {
                    $members = Student::whereIn('id', $memberIds)->get();
                }

            if($members->where('id',$student->id)->first())
                {
                    $isMember = true;
                }
            else
                {
                    $isMember = false;
                }

            if($isMember)
                {
                    $history = StudentsClubHistory::where('student_id',$student->id)->where('club_id',$club->id)->latest()->first();
                }
            else
                {
                    $history = StudentsClubHistory::where('student_id',$student->id)->where('club_id',$club->id)->get();
                }

            $notifications = Message::where('type','announcement')->where('club_id',$club->id)->latest()->get();

            $events = Event::where('club_id',$club->id)->get();

            $elections = Election::where('club_id',$club->id)->where('status','in progress')->get();

            $clubs = Club::all();

            $messages = Message::where('club_id',$club->id)->where('type','!=','announcement')->get();

            $grouped_messages = $messages->groupBy(function($message)
            {
                return $message->created_at->format('Y-m-d');
            });

            return view('student.club', compact(
                'club','clubs','student','members','isMember','history',
                'events','elections','messages','grouped_messages',
                'notifications','students'
            ));
        }

    public function JoinClub($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('student/clubs');
                }

            $memberId = $student->id;

            if (!in_array($student->id, $club->members)) {
                $club->members = array_merge($club->members, [$memberId]);
                $club->save();

                $history = new StudentsClubHistory;
                $history->student_id = $student->id;
                $history->club_id = $club->id;
                $history->join_date = Carbon::now();
                $history->save();
            }

            return redirect('student/club/'.$club->id);
        }

    public function LeaveClub($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('student/clubs');
                }

            $memberId = $student->id;

            if (in_array($student->id, $club->members)) {
                $club->members = array_diff($club->members, [$memberId]);
                $club->save();

                // $history = StudentsClubHistory::where('student_id',$student->id)->where('club_id',$club->id)->latest()->first();
                // $history->exit_date = Carbon::now();
                // $history->save();
            }

            return redirect('student/club/'.$club->id);
        }

    public function ViewClubLeader($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $club = Club::find($id);
            if(!$club)
                {
                    return redirect('student/clubs');
                }

            $leader = Student::where('id',$club->leader)->first();

            return view('student.club_leader', comapct('club','leader'));
        }

    public function Events()
        {
            $events = Event::latest()->get();

            $clubs = Club::latest()->get();

            return view('events', compact('events','clubs'));
        }

    public function Event($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();
            
            $event = Event::find($id);
            if(!$event)
                {
                    return redirect('student/events');
                }

            $memberIds = $event->attendance_list;

            if (empty($memberIds)) {
                $attendance_list = Student::where('id',0)->get();
            }
            else
                {
                    $attendance_list = Student::whereIn('id', $memberIds)->get();
                }

            $willAttend = false;

            if($attendance_list->where('id',$student->id)->first())
                {
                    $willAttend = true;
                }

            return view('student.event', compact('event','attendance_list','willAttend'));
        }

    public function AttendEvent($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $event = Event::find($id);
            if(!$event)
                {
                    return redirect('student/events');
                }

            if (!in_array($student->id, $event->attendance_list)) {
                $event->attendance_list = array_merge($event->attendance_list, [$student->id]);
                $event->save();
            }

            return redirect('student/event/'.$event->id);
        }

    public function CancelPresevation($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $event = Event::find($id);
            if(!$event)
                {
                    return redirect('student/events');
                }

            if (in_array($student->id, $event->attendance_list)) {
                $event->attendance_list = array_diff($event->attendance_list, [$student->id]);
                $event->save();
            }

            return redirect('student/event/'.$event->id);
        }

    public function Election($id)
        {
            $election = Election::find($id);

            if(!$election)
                {
                    return redirect('student/elections');
                }

            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

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

            return view('student.election', compact('club','election','candidates','student','students','votes'));
        }

    public function Vote(Request $request,$id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $vote = new Vote;

            $vote->election_id = $id;
            $vote->student_id = $student->id;

            $vote->chosen_candidate = $request->selected_candidate;

            $reason = $request->reason;

            if($reason)
                {
                    $vote->reason = $reason;
                }

            $vote->save();

            return redirect()->back();
        }

    public function SeeAnnouncements()
        {
            $announcements = Message::where('type','announcement')->get();

            return view('student.announcements', compact('announcemnts'));
        }

    public function SendNewMessage(Request $request, $id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $message = new Message;
            $message->sender_id = $student->id;

            $message->type = 'club message';

            $message->club_id = $id;

            $message->message = $request->message;

            $image = $request->image;

            if($image)
                {
                    $imagename = 'IMG-'.time().'.'.$image->getClientoriginalExtension();
                    $image->move('Message_Pics',$imagename);

                    $message->image_url = $imagename;
                }

            $message->save();

            return redirect()->back();
        }

    public function ViewPrivateChats()
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $students = Student::all();

            $chats = Chat::where('participants',$student->id)->get();

            $messages = Message::all();

            return view('student.private_chats', compact('students','chats','messages'));
        }

    public function PrivateChat($id)
        {
            $user = Auth::user();
            $student = Student::where('email',$user->email)->first();

            $chat = Chat::find($id);

            $messages = Message::where('chat_id',$id)->get();

            return view('student.private_chat', compact('chat','messages'));
        }

    public function Help()
        {
            return view('student.help');
        }
}
