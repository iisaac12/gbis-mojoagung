<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'category' => 'nullable|string|max:50',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $path,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Photo uploaded successfully.');
    }

    public function edit($id)
    {
        $photo = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::disk('public')->exists($photo->image_url)) {
                Storage::disk('public')->delete($photo->image_url);
            }
            $path = $request->file('image')->store('gallery', 'public');
            $photo->image_url = $path;
        }

        $photo->update($request->only(['title', 'description', 'category']));

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Photo updated successfully.');
    }

    public function destroy($id)
    {
        $photo = Gallery::findOrFail($id);

        // Deletion of file is handled by Model boot method static deleting
        $photo->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Photo deleted successfully.');
    }
}
