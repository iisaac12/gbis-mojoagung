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
        'description',
        'image_url',
        'category'
    ];

    /**
     * Get the full URL of the image
     */
    public function getImageUrlFullAttribute()
    {
        // If it's already a full URL, return as is
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }

        // If file exists in storage, return storage URL
        if (Storage::disk('public')->exists($this->image_url)) {
            return asset('storage/' . $this->image_url);
        }

        // Otherwise return as asset
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