@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add New Service')

@push('styles')
<style>
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        max-width: 800px;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--gray-dark);
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-blue);
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.services.index') }}" style="color: var(--primary-blue); text-decoration: none;">← Back to Services</a>
    <h1 style="color: var(--primary-blue); margin-top: 1rem;">{{ isset($service) ? 'Edit Service' : 'Add New Service' }}</h1>
</div>

@if($errors->any())
<div class="alert-error">
    <ul style="margin: 0; padding-left: 1.5rem;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-card">
    <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST">
        @csrf
        @if(isset($service))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="date">Date *</label>
                <input type="date" id="date" name="date" value="{{ old('date', isset($service) ? $service->date->format('Y-m-d') : '') }}" required>
            </div>
            
            <div class="form-group">
                <label for="language">Language *</label>
                <select id="language" name="language" required>
                    <option value="id" {{ old('language', $service->language ?? '') == 'id' ? 'selected' : '' }}>🇮🇩 Indonesia</option>
                    <option value="en" {{ old('language', $service->language ?? '') == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                    <option value="both" {{ old('language', $service->language ?? '') == 'both' ? 'selected' : '' }}>🌐 Both</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="time_start">Start Time *</label>
                <input type="time" id="time_start" name="time_start" value="{{ old('time_start', isset($service) ? $service->time_start->format('H:i') : '') }}" required>
            </div>
            
            <div class="form-group">
                <label for="time_end">End Time *</label>
                <input type="time" id="time_end" name="time_end" value="{{ old('time_end', isset($service) ? $service->time_end->format('H:i') : '') }}" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="location">Location *</label>
            <input type="text" id="location" name="location" value="{{ old('location', $service->location ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Update Service' : 'Create Service' }}</button>
            <a href="{{ route('admin.services.index') }}" class="btn" style="background: #ddd;">Cancel</a>
        </div>
    </form>
</div>
@endsection