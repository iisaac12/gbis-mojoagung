<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
        
        // Filter by language if specified
        if ($request->has('language') && $request->language != 'all') {
            $query->where(function($q) use ($request) {
                $q->where('language', $request->language)
                  ->orWhere('language', 'both');
            });
        }
        
        // Filter by date range (upcoming, past, or all)
        $filter = $request->get('filter', 'upcoming');
        
        if ($filter === 'upcoming') {
            $query->where('date', '>=', Carbon::now()->toDateString());
        } elseif ($filter === 'past') {
            $query->where('date', '<', Carbon::now()->toDateString());
        }
        
        // Order by date
        $services = $query->orderBy('date', $filter === 'past' ? 'desc' : 'asc')
                          ->orderBy('time_start', 'asc')
                          ->paginate(12);
        
        return view('schedules', compact('services'));
    }
}