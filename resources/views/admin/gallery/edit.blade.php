@extends('layouts.admin')

@section('title', 'Edit Photo - Admin')

@push('styles')
<style>
    /* Reuse styles from create.blade.php */
    .page-header { margin-bottom: 2.5rem; }
    .page-header h1 { color: var(--primary-blue); font-size: 2rem; }
    .form-card { background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: #333; }
    .form-control { width: 100%; padding: 0.8rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s; }
    .form-control:focus { border-color: var(--primary-blue); outline: none; }
    .error-message { color: var(--primary-red); font-size: 0.85rem; margin-top: 0.3rem; }
    .form-actions { display: flex; gap: 1rem; margin-top: 2rem; }
    .btn-back { background: #f5f5f5; color: #666; }
    .current-image { width: 100%; max-height: 400px; object-fit: contain; background: #f9f9f9; border-radius: 8px; margin-top: 1rem; border: 1px solid #eee; }
    #image-preview { width: 100%; max-height: 400px; object-fit: contain; background: #e3f2fd; border-radius: 8px; margin-top: 1rem; display: none; border: 2px dashed var(--primary-blue); }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-pen-to-square"></i> Edit Photo Details</h1>
</div>

<div class="form-card">
    <form action="{{ route('admin.gallery.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Current Image</label>
            <img src="{{ asset('storage/' . $photo->image_url) }}" alt="{{ $photo->title }}" class="current-image">
        </div>

        <div class="form-group" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
            <label for="image">Change Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <img id="image-preview" src="#" alt="Preview">
            <small style="color: #888; display: block; margin-top: 0.5rem;">Leave empty to keep the current image.</small>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $photo->title) }}">
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $photo->category) }}">
            @error('category')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $photo->description) }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-save"></i> Save Changes
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
