<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'text_id',
        'text_en'
    ];

    /**
     * Get translation by key and locale
     * 
     * @param string $key
     * @param string $locale
     * @return string|null
     */
    public static function getTranslation($key, $locale = 'id')
    {
        // Cache translations for 24 hours
        $cacheKey = "translation_{$key}_{$locale}";
        
        return Cache::remember($cacheKey, 86400, function () use ($key, $locale) {
            $translation = self::where('key', $key)->first();
            
            if (!$translation) {
                return null;
            }
            
            return $locale === 'en' ? $translation->text_en : $translation->text_id;
        });
    }

    /**
     * Get all translations for a specific locale
     * 
     * @param string $locale
     * @return array
     */
    public static function getAllTranslations($locale = 'id')
    {
        $cacheKey = "all_translations_{$locale}";
        
        return Cache::remember($cacheKey, 86400, function () use ($locale) {
            $translations = self::all();
            $result = [];
            
            foreach ($translations as $translation) {
                $result[$translation->key] = $locale === 'en' 
                    ? $translation->text_en 
                    : $translation->text_id;
            }
            
            return $result;
        });
    }

    /**
     * Clear translation cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }

    /**
     * Scope to search by key
     */
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    /**
     * Scope to search translations
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('key', 'like', "%{$search}%")
              ->orWhere('text_id', 'like', "%{$search}%")
              ->orWhere('text_en', 'like', "%{$search}%");
        });
    }

    /**
     * Clear cache when model is saved or deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }
}