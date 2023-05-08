<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'time_check_in',
        'time_check_out',
        'difficult',
        'planning'
    ];

    /**
     * Get the tasks of .
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the user for this timesheet.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get timesheets managed by user manager.
     */
    public function scopeManagedBy($query, $managerId)
    {
        $query->whereHas('user', function($q) use ($managerId) {
            $q->where('manager_id', $managerId);
        });
    }
}
