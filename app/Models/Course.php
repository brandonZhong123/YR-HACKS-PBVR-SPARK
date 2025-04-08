<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{   
    use HasFactory;
    protected $fillable = [
        'code',
        'subject',
        'type',
        'grade'
    ];

    /**
     * Course scope filter
     * 
     * Filter courses by search query
     * @param mixed $query The query to filter
     * @param array $filters The filters to apply
     */
    public function scopeFilter($query, array $filters) {

        // If search query is not empty, filter courses by search query
        if (!empty($filters['search'])) {
            // Search query
            $search = '%' . strtolower($filters['search']) . '%';
            // Filter courses by search query
            $query->where('code', 'like', $search)
                  ->orWhere('subject', 'like', $search)
                  ->orWhere('type', 'like', $search)
                  ->orWhere('grade', 'like', $search);
        }
    }

    public function individualCourses() {
        return $this->hasMany(IndividualCourse::class);
    }
}
