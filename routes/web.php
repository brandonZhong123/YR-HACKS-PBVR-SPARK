<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TutorSessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\GuidanceController;
use Illuminate\Support\Facades\Route;


// Declare middleware


    // All routes related to courses
    Route::controller(CourseController::class)->group(function () {

        // Courses index page
        Route::get('/courses', 'index')->name('courses');

        // Courses update
        Route::put('/courses/{course}', 'update')->name('courses.update');

        // Courses add page
        Route::get('/courses/add', 'add')->name('courses.add');

        // Courses store
        Route::post('/courses/add', 'store')->name('courses.store');

        // Courses edit
        Route::get('/courses/{course}/edit', 'edit')->name('courses.edit');

        // Courses show
        Route::get('/individual-courses/{individualCourse}', 'show')->name('courses.show');

    });



    Route::controller(AssessmentController::class)->group(function () {

        // Courses index page
        Route::get('/assessments', 'index')->name('assessments.index');


        Route::patch('/assessments/{assessment}/complete', 'complete')->name('assessments.complete');
    });


    Route::controller(GuidanceController::class)->group(function () {

        // Courses index page
        Route::get('/guidance', 'index')->name('guidance.index');



    });

// All routes related to users
Route::controller(UserController::class)->group(function () {

    // User login page
    Route::get('/', 'login')->name('login')->middleware('guest');

    // User register page
    Route::get('/register', 'register')->name('users.register')->middleware('guest');

    // Users page
        Route::get('/users', 'index')->name('users.index')->middleware('admin');

    // User authentication
    Route::post('/users/authenticate', 'authenticate')->name('users.authenticate')->middleware('guest');

    // Users logout 
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');

    // Users register
    Route::post('/register', 'store')->name('users.store')->middleware('guest');

    // Users update
    Route::put('/users/{user}', 'update')->name('users.update')->middleware('admin');

    // Users edit page
    Route::get('/users/{user}/edit', 'edit')->name('users.edit')->middleware('admin');

    // Users profile page
    Route::get('/users/{user}', 'show')->name('users.show')->middleware('auth');

});

// Declare middleware for routes
Route::middleware(['auth'])->group( function() {

    // Declare all routes related to pages
    Route::controller(PageController::class)->group(function () {

        // Dashboard page
        Route::get('dashboard', 'dashboard')->name('dashboard');

    });
    
    // Declare all routes related to tutor sessions
    Route::controller(TutorSessionsController::class)->group(function () {

        // Sessions index page
        Route::get('sessions', 'index')->name('sessions.index');

        // Book Session
        Route::post('sessions/pending-sessions', 'bookSession')->name('sessions.pending-session.store');

        // Book random session
        Route::post('sessions/pending-sessions/random', 'bookRandomSession')->name('sessions.random-pending-session.store');

        // Book random session page
        Route::get('sessions/book-random-session', 'bookRandomSessionPage')->name('sessions.book-random-session');

        // Cancel session page
        Route::get('sessions/cancel-session/{session}', 'cancelSessionPage')->name('sessions.cancel-session-reason');

        // Cancel session
        Route::put('sessions/cancel-session/{session}', 'cancelSession')->name('sessions.cancel-session');

        // Complete session
        Route::put('sessions/complete-session/{session}', 'completeSession')->name('sessions.complete-session');

        // Deny session
        Route::put('sessions/deny-session/{session}', 'denySessionRequest')->name('sessions.deny-session');; 

        // Deny session page
        Route::get('sessions/deny-session/{session}', 'denySessionPage')->name('sessions.deny-session-reason');

        // Pending sessions page
        Route::get('sessions/pending-sessions', 'viewPendingSessions')->name('sessions.pending-sessions.index');

        // Random pending sessions page
        Route::get('sessions/pending-random-sessions', 'viewRandomPendingSessions')->name('sessions.pending-sessions-random');

        // Accept session
        Route::post('sessions/accept-session-request/{session}', 'acceptSessionRequest')->name('sessions.accept-session-request');

        // Cancel session
        Route::post('sessions/cancel-session-request/{session}', 'cancelSessionRequest')->name('sessions.cancel-session-request');
        
        // Archive session request
        Route::post('sessions/archive-session-request/{session}', 'archiveSessionRequest')->name('sessions.archive-session-request');

        // Archive session
        Route::post('sessions/archive-session/{session}', 'archiveSession')->name('sessions.archive-session');
       
        
    });
    
    // Declare all routes related to tutors
    Route::controller(TutorController::class)->group(function () {

        // Tutors index page
        Route::get('tutors', 'index')->name('tutors.index');
        
        // Submit application page
        Route::get('tutors/submit-application', 'showApplicationForm')->name('tutors.submit-application');

        // Submit application
        Route::post('tutors/submit-application', 'submitApplication')->name('tutors.store-application')->middleware('student');

        // Pending tutor applications page
        Route::get('tutors/pending-applications', 'showPendingApplications')->name('tutors.pending-applications');
        
        // Pending tutor application details
        Route::get('tutors/pending-applications/{application}', 'showApplicationDetails')->name('tutors.application-details');

        // Approve tutor application
        Route::put('tutors/pending-applications/{application}/approve', 'approveApplication')->name('tutors.approve-application')->middleware('admin');

        // Reject tutor application
        Route::put('tutors/pending-applications/{application}/reject', 'rejectApplication')->name('tutors.reject-application')->middleware('admin');

        // Disable tutor profile
        Route::put('tutors/disable-tutor-profile', 'deactivateTutorProfile')->name('tutors.deactivate');

        // Enable tutor profile
        Route::put('tutors/enable-tutor-profile', 'activateTutorProfile')->name('tutors.activate');

        // Edit tutor page
        Route::get('tutors/{tutor}/edit',  'edit')->name('tutors.edit');

        // Edit tutor profile
        Route::put('tutors/{tutor}/edit',  'update')->name('tutors.update');

        // Tutor profile page
        Route::get('tutors/{tutor}',  'show')->name('tutors.show');

        // Book session with tutor page
        Route::get('tutors/{tutor}/book-session', 'showBookSessionForm')->name('tutors.book-session');
        

    });     
});



