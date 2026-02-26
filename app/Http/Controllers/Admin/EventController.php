<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index()
    {
        $events = Event::orderBy('date', 'desc')
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Redirect to the public event show page
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return redirect()->route('events.show', $event->slug);
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $data['image_url'] = $imagePath;
        }

        Event::create($data);

        Cache::forget('home_page_data');

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show the form for editing an event
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $event = Event::findOrFail($id);
        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image_url && Storage::disk('public')->exists($event->image_url)) {
                Storage::disk('public')->delete($event->image_url);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('events', $imageName, 'public');
            $data['image_url'] = $imagePath;
        }

        $oldSlug = $event->slug;
        $event->update($data);

        Cache::forget('home_page_data');
        Cache::forget("event_show_{$oldSlug}");
        Cache::forget("event_show_{$event->slug}");

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete image
        if ($event->image_url && Storage::disk('public')->exists($event->image_url)) {
            Storage::disk('public')->delete($event->image_url);
        }

        $slug = $event->slug;
        $event->delete();

        Cache::forget('home_page_data');
        Cache::forget("event_show_{$slug}");

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}