@extends('layouts.admin')

@section('title', 'Edit Event')

@push('styles')
<style>
    .form-card {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 800px;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.6rem;
        font-weight: 600;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #eee;
        border-radius: 10px;
        font-family: inherit;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
    }

    .alert-error {
        background: #fff5f5;
        border-left: 4px solid #f56565;
        color: #c53030;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .current-image {
        margin-top: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #eee;
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.events.index') }}" style="color: var(--primary-blue); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; font-weight: 500;">
        <span>←</span> Back to Events
    </a>
    <h1 style="color: var(--primary-blue); margin-top: 1rem; font-size: 2rem;">✏️ Edit Event</h1>
</div>

@if($errors->any())
<div class="alert-error">
    <ul style="margin: 0; padding-left: 1.2rem;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-card">
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Event Title *</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
        
        <div class="form-group">
            <label for="date">Event Date *</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" class="form-control" rows="6" required>{{ old('description', $event->description) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Change Event Image</label>
            @if($event->image_url)
            <div class="current-image">
                <p style="margin-bottom: 0.5rem; font-size: 0.85rem; color: #666; font-weight: 500;">Current Image:</p>
                <img src="{{ Storage::url($event->image_url) }}" alt="Current image" style="max-width: 250px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            </div>
            @endif
            <input type="file" id="image" name="image" class="form-control" accept="image/*" style="margin-top: 1rem; padding: 0.6rem;">
            <p style="margin-top: 0.6rem; font-size: 0.85rem; color: #777;">
                Leave empty to keep the current image. Max size: 2MB.
            </p>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">💾 Update Event</button>
            <a href="{{ route('admin.events.index') }}" class="btn" style="background: #f3f4f6; color: #4b5563; padding: 0.8rem 2rem; text-decoration: none; border-radius: 10px; font-weight: 500;">Cancel</a>
        </div>
    </form>
</div>
@endsection
