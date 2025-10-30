<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use App\Models\ChurchInfo;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $churchInfo = ChurchInfo::first();
        
        // Get upcoming services this week
        $upcomingServices = Service::where('date', '>=', Carbon::now())
            ->where('date', '<=', Carbon::now()->endOfWeek())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get();
        
        // Get upcoming events
        $upcomingEvents = Event::where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get();
        
        return view('home', compact('churchInfo', 'upcomingServices', 'upcomingEvents'));
    }
}