<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'image_url',
        'uploaded_at'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    /**
     * Get the full URL of the image
     */
    public function getImageUrlFullAttribute()
    {
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }
        
        if (Storage::disk('public')->exists($this->image_url)) {
            return Storage::disk('public')->url($this->image_url);
        }
        
        return asset($this->image_url);
    }

    /**
     * Get the thumbnail URL (you can implement thumbnail generation)
     */
    public function getThumbnailUrlAttribute()
    {
        // For now, return the same image
        // You can implement thumbnail generation logic here
        return $this->image_url_full;
    }

    /**
     * Scope to get recent gallery items
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('uploaded_at', 'desc')->limit($limit);
    }

    /**
     * Delete image file when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($gallery) {
            if ($gallery->image_url && !filter_var($gallery->image_url, FILTER_VALIDATE_URL)) {
                if (Storage::disk('public')->exists($gallery->image_url)) {
                    Storage::disk('public')->delete($gallery->image_url);
                }
            }
        });
    }
}