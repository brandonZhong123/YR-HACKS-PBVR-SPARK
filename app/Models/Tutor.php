<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subjects',
        'availability',
        'description',
        'status',
        'phone_number',
    ];

    /**
     * Get the user that the tutor belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The user that the tutor belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the pending tutor sessions that the tutor has
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The pending tutor sessions that the tutor has
     */
    public function pendingTutorSession() {
        return $this->hasMany(PendingTutorSession::class);
    }

    /**
     * Get the tutor sessions that the tutor has
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The tutor sessions that the tutor has
     */
    public function tutorSession() {
        return $this->hasMany(TutorSession::class);
    }

    /**
     * Scope filter for tutor model
     * @param mixed $query The query to filter
     * @param array $filters The filters to apply
     */
    public function scopeFilter($query, array $filters) {
        // Check if the filters array is empty
        if (!empty($filters['search'])) {
            // Set the search variable to the search value in the filters array
            $search = '%' . strtolower($filters['search']) . '%';

            // Filter the tutor by the search query
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', $search)
                  ->orWhere('last_name', 'like', $search);
            });
        }
        // Check if the subject key exists in the filters array
        if (!empty($filters['subject'])) {
            // Filter the tutor by the subject in the filters array
            $query->where('subjects', 'like', '%' . $filters['subject'] . '%');
        }

    }
    
}
