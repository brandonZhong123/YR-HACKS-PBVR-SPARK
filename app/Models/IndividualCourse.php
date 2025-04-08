<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualCourse extends Model
{

    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function assessments() {
        return $this->hasMany(Assessment::class, 'individual_course_id');
    }


    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
