<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HeroImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class HeroImageController extends Controller
{
    public function index()
    {
        $heroImages = HeroImage::orderBy('page_name')->orderBy('sort_order')->get();
        return view('admin.heroes.index', compact('heroImages'));
    }

    public function create()
    {
        return view('admin.heroes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer'
        ]);

        $path = $request->file('image')->store('heroes', 'public');

        HeroImage::create([
            'page_name' => $request->page_name,
            'image_path' => $path,
            'sort_order' => $request->sort_order ?? 0
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.heroes.index')->with('success', 'Foto Hero berhasil ditambahkan!');
    }

    public function destroy(HeroImage $hero)
    {
        Storage::disk('public')->delete($hero->image_path);
        $hero->delete();

        Cache::forget('home_page_data');

        return redirect()->route('admin.heroes.index')->with('success', 'Foto Hero berhasil dihapus!');
    }
}
