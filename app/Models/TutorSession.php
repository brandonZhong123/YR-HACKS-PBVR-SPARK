<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorSession extends Model
{
    protected $fillable = [
        'tutor_id',
        'student_id',
        'subject',
        'date',
        'start_time',
        'end_time',
        'location',
        'status',
        'reason',
    ];

    /**
     * Get the tutor that the session belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The tutor that the session belongs to
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    /**
     * Get the student that the session belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The student that the session belongs to
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
