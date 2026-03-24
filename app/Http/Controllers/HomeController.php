<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use App\Models\ChurchInfo;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Clear cache if you want immediate updates, or just wait for 1 hour.
        // For development, we'll fetch it dynamically or with a shorter cache.
        $data = Cache::remember('home_page_data_v2', 3600, function () {
            return [
                'churchInfo' => ChurchInfo::first(),
                'announcements' => Announcement::active()->prioritized()->get(),
                'upcomingServices' => Service::where('date', '>=', Carbon::now())
                    ->where('date', '<=', Carbon::now()->endOfWeek())
                    ->orderBy('date', 'asc')
                    ->limit(3)
                    ->get(),
                'upcomingEvents' => Event::where('date', '>=', Carbon::now())
                    ->orderBy('date', 'asc')
                    ->limit(3)
                    ->get(),
            ];
        });

        return view('home', $data);
    }
}