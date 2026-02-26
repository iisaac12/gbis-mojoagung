<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'upcoming');
        $search = $request->get('search');
        $page = $request->get('page', 1);

        $cacheKey = "events_index_{$filter}_{$search}_{$page}";

        $events = Cache::remember($cacheKey, 3600, function () use ($filter, $search) {
            $query = Event::query();

            if ($filter === 'upcoming') {
                $query->where('date', '>=', Carbon::now()->toDateString());
            }
            elseif ($filter === 'past') {
                $query->where('date', '<', Carbon::now()->toDateString());
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                            $q->where('title', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%");
                        }
                        );
                    }

                    return $query->orderBy('date', $filter === 'past' ? 'desc' : 'asc')
                    ->paginate(9);
                });

        return view('events.index', compact('events'));
    }

    public function show($slug)
    {
        $data = Cache::remember("event_show_{$slug}", 3600, function () use ($slug) {
            $event = Event::where('slug', $slug)->firstOrFail();

            $relatedEvents = Event::where('slug', '!=', $slug)
                ->where('date', '>=', Carbon::now()->toDateString())
                ->orderBy('date', 'asc')
                ->limit(3)
                ->get();

            return compact('event', 'relatedEvents');
        });

        return view('events.show', $data);
    }
}