@extends('layouts.admin')

@section('title', 'Upload Photo - Admin')

@push('styles')
<style>
    .page-header {
        margin-bottom: 2.5rem;
    }
    
    .page-header h1 {
        color: var(--primary-blue);
        font-size: 2rem;
    }
    
    .form-card {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: 0 auto;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--primary-blue);
        outline: none;
    }
    
    .error-message {
        color: var(--primary-red);
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn-back {
        background: #f5f5f5;
        color: #666;
    }
    
    #image-preview {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        background: #f9f9f9;
        border-radius: 8px;
        margin-top: 1rem;
        display: none;
        border: 1px dashed #ddd;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-cloud-arrow-up"></i> Upload Photo to Gallery</h1>
</div>

<div class="form-card">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="image">Select Image *</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required onchange="previewImage(this)">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <img id="image-preview" src="#" alt="Preview">
        </div>

        <div class="form-group">
            <label for="title">Title (Optional)</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="e.g., Ibadah Raya Minggu">
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category (Optional)</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" placeholder="e.g., Ibadah, Kegiatan, Youth, Sekolah Minggu">
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Brief description of the photo...">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i> Upload Photo
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-back">Cancel</a>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
