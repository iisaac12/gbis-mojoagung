<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'is_active',
        'is_pinned',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_pinned' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Scope for active announcements.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where(function ($q) {
                         $q->whereNull('expires_at')
                           ->orWhere('expires_at', '>', Carbon::now());
                     });
    }

    /**
     * Get prioritized announcements.
     */
    public function scopePrioritized($query)
    {
        return $query->orderBy('is_pinned', 'desc')
                     ->orderBy('created_at', 'desc');
    }
}
