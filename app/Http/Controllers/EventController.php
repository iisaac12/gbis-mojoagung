<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();
        
        // Filter by date range
        $filter = $request->get('filter', 'upcoming');
        
        if ($filter === 'upcoming') {
            $query->where('date', '>=', Carbon::now()->toDateString());
        } elseif ($filter === 'past') {
            $query->where('date', '<', Carbon::now()->toDateString());
        }
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Order by date
        $events = $query->orderBy('date', $filter === 'past' ? 'desc' : 'asc')
                        ->paginate(9);
        
        return view('events.index', compact('events'));
    }
    
    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        // Get related events (same month or upcoming)
        $relatedEvents = Event::where('id', '!=', $id)
                              ->where('date', '>=', Carbon::now()->toDateString())
                              ->orderBy('date', 'asc')
                              ->limit(3)
                              ->get();
        
        return view('events.show', compact('event', 'relatedEvents'));
    }
}