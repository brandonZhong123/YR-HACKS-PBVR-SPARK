<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\PendingTutorSession;
use App\Models\TutorSession;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\IndividualCourse;


class PageController extends Controller
{
    

    public function dashboard()
    {   
       
        $dashboardContent = [
            'sessions' => Auth::user()->sessions,
            'sessionRequests' => Auth::user()->pendingTutorSessions,
            'schedule' => Auth::user()->schedule,
            'assessments' => Assessment::all()
        ];
        
        return view('pages/dashboard/dashboard', compact('dashboardContent'));
    }
}
