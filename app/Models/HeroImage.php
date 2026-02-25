<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'image_path',
        'sort_order'
    ];

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Scope query to specific page
     */
    public function scopeForPage($query, $page)
    {
        return $query->where('page_name', $page)->orderBy('sort_order', 'asc');
    }
}
