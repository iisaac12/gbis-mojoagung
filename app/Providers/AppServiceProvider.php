<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\HeroImage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $routeName = Route::currentRouteName();

            // Share churchInfo globally (cached for 1 hour)
            $churchInfo = \Illuminate\Support\Facades\Cache::remember('church_info_global', 3600, function () {
                    return \App\Models\ChurchInfo::first();
                }
                );
                $view->with('churchInfo', $churchInfo);

                // Skip hero images for admin routes to avoid overwriting controller data
                if (!$routeName || str_starts_with($routeName, 'admin.')) {
                    return;
                }

                $pageName = 'home'; // Default
                if (str_contains($routeName, 'about'))
                    $pageName = 'about';
                elseif (str_contains($routeName, 'contact'))
                    $pageName = 'contact';
                elseif (str_contains($routeName, 'schedules'))
                    $pageName = 'schedules';
                elseif (str_contains($routeName, 'events'))
                    $pageName = 'events';
                elseif (str_contains($routeName, 'gallery'))
                    $pageName = 'gallery';

                $heroImages = HeroImage::forPage($pageName)->get();
                $view->with('heroImages', $heroImages);
            });
    }
}
