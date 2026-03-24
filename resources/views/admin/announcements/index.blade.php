@extends('layouts.admin')

@section('title', 'Manage Announcements - GBIS Mojoagung')

@section('content')
<style>
    @media (max-width: 768px) {
        .topbar {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
            padding: 1.5rem !important;
        }
        .topbar-right {
            width: 100%;
        }
        .topbar-right .btn {
            width: 100%;
            justify-content: center;
        }
        .recent-section {
            padding: 1rem !important;
        }
        th, td {
            padding: 0.8rem !important;
            font-size: 0.85rem !important;
        }
        .hide-mobile {
            display: none !important;
        }
    }
</style>

<div class="topbar">
    <div class="topbar-left">
        <h1>Manage Announcements</h1>
    </div>
    <div class="topbar-right">
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add New Announcement
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
    {{ session('success') }}
</div>
@endif

<div class="recent-section" style="padding: 2rem; background: white; border-radius: 15px; box-shadow: 0 3px 20px rgba(0,0,0,0.06);">
    <div class="table-container" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table style="width: 100%; border-spacing: 0; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f0f0;">
                    <th style="padding: 1.2rem; width: 50px;">Pin</th>
                    <th style="padding: 1.2rem;">Title</th>
                    <th style="padding: 1.2rem; width: 120px;">Type</th>
                    <th style="padding: 1.2rem; width: 100px;">Status</th>
                    <th style="padding: 1.2rem; width: 150px;">Date</th>
                    <th style="padding: 1.2rem; text-align: right; width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                <tr style="border-bottom: 1px solid #f5f5f5; vertical-align: middle;">
                    <td style="padding: 1.2rem; text-align: center;">
                        @if($announcement->is_pinned)
                        <i class="fa-solid fa-thumbtack" style="color: var(--primary-red); font-size: 1.1rem;" title="Pinned"></i>
                        @else
                        <span style="color: #eee;">-</span>
                        @endif
                    </td>
                    <td style="padding: 1.2rem;">
                        <div style="font-weight: 600; font-size: 1rem; color: var(--gray-dark);">{{ $announcement->title }}</div>
                        <div style="font-size: 0.85rem; color: #777; margin-top: 0.2rem;">{{ Str::limit($announcement->content, 60) }}</div>
                    </td>
                    <td style="padding: 1.2rem;">
                        <span class="badge" style="display: inline-block; padding: 0.4rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; white-space: nowrap;
                            @if($announcement->type == 'warning') background: #fff3e0; color: #e65100;
                            @elseif($announcement->type == 'success') background: #e8f5e9; color: #2e7d32;
                            @elseif($announcement->type == 'important') background: #ffebee; color: #c62828;
                            @else background: #e3f2fd; color: #1976d2;
                            @endif
                        ">
                            {{ ucfirst($announcement->type) }}
                        </span>
                    </td>
                    <td style="padding: 1.2rem;">
                        <span style="display: flex; align-items: center; gap: 0.4rem; font-weight: 500; font-size: 0.9rem; color: {{ $announcement->is_active ? '#2e7d32' : '#999' }};">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $announcement->is_active ? '#43A047' : '#bdbdbd' }};"></span>
                            {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding: 1.2rem; color: #666; font-size: 0.9rem; white-space: nowrap;">
                        {{ $announcement->created_at->format('d M Y') }}
                    </td>
                    <td style="padding: 1.2rem; text-align: right;">
                        <div style="display: flex; gap: 0.6rem; justify-content: flex-end;">
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-primary" style="padding: 0.5rem; width: 36px; height: 36px; border-radius: 8px;" title="Edit">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.5rem; width: 36px; height: 36px; border-radius: 8px;" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999; padding: 4rem;">
                        <i class="fa-solid fa-bullhorn" style="font-size: 3rem; opacity: 0.1; display: block; margin-bottom: 1rem;"></i>
                        No announcements found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
