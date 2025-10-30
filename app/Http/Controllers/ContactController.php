<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ChurchInfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $churchInfo = ChurchInfo::first();
        return view('contact', compact('churchInfo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $isGuest = !Auth::check();
        $userId = Auth::check() ? Auth::id() : null;

        // Save to database
        Contact::create([
            'user_id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'is_guest' => $isGuest,
        ]);

        // Send email notification if guest
        if ($isGuest) {
            $churchInfo = ChurchInfo::first();
            Mail::raw($request->message, function ($mail) use ($request, $churchInfo) {
                $mail->from($request->email, $request->name)
                     ->to($churchInfo->email)
                     ->subject('Pesan Baru dari Website GBIS Mojoagung');
            });
        }

        return redirect()->back()->with('success', session('locale') == 'en' 
            ? 'Your message has been sent successfully!' 
            : 'Pesan Anda telah terkirim!');
    }
}