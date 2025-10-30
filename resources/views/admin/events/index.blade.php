{{-- admin/events/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Events - Admin')

@push('styles')
<style>
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .event-card-admin {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .event-image-admin {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
    }
    
    .event-content-admin {
        padding: 1.5rem;
    }
    
    .event-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>🎉 Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">+ Add New Event</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="events-grid">
    @forelse($events as $event)
    <div class="event-card-admin">
        @if($event->image_url)
        <img src="{{ Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="event-image-admin">
        @else
        <div class="event-image-admin"></div>
        @endif
        
        <div class="event-content-admin">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">{{ $event->title }}</h3>
            <p style="color: var(--primary-red); font-weight: 600; margin-bottom: 0.5rem;">
                📅 {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
            </p>
            <p style="color: #666; font-size: 0.9rem;">{{ Str::limit($event->description, 80) }}</p>
            
            <div class="event-actions">
                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm" style="background: #4caf50; color: white;">View</a>
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm" style="background: #2196f3; color: white;">Edit</a>
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <p style="grid-column: 1/-1; text-align: center; color: #999; padding: 4rem;">No events found</p>
    @endforelse
</div>

<div style="margin-top: 3rem;">
    {{ $events->links() }}
</div>
@endsection

{{-- admin/events/create.blade.php & edit.blade.php (same as services form) --}}
{{-- Use similar structure as services form with image upload field --}}
@extends('layouts.admin')

@section('title', isset($event) ? 'Edit Event' : 'Add New Event')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.events.index') }}" style="color: var(--primary-blue); text-decoration: none;">← Back to Events</a>
    <h1 style="color: var(--primary-blue); margin-top: 1rem;">{{ isset($event) ? 'Edit Event' : 'Add New Event' }}</h1>
</div>

@if($errors->any())
<div class="alert-error">
    <ul style="margin: 0; padding-left: 1.5rem;">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div class="form-card" style="max-width: 800px; background: white; padding: 2rem; border-radius: 15px;">
    <form action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($event)) @method('PUT') @endif
        
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px;">
        </div>
        
        <div class="form-group">
            <label for="date">Date *</label>
            <input type="date" id="date" name="date" value="{{ old('date', isset($event) ? $event->date->format('Y-m-d') : '') }}" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px;">
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" rows="5" required style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Poppins', sans-serif;">{{ old('description', $event->description ?? '') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Event Image</label>
            @if(isset($event) && $event->image_url)
            <img src="{{ Storage::url($event->image_url) }}" alt="Current" style="max-width: 200px; border-radius: 8px; margin-bottom: 1rem; display: block;">
            @endif
            <input type="file" id="image" name="image" accept="image/*" style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px;">
            <small style="color: #666;">Max 2MB (JPEG, PNG, JPG, GIF)</small>
        </div>
        
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">{{ isset($event) ? 'Update Event' : 'Create Event' }}</button>
            <a href="{{ route('admin.events.index') }}" class="btn" style="background: #ddd; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none;">Cancel</a>
        </div>
    </form>
</div>
@endsection