<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the tutor that the user belongs to
     * @return \Illuminate\Database\Eloquent\Relations\HasOne The tutor that the user belongs to
     */
    public function tutor() {
        return $this->hasOne(Tutor::class);
    }

    /**
     * Get the pending tutor application that the user belongs to
     * @return \Illuminate\Database\Eloquent\Relations\HasOne The pending tutor application that the user belongs to
     */
    public function application() {
        return $this->hasOne(PendingTutorApplication::class);
    }

    /**
     * Get the tutor sessions that the user belongs to
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The tutor sessions that the user belongs to
     */
    public function sessions() {
        return $this->hasMany(TutorSession::class, 'student_id');
    }

    public function schedule() {
        return $this->hasOne(Schedule::class);
    }

    public function teacher() {
        return $this->hasOne(Teacher::class);
    }

    
    /**
     * Get the pending tutor sessions that the user belongs to
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The pending tutor sessions that the user belongs to
     */
    public function pendingTutorSessions() {
        return $this->hasMany(PendingTutorSession::class, 'student_id');
    }

    /**
     * Scope filter for user model
     * @param mixed $query The query to filter
     * @param array $filters The filters to apply
     */
    public function scopeFilter($query, array $filters ) {
        // Check if the filters array is empty
        if (!empty($filters['search'])) {
            // Set the search variable to the search value in the filters array
            $search = '%' . strtolower($filters['search']) . '%';
            // Filter the user by the search query
            $query->where('first_name', 'like', $search)
                  ->orWhere('last_name', 'like', $search);
        }
        // Check if the role key exists in the filters array
        if ($filters['role'] ?? false) {
            // Filter the user by the role in the filters array
            $query->where('role', $filters['role']);
        }

    }
}
