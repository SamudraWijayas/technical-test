<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'description', 'priority', 'deadline', 'status'];

       protected $casts = [
        'deadline' => 'date',
    ];

    const PRIORITY_LOW = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 3;

    const STATUS_TODO = 1;
    const STATUS_DOING = 2;
    const STATUS_REVIEW = 3;
    const STATUS_DONE = 4;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_TODO => 'Todo',
            self::STATUS_DOING => 'Doing',
            self::STATUS_REVIEW => 'Review',
            self::STATUS_DONE => 'Done',
            default => 'Unknown',
        };
    }

    public function getPriorityLabelAttribute()
    {
        return match ($this->priority) {
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
            default => 'Unknown',
        };
    }
}
