<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function period1() {
        return $this->belongsTo(IndividualCourse::class, 'period_1_course_id');
    }

    public function period2() {
        return $this->belongsTo(IndividualCourse::class, 'period_2_course_id');
    }

    public function period3() {
        return $this->belongsTo(IndividualCourse::class, 'period_3_course_id');
    }

    public function period4() {
        return $this->belongsTo(IndividualCourse::class, 'period_4_course_id');
    }

    public function period5() {
        return $this->belongsTo(IndividualCourse::class, 'period_5_course_id');
    }
}