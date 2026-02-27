<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified message.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message deleted successfully!');
    }

    /**
     * Reply to the contact message.
     */
    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Send Email
        Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->reply_message));

        // Save to Database
        $contact->update([
            'reply_message' => $request->reply_message,
            'replied_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim ke ' . $contact->email);
    }
}
