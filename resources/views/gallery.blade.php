@extends('layouts.app')

@section('title', 'Galeri - GBIS Mojoagung')

@push('styles')
<style>
    .gallery-hero {
        color: white;
        padding: 6rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 50vh;
        background: #6A1B9A; /* Elegant purple for gallery */
    }

    .gallery-hero-content {
        position: relative;
        z-index: 10;
    }

    .gallery-hero h1, .gallery-hero p {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .gallery-hero h1 { animation-delay: 0.2s; font-size: 3.5rem; font-weight: 800; text-shadow: 0 4px 10px rgba(0,0,0,0.3); }
    .gallery-hero p { animation-delay: 0.5s; font-size: 1.2rem; }

    .gallery-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .gallery-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .gallery-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: transform 0.8s ease;
    }

    .gallery-card:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 2rem 1.5rem;
        color: white;
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay h3 { font-size: 1.25rem; margin-bottom: 0.5rem; }
    .gallery-overlay p { font-size: 0.9rem; opacity: 0.9; }
    .gallery-overlay .cat-badge {
        display: inline-block;
        background: var(--primary-red);
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        width: fit-content;
    }

    .pagination {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .gallery-hero h1 { font-size: 2.5rem; }
        .gallery-grid { grid-template-columns: 1fr; }
        .gallery-overlay { opacity: 1; background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2)); }
    }
</style>
@endpush

@section('content')
<section class="gallery-hero">
    <div class="hero-slider">
        @if($heroImages->count() > 0)
            @foreach($heroImages as $index => $image)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                     style="background-image: url('{{ $image->image_url }}');">
                </div>
            @endforeach
        @else
            <div class="hero-slide active" style="background: linear-gradient(135deg, #6A1B9A 0%, #8E24AA 100%);"></div>
        @endif
    </div>
    
    <div class="hero-overlay" style="background: linear-gradient(135deg, rgba(106, 27, 154, 0.8) 0%, rgba(0, 0, 0, 0.4) 100%);"></div>

    <div class="gallery-hero-content scroll-animate" id="gallery-hero-content">
        <h1 class="scintillate-text">Galeri Kegiatan</h1>
        <p class="scintillate-text">Momen kebersamaan dan pelayanan kami di GBIS Mojoagung</p>
    </div>
</section>

<div class="gallery-container">
    @if($photos->count() > 0)
    <div class="gallery-grid">
        @foreach($photos as $index => $photo)
        <div class="gallery-card reveal" style="transition-delay: {{ $index * 0.1 }}s;">
            <img src="{{ asset('storage/' . $photo->image_url) }}" alt="{{ $photo->title }}">
            <div class="gallery-overlay">
                @if($photo->category)
                <span class="cat-badge">{{ $photo->category }}</span>
                @endif
                <h3>{{ $photo->title ?? 'Dokumentasi Gereja' }}</h3>
                @if($photo->description)
                <p>{{ Str::limit($photo->description, 100) }}</p>
                @endif
                <p style="font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.7;">
                    <i class="fa-solid fa-calendar-day"></i> {{ $photo->created_at->isoFormat('D MMMM Y') }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $photos->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 4rem 2rem; color: #999;">
        <i class="fa-solid fa-camera-retro" style="font-size: 4rem; color: #eee; margin-bottom: 1.5rem;"></i>
        <h3>Belum ada foto di galeri</h3>
        <p>Silakan periksa kembali nanti.</p>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('scroll', function() {
        const heroContent = document.getElementById('gallery-hero-content');
        if (!heroContent) return;
        
        const scrollPosition = window.scrollY;
        const opacity = 1 - (scrollPosition / 300);
        const transform = scrollPosition * 0.3;
        
        if (opacity >= 0) {
            heroContent.style.opacity = opacity;
            heroContent.style.transform = `translateY(${transform}px)`;
        } else {
            heroContent.style.opacity = 0;
        }
    });
</script>
@endpush
