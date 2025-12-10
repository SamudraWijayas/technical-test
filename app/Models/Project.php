<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    const STATUS_PLANNING = 1;
    const STATUS_ON_PROGRESS = 2;
    const STATUS_DONE = 3;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Total task
    public function taskCount(): int
    {
        return $this->tasks()->count();
    }

    // Summary task by status
    public function taskSummaryByStatus(): array
    {
        return $this->tasks()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    // Progress project with weighted statuses
public function progress(): float
{
    $total = $this->tasks()->count();
    if ($total === 0) return 0;

    $counts = $this->tasks()
        ->selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status');

    $done = $counts[4] ?? 0;
    $review = $counts[3] ?? 0;
    $doing = $counts[2] ?? 0;

    // Bobot: Done=1, Review=0.75, Doing=0.5
    $progress = (($done * 1 + $review * 0.5 + $doing * 0.35) / $total) * 100;

    return round($progress, 2);
}


    // Check if project is problematic
    public function isProblematic(): bool
    {
        $overdue = $this->tasks()
            ->where('deadline', '<', now())
            ->where('status', '!=', 4)
            ->exists();

        return $overdue && $this->progress() < 50;
    }

    // Status label
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PLANNING => 'Planning',
            self::STATUS_ON_PROGRESS => 'On Progress',
            self::STATUS_DONE => 'Done',
            default => 'Unknown',
        };
    }
}
