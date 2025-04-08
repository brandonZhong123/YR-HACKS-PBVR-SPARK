<?php

namespace App\Http\Controllers;

use App\Models\ArchivedTutorSessionRequest;
use App\Models\ArchivedTutorSession;
use Illuminate\Http\Request;
use App\Models\PendingTutorSession;
use App\Models\TutorSession;
use Illuminate\Support\Facades\Auth;

class TutorSessionsController extends Controller
{
    public function index()
    {

        $sessionsQuery = TutorSession::query();

   
        if (Auth::user()->role == 'tutor') {
            $tutor = Auth::user()->tutor;
            $sessionsQuery->where('tutor_id', $tutor->id)->orWhere('student_id', Auth::id()); 
        } 
        else if (Auth::user()->role == 'student') {
            $sessionsQuery->where('student_id', Auth::id());
        }
        else {
            $sessionsQuery = TutorSession::query();
        }

        $sessions = $sessionsQuery->get(); 

        return view('pages/tutor-sessions/tutor-sessions', compact('sessions'));
    }


    public function cancelSessionPage(TutorSession $session)
    {   

        if (Auth::user()->role != 'admin' && $session->student_id != Auth::id() && $session->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.index')->with('error', 'You cannot cancel a session that is not yours!');
        }
        return view('pages/tutor-sessions/cancel-session', compact('session'));
    }

    
    public function denySessionPage(PendingTutorSession $session)
    {
     
        if (Auth::user()->role !== 'admin' && $session->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.pending-sessions.index')->with('error', 'You cannot deny a session that is not yours!');
        }
        return view('pages/tutor-sessions/deny-session-request', compact('session'));
    }
    
   
    public function viewPendingSessions()
    {

        $pendingSessions = PendingTutorSession::query();

        if (Auth::user()->role == 'tutor') {
            $pendingSessions->where('tutor_id', Auth::user()->tutor->id)->orWhere('student_id', Auth::id());
        } else if (Auth::user()->role == 'student') {
            $pendingSessions->where('student_id', Auth::id());
        }
        

        $pendingSessions = $pendingSessions->get();
            
        return view('pages/tutor-sessions/pending-sessions', compact('pendingSessions'));
    }


    public function viewRandomPendingSessions()
    {

        $pendingSessions = PendingTutorSession::query()
            ->where(function ($query) {
                $query->where('tutor_id', null);
            })
            ->get();
            
        return view('pages/tutor-sessions/pending-random-sessions', compact('pendingSessions'));
    }


    public function bookRandomSessionPage()
    {
        return view('pages/tutor-sessions/book-random-session');
    }


    public function acceptSessionRequest(Request $request, PendingTutorSession $session) {

  
        if (Auth::user()->role !== 'admin' && (!is_null($session->tutor_id) && $session->tutor_id != Auth::user()->tutor->id)) {
            return redirect()->route('sessions.pending-sessions.index')->with('error', 'You cannot accept a session request that is not for you!');
        }

        if (Auth::user()->role == 'tutor' && $session->student_id == Auth::id()) {
            return redirect()->route('sessions.pending-sessions.index')->with('error', 'You cannot accept a session request for yourself');
        }


        $formFields = $request->validate([
            'tutor_id' => 'required',
            'session_id' => 'required',
            'student_id' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'nullable',
            'reason' => 'nullable',
        ]);


        TutorSession::create($formFields);
        

        $session->update([
            'status' => 'Accepted',
            'tutor_id' => $formFields['tutor_id'],
        ]);

        return redirect()->route('sessions.pending-sessions.index')->with('success', 'Session accepted successfully!');
    }
    
   
    public function denySessionRequest(Request $request, PendingTutorSession $session)
    {

  
        if (Auth::user()->role !== 'admin' && $session->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.pending-sessions.index')->with('error', 'You cannot reject a session request that is not for you!');
        }

     
        $formFields = $request->validate([
            'reason' => 'required',
        ]);

   
        $session->update([
            'status' => 'Denied',
            'reason' => $formFields['reason'],
        ]);

        return redirect()->route('sessions.pending-sessions.index')->with('success', 'Session denied successfully!');
    }


