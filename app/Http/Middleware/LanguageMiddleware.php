<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale');

        // Kalau $locale bukan string, reset jadi 'id'
        if (!is_string($locale)) {
            Session::forget('locale');
            $locale = 'id';
        }

        // Kalau kosong, juga set default
        if (empty($locale)) {
            $locale = 'id';
        }

        // Validasi bahasa yg didukung
        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        // Terapkan locale
        App::setLocale($locale);

        return $next($request);
    }
}
