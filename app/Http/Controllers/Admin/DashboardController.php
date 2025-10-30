<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_services' => Service::count(),
            'upcoming_services' => Service::where('date', '>=', Carbon::now())->count(),
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('date', '>=', Carbon::now())->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::whereNull('user_id')->count(), // Guest messages
            'total_members' => User::members()->count(),
            'total_admins' => User::admins()->count(),
        ];
        
        // Get recent services
        $recentServices = Service::orderBy('date', 'desc')
                                 ->orderBy('time_start', 'desc')
                                 ->limit(5)
                                 ->get();
        
        // Get recent events
        $recentEvents = Event::orderBy('date', 'desc')
                            ->limit(5)
                            ->get();
        
        // Get recent contacts
        $recentContacts = Contact::orderBy('created_at', 'desc')
                                 ->limit(10)
                                 ->get();
        
        return view('admin.dashboard', compact(
            'stats',
            'recentServices',
            'recentEvents',
            'recentContacts'
        ));
    }
}