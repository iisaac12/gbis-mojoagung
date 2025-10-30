<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChurchInfo;
use App\Models\Gallery;

class AboutController extends Controller
{
    public function index()
    {
        $churchInfo = ChurchInfo::first();
        $gallery = Gallery::recent(6)->get();
        
        return view('about', compact('churchInfo', 'gallery'));
    }
}