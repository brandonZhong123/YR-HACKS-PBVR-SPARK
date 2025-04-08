<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function index() {
        $assignments = Assessment::where('completed', false)
            ->where('due_date', '>=', now())
            ->with('individualCourse')
            ->get();

        return view('pages.courses.assesments', compact('assignments'));
    }

    public function complete(Request $request, Assessment $assessment) {
        // Mark the assignment as completed
        $assessment->update(['completed' => 1]);
        $user = Auth::user();
        $user->score += 10;
        $user->save();
        
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Assignment marked as completed.');
    }
}
