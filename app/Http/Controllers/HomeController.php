<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use App\Models\ChurchInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('home_page_data', 3600, function () {
            return [
            'churchInfo' => ChurchInfo::first(),
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