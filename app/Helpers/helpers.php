<?php

use App\Models\Language;

if (!function_exists('translate')) {
    /**
     * Translate text based on current locale
     * 
     * @param string $key
     * @param string|null $default
     * @return string
     */
    function translate($key, $default = null)
    {
        $locale = session('locale', config('app.locale', 'id'));
        
        $translation = Language::where('key', $key)->first();
        
        if (!$translation) {
            return $default ?? $key;
        }
        
        return $locale === 'en' ? $translation->text_en : $translation->text_id;
    }
}

if (!function_exists('t')) {
    /**
     * Short alias for translate function
     * 
     * @param string $key
     * @param string|null $default
     * @return string
     */
    function t($key, $default = null)
    {
        return translate($key, $default);
    }
}