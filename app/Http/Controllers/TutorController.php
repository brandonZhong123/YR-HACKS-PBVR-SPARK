<?php

namespace App\Http\Controllers;

use App\Models\PendingTutorApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\TutorSession;
use App\Helpers\Helpers;

class TutorController extends Controller
{

    public function index(Request $request)
    {

        $filters = $request->only(['search', 'subject']);
    
        $tutors = Tutor::with('user')
            ->where('status', 'enabled')
            ->filter($filters)->paginate(9);

        return view('pages/tutors/tutors', compact('tutors'));
    }

     
    public function show(Tutor $tutor)
    {

        if ($tutor->status == 'enabled') {
            return view('pages/tutors/tutor-profile', [
    
                'tutor' => $tutor->load('user'),

         
                'sessions' => TutorSession::where('tutor_id', $tutor->id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get()
            ]);
        }
 
        return redirect()->route('tutors.index')->with('error', 'You cannot access this tutors page');
        
    }

  
    public function edit(Tutor $tutor)
    {
       
        if (Auth::user()->role !== 'admin' && Auth::user()->tutor->id != $tutor->id) {
            return redirect()->route('tutors.index')->with('error', 'You cannot edit a tutor that is not yours!');
        }
        return view('pages/tutors/update-profile', compact('tutor'));
    }

  
    public function update(Request $request, Tutor $tutor) {

 
        if (Auth::user()->role !== 'admin' && Auth::user()->tutor->id != $tutor->id) {
            return redirect()->route('users.index')->with('error', 'You cannot update a tutor that is not yours!');
        } 


        $tutorFields = $request->validate([
            'subjects' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'phone_number' => 'required|string|max:15',
            'status' => 'required|string|max:255',
        ]);
            
        $tutor->update($tutorFields);
        
        return redirect()->route('dashboard')->with('success', 'Tutor profile updated successfully.');

    }
  
    public function showBookSessionForm(Tutor $tutor)
    {   
        if (Auth::user()->role == 'tutor' && Auth::user()->tutor->id == $tutor->id) {
            return redirect()->route('tutors.index')->with('error', 'You cannot book a session with yourself!');
        }

        if ($tutor->status == 'enabled') {
            $sessions = TutorSession::where('tutor_id', $tutor->id)->get();
            return view('pages/tutors/book-session', compact('tutor'), compact('sessions'));
        }
        return redirect()->route('tutors.index')->with('error', 'You cannot book a session with this tutor');
    }


    public function showApplicationForm()
    {
 
        if (Helpers::studentAdminCheck()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
        }
        return view('pages/tutors/tutor-application');
    }


    public function submitApplication(Request $request)
    {   
    
        $request->validate([
            'subjects' => 'required|array',
            'availability' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'experience' => 'nullable',
            'phone_number' => 'required|string|max:20'

        ]);

        PendingTutorApplication::create([
            'user_id' => Auth::id(),
            'subjects' => json_encode($request->subjects),
            'availability' => $request->availability,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'experience' => $request->experience,
            'status' => 'Pending',
        ]);


        return redirect()->route('dashboard')->with('success', 'Your application has been submitted.');
    }

    public function showPendingApplications()
    {   
        
        if (Helpers::studentAdminCheck()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
        }
   
        $applications = PendingTutorApplication::query()->where('user_id', Auth::id())->get();
      
        if (Auth::user()->role == 'admin') {
         
            $applications = PendingTutorApplication::all();
        }
        
        return view('pages/tutors/pending-tutor-applications', compact('applications'));
    }

    public function showApplicationDetails(PendingTutorApplication $application)
    {
        if (Auth::user()->role != 'admin' && Auth::id() != $application->user_id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
        }
        return view('pages/tutors/tutor-application-details', compact('application'));
    }
    

    public function approveApplication(PendingTutorApplication $application)
    {   
        $application->update(['status' => 'Approved']);
  
        $user = User::findOrFail($application->user_id);

        $user->update(['role' => 'tutor']);
    
        Tutor::create([
            'user_id' => $application->user_id,
            'subjects' => $application->subjects,
            'availability' => $application->availability,
            'description' => $application->description,
            'phone_number' => $application->phone_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Application approved successfully.');
    }


    public function rejectApplication(PendingTutorApplication $application)
    {
        $application->update(['status' => 'Rejected']);
        return redirect()->route('dashboard')->with('success', 'Application rejected successfully.');
    }


    public function deactivateTutorProfile() {

        if (Auth::user()->role != 'admin' && Auth::user()->role!= 'tutor') {
            return redirect('tutors.index')->with('error', 'You do not have authorization to disable a tutor profile');
        }
        $tutor = Tutor::where('user_id', Auth::user()->tutor->user_id)->first();
        $tutor->update(['status' => 'disabled']);
        return back()->with('success', 'Your tutor profile has been deactivated.');
    }

 
    public function activateTutorProfile() {
        if (Auth::user()->role != 'admin' && Auth::user()->role!= 'tutor') {
            return redirect('tutors.index')->with('error', 'You do not have authorization to enable a tutor profile');
        }
        $tutor = Tutor::where('user_id', Auth::user()->tutor->user_id)->first();
        $tutor->update(['status' => 'enabled']);
        return back()->with('success', 'Your tutor profile has been reactivated.');
    }
}