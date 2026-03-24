<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:info,success,warning,important',
            'is_active' => 'boolean',
            'is_pinned' => 'boolean',
            'expires_at' => 'nullable|date',
        ]);

        Announcement::create($request->all());

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:info,success,warning,important',
            'is_active' => 'boolean',
            'is_pinned' => 'boolean',
            'expires_at' => 'nullable|date',
        ]);

        // Handle checkboxes (since they don't send anything if unchecked)
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['is_pinned'] = $request->has('is_pinned');

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
