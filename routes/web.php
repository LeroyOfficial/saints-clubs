<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;

use App\Models\Club;
use App\Models\Event;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $clubs = Club::all();
            $events = Event::all();

            return view('home', compact('clubs','events'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/clubs', function () {
    return view('clubs');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/booking', [HomeController::class,'booking']);

Route::prefix('admin')->middleware('auth','IsAdmin')->group(function() {
	Route::get('dashboard', [AdminController::class,'index']);

	Route::get('students', [AdminController::class,'Students']);
	Route::get('student/{id}', [AdminController::class,'Student']);
	Route::get('student/{id}/generate_report', [AdminController::class,'GenerateStudentReport']);

	Route::get('clubs', [AdminController::class,'Clubs']);
	Route::get('club/{id}', [AdminController::class,'Club']);

	Route::get('club/{id}/generate_report', [AdminController::class,'GenerateClubReport']);

	Route::get('club/{id}/events', [AdminController::class,'ClubEvents']);
    Route::get('club/{id}/new_event', [AdminController::class,'NewEvent']);
	Route::post('club/{id}/post_new_event', [AdminController::class,'PostNewEvent']);

    Route::get('club/{id}/elections', [AdminController::class,'Elections']);
    Route::get('club/{id}/new_election', [AdminController::class,'NewElection']);
    Route::post('club/{id}/post_new_election', [AdminController::class,'PostNewElection']);


	Route::get('new_club', [AdminController::class,'NewClub']);
	Route::post('post_new_club', [AdminController::class,'PostNewClub']);

	Route::get('events', [AdminController::class,'Events']);
	Route::get('event/{id}', [AdminController::class,'Event']);
	Route::post('post_new_event', [AdminController::class,'PostNewEvent']);

	Route::get('elections', [AdminController::class,'Elections']);
	Route::get('election/{id}', [AdminController::class,'Election']);
    Route::get('election/{election_id}/confirm_winner/{winner_id}', [AdminController::class,'ConfirmElectionWinner']);

	Route::get('announcements', [AdminController::class,'Announcements']);
	Route::get('announcemnt/{id}', [AdminController::class,'Announcemnt']);
	Route::get('new_announcements', [AdminController::class,'NewAnnouncemnt']);
	Route::get('post_new_announcements', [AdminController::class,'Announcements']);

	Route::get('generate_report', [AdminController::class,'GenerateReport']);

});


Route::prefix('student')->middleware('auth','IsStudent')->group(function() {
	Route::get('dashboard', [StudentController::class,'index']);

    Route::get('clubs', [StudentController::class,'Clubs']);
	Route::get('club/{id}', [StudentController::class,'Club']);
	Route::post('club/{id}/send_message', [StudentController::class,'SendNewMessage']);

    Route::get('join_club/{id}', [StudentController::class,'JoinClub']);
    Route::get('leave_club/{id}', [StudentController::class,'LeaveClub']);

	Route::get('club/{id}/generate_report', [StudentController::class,'GenerateClubReport']);

    Route::get('events', [StudentController::class,'Events']);
	Route::get('event/{id}', [StudentController::class,'Event']);
	Route::get('event/{id}/attend', [StudentController::class,'AttendEvent']);
	Route::get('event/{id}/cancel_presevation', [StudentController::class,'CancelPresevation']);

    Route::get('elections', [StudentController::class,'Elections']);
    Route::get('election/{id}', [StudentController::class,'Election']);

    Route::post('election/{id}/post_vote', [StudentController::class,'Vote']);

    Route::get('help', [StudentController::class,'Help']);
});

Route::get('clubs', [StudentController::class,'Clubs']);
Route::get('events', [StudentController::class,'Events']);


Route::get('/dashboard', function () {
    if(Auth::id())
        {
            if(Auth::user()->user_type == 'admin')
                {
                    return redirect('admin/dashboard');
                }
            if(Auth::user()->user_type == 'student')
                {
                    return redirect('student/dashboard');
                }
        }
    else
        {
            return redirect('login');
        }
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
