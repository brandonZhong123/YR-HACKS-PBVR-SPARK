<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{   
    use HasFactory;

    protected $fillable = [
        'completed',
    ];
    
    public function individualCourse() {
        return $this->belongsTo(IndividualCourse::class, 'individual_course_id');
    }
}
