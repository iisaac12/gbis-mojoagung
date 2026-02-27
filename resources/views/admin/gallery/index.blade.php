@extends('layouts.admin')

@section('title', 'Manage Gallery - Admin')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        gap: 1rem;
    }
    
    .page-header h1 {
        color: var(--primary-blue);
        font-size: 2rem;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .gallery-item {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.12);
    }
    
    .gallery-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .gallery-info {
        padding: 1rem;
        flex-grow: 1;
    }
    
    .gallery-info h3 {
        color: var(--primary-blue);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    .gallery-info p {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.5rem;
    }
    
    .badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        background: var(--primary-blue);
        color: white;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .gallery-actions {
        padding: 1rem;
        border-top: 1px solid #eee;
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
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

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-images"></i> Manage Gallery</h1>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus-circle"></i> Add New Photo</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($photos->count() > 0)
<div class="gallery-grid">
    @foreach($photos as $photo)
    <div class="gallery-item">
        <img src="{{ asset('storage/' . $photo->image_url) }}" alt="{{ $photo->title }}" class="gallery-image">
        <div class="gallery-info">
            <h3>{{ $photo->title ?? 'Untitled' }}</h3>
            @if($photo->category)
            <span class="badge">{{ $photo->category }}</span>
            @endif
            @if($photo->description)
            <p>{{ Str::limit($photo->description, 60) }}</p>
            @endif
        </div>
        <div class="gallery-actions">
            <a href="{{ route('admin.gallery.edit', $photo->id) }}" class="btn btn-sm" style="background: #4caf50; color: white;">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form id="deletePhotoForm-{{ $photo->id }}" action="{{ route('admin.gallery.destroy', $photo->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="button" onclick="showDeleteModal('deletePhotoForm-{{ $photo->id }}', 'Hapus foto {{ $photo->title ? 'dengan judul ' . $photo->title : '' }} secara permanen?')" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top: 2.5rem;">
    {{ $photos->links() }}
</div>
@else
<div class="content-card" style="text-align: center; padding: 4rem; background: white; border-radius: 15px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
    <i class="fa-solid fa-camera-retro" style="font-size: 4rem; color: #ddd; margin-bottom: 1.5rem; display: block;"></i>
    <h3 style="color: #999;">No photos found in gallery</h3>
    <p style="color: #bbb; margin-bottom: 2rem;">Start uploading photos of church activities!</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">Upload First Photo</a>
</div>
@endif
@endsection
