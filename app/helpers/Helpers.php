<?php

namespace App\Helpers;

use App\Models\PendingTutorSession;
use Illuminate\Support\Facades\Auth;

class Helpers 
{

    public static function studentAdminCheck() {
        if (Auth::user()->role != 'student' && Auth::user()->role != 'admin') {
            return true;
        }
        return false;
    }

    public static function tutorAdminCheck() {
        if (Auth::user()->role != 'tutor' || Auth::user()->role != 'admin') {
            return true;
        }
        return false;
    }

    public static function adminCheck() {
        if (Auth::user()->role != 'admin' || Auth::user()->role != 'super_admin') {
            return true;
        }
        return false;
    }

    public static function superAdminCheck() {
        if (Auth::user()->role != 'super_admin') {
            return true;
        }
        return false;

    }

    public static function sessionTutorAdminCheck(PendingTutorSession $session) {
        if (Auth::user()->role !== 'admin' && $session->tutor_id != Auth::user()->tutor->id) {
            return true;
        }
        return false;
    }

    
}