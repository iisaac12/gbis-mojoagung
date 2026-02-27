@extends('layouts.admin')

@section('title', 'Admin Dashboard - GBIS Mojoagung')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        margin-bottom: 2.5rem;
        box-shadow: 0 10px 20px rgba(0,74,173,0.2);
    }
    
    .dashboard-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: #666;
        font-size: 0.95rem;
    }
    
    .recent-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .recent-section h2 {
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .view-all {
        font-size: 0.9rem;
        color: var(--primary-red);
        text-decoration: none;
        font-weight: 600;
    }
    
    .view-all:hover {
        text-decoration: underline;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    thead {
        background: var(--gray-light);
    }
    
    th, td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    th {
        font-weight: 600;
        color: var(--primary-blue);
    }
    
    tbody tr:hover {
        background: var(--gray-light);
    }
    
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .badge-upcoming {
        background: #e3f2fd;
        color: #1976d2;
    }
    
    .badge-past {
        background: #f5f5f5;
        color: #666;
    }
    
    .badge-guest {
        background: #fff3e0;
        color: #e65100;
    }
    
    .badge-member {
        background: #e8f5e9;
        color: #2e7d32;
    }
    
    @media (max-width: 968px) {
        .dashboard-header {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .dashboard-header h1 {
            font-size: 1.75rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .dashboard-header h1 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-header">
    <h1>Welcome back {{ auth()->user()->username }}!</h1>
    <p>Here's what's happening with your church!</p>
</div>

<!-- Statistics -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-church" style="color: var(--primary-blue);"></i></div>
        <div class="stat-value">{{ $stats['total_services'] }}</div>
        <div class="stat-label">Total Services</div>
        <small style="color: green;">{{ $stats['upcoming_services'] }} upcoming</small>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-calendar-check" style="color: var(--primary-red);"></i></div>
        <div class="stat-value">{{ $stats['total_events'] }}</div>
        <div class="stat-label">Total Events</div>
        <small style="color: green;">{{ $stats['upcoming_events'] }} upcoming</small>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-envelope-open-text" style="color: #f39c12;"></i></div>
        <div class="stat-value">{{ $stats['total_contacts'] }}</div>
        <div class="stat-label">Contact Messages</div>
        <small style="color: orange;">{{ $stats['unread_contacts'] }} from guests</small>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-users" style="color: #27ae60;"></i></div>
        <div class="stat-value">{{ $stats['total_members'] }}</div>
        <div class="stat-label">Members</div>
        <small style="color: #666;">{{ $stats['total_admins'] }} admins</small>
    </div>
</div>

<!-- Recent Services -->
<div class="recent-section">
    <h2>
        <span><i class="fa-solid fa-church" style="color: var(--primary-blue); margin-right: 0.5rem;"></i> Recent Services</span>
        <a href="{{ route('admin.services.index') }}" class="view-all">View All</a>
    </h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentServices as $service)
                <tr>
                    <td><strong>{{ $service->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($service->date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($service->time_start)->format('H:i') }}</td>
                    <td>{{ $service->location }}</td>
                    <td>
                        <span class="badge badge-{{ \Carbon\Carbon::parse($service->date)->isFuture() ? 'upcoming' : 'past' }}">
                            {{ \Carbon\Carbon::parse($service->date)->isFuture() ? 'Upcoming' : 'Past' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">No services found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Events -->
<div class="recent-section">
    <h2>
        <span><i class="fa-solid fa-calendar-check" style="color: var(--primary-red); margin-right: 0.5rem;"></i> Recent Events</span>
        <a href="{{ route('admin.events.index') }}" class="view-all">View All</a>
    </h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentEvents as $event)
                <tr>
                    <td><strong>{{ $event->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                    <td>
                        <span class="badge badge-{{ \Carbon\Carbon::parse($event->date)->isFuture() ? 'upcoming' : 'past' }}">
                            {{ \Carbon\Carbon::parse($event->date)->isFuture() ? 'Upcoming' : 'Past' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('events.show', $event->id) }}" style="color: var(--primary-blue); text-decoration: none;">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">No events found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Contacts -->
<div class="recent-section">
    <h2>
        <span><i class="fa-solid fa-envelope-open-text" style="color: #f39c12; margin-right: 0.5rem;"></i> Recent Contact Messages</span>
        <a href="{{ route('admin.contacts.index') }}" class="view-all">View All</a>
    </h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentContacts as $contact)
                <tr>
                    <td><strong>{{ $contact->name }}</strong></td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <span class="badge badge-{{ $contact->is_guest ? 'guest' : 'member' }}">
                            {{ $contact->is_guest ? 'Guest' : 'Member' }}
                        </span>
                    </td>
                    <td>{{ $contact->created_at->format('d M Y') }}</td>
                    <td>{{ Str::limit($contact->message, 40) }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" style="color: var(--primary-blue); font-weight: 600; text-decoration: none;">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">No contact messages</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection