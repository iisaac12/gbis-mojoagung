<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::orderBy('created_at', 'desc')->paginate(12);
        return view('gallery', compact('photos'));
    }
}
