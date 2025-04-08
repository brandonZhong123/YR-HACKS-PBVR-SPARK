<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingTutorApplication extends Model
{
    protected $fillable = [
        'user_id',
        'subjects',
        'availability',
        'description',
        'phone_number',
        'experience',
        'status',
    ];

    /**
     * Get the user that the application belongs to
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The user that the application belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