    public function cancelSessionRequest(PendingTutorSession $session) {


        if (Auth::user()->role !== 'admin' && $session->student_id != Auth::id()) {
            return redirect()->route('sessions.pending-sessions.index')->with('error', 'You cannot cancel a session that is not yours!');
        }


        $session->destroy($session->id);
        return redirect()->route('sessions.pending-sessions.index')->with('success', 'Session request cancelled successfully!');
    }


    public function bookSession(Request $request) {
               

        $formFields = $request->validate([
            'tutor_id' => 'required|exists:tutors,id',
            'subject' => 'required',
            'location' => 'nullable',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i', 
            'end_time' => 'required|date_format:H:i'
        ]);


        if (Auth::user()->role == 'tutor' && Auth::user()->tutor->id == $formFields['tutor_id']) {
            return redirect()->route('tutors.index')->with('error', 'You cannot book a session with yourself!');
        }


        $formFields['start_time'] = $formFields['start_time'] . ':00';
        $formFields['end_time'] = $formFields['end_time'] . ':00';
        

        $formFields['student_id'] = Auth::id();

  
        PendingTutorSession::create($formFields);

        return redirect()->route('sessions.pending-sessions.index')->with('success', 'Session booked successfully!');
    }


    public function bookRandomSession(Request $request) {
        
 
        $formFields = $request->validate([
            'subject' => 'required',
            'location' => 'nullable',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i', 
            'end_time' => 'required|date_format:H:i'
        ]);

        $formFields['student_id'] = Auth::id();

        $formFields['start_time'] = $formFields['start_time'] . ':00';
        $formFields['end_time'] = $formFields['end_time'] . ':00';

        PendingTutorSession::create($formFields);

        return redirect()->route('sessions.pending-sessions.index')->with('success', 'Session booked successfully!');
    }
    
    
    public function completeSession(TutorSession $session) {

  
        if (Auth::user()->role !== 'admin' && $session->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('tutors.index')->with('error', 'You cannot cancel a session that is not yours!');
        }

  
        $session->update([
            'status' => 'Completed',
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session completed successfully!');
    }

  
    public function cancelSession(Request $request, TutorSession $session) {
        
  
        if (Auth::user()->role != 'admin' && $session->student_id != Auth::id() && $session->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.index')->with('error', 'You cannot cancel a session that is not yours!');
        }
 
        $formFields = $request->validate([
            'reason' => 'required',
        ]);

 
        $session->update([
            'status' => 'Cancelled',
            'reason' => $formFields['reason'],
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session cancelled successfully!');
    }


    public function archiveSessionRequest(Request $request) {

   
        if (Auth::user()->role !== 'admin' && $request->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.index')->with('error', 'You cannot archive a session request that is not for you!');
        }


        $formFields = $request->validate([
            'tutor_id' => 'required',
            'session_id' => 'required',
            'student_id' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'nullable',
            'status' => 'required',
            'reason' => 'nullable',
        ]);

   
        ArchivedTutorSessionRequest::create($formFields);
        PendingTutorSession::destroy($formFields['session_id']);

        return redirect()->route('sessions.index')->with('success', 'Session archived successfully!');

    }

 
    public function archiveSession(Request $request) {

        if (Auth::user()->role !== 'admin' && $request->tutor_id != Auth::user()->tutor->id) {
            return redirect()->route('sessions.index')->with('error', 'You cannot archive a session that is not for you!');
        }


        $formFields = $request->validate([
            'tutor_id' => 'required',
            'session_id' => 'required',
            'student_id' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'nullable',
            'status' => 'required',
            'reason' => 'nullable',
        ]);


        ArchivedTutorSession::create($formFields);
        TutorSession::destroy($formFields['session_id']);

        return redirect()->route('sessions.index')->with('success', 'Session archived successfully!');
    }

    
}