<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\IndividualCourse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function index() {
        $courses = Course::latest()
            ->filter(request(['search', 'role']))
            ->paginate(6);

        return view('pages/courses/courses', compact('courses'));
    }

    public function edit(Course $course) {
        return view('pages/courses/edit-course', compact('course'));
    }


    public function update(Request $request, Course $course) {

        $formFields = $request->validate([
            'code' => 'required',
            'subject' => 'required',
            'type' => 'required',
            'grade' => 'required',
        ]);

 
        $course->update($formFields);

 
        return redirect()->route('courses.edit', $course->id)
            ->with('success', 'Course updated successfully');
    }

    public function add() {
        return view('pages/courses/add-course');
    }
    
    public function store(Request $request) {
        $formFields = $request->validate([
            'code' => 'required',
            'subject' => 'required',
            'type' => 'required',
            'grade' => 'required',
        ]);

        Course::create($formFields);

        return redirect()->route('courses')
            ->with('success', 'Course added successfully');
    }

    public function show(IndividualCourse $individualCourse) {
        if (Auth::user()->role =='student' || Auth::user()->role == 'tutor') 
            return view('pages/courses/individual-course', compact('individualCourse'));
        else
            return view('pages/courses/teacher-individual-course', compact('individualCourse'));
    }
}
