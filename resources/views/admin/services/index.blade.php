@extends('layouts.admin')

@section('title', 'Manage Services - Admin')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .page-header h1 {
        color: var(--primary-blue);
        font-size: 2rem;
    }
    
    .content-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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
    
    tbody tr:hover {
        background: var(--gray-light);
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.4rem 1rem;
        font-size: 0.9rem;
    }
    
    .btn-edit {
        background: #4caf50;
        color: white;
    }
    
    .btn-delete {
        background: var(--primary-red);
        color: white;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>📅 Manage Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Add New Service</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Language</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td><strong>{{ $service->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($service->date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($service->time_start)->format('H:i') }}</td>
                    <td>{{ $service->location }}</td>
                    <td>
                        @if($service->language == 'id') 🇮🇩
                        @elseif($service->language == 'en') 🇬🇧
                        @else 🌐 @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-edit">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">No services found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 2rem;">
        {{ $services->links() }}
    </div>
</div>
@endsection