@extends('layouts.app')

@section('title', 'Acara - GBIS Mojoagung')

@push('styles')
<style>
    .events-hero {
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
        background: #C62828;
    }

    .events-hero-content {
        position: relative;
        z-index: 10;
    }

    .events-hero h1, .events-hero p {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .events-hero h1 {
        animation-delay: 0.2s;
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .events-hero p {
        animation-delay: 0.5s;
        font-size: 1.2rem;
    }

    .scroll-animate {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }
    
    .search-filter {
        background: white;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: -2rem auto 2rem;
        max-width: 1200px;
        border-radius: 10px;
        position: relative;
        z-index: 10;
    }
    
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .event-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        text-decoration: none;
        color: inherit;
        display: block;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .event-image {
        width: 100%;
        height: auto;
        display: block;
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        min-height: 180px;
    }
    
    .event-content {
        padding: 1.5rem;
    }
    
    .event-title {
        color: var(--primary-blue);
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    @media (max-width: 768px) {
        .events-hero {
            padding: 4rem 1.5rem;
            min-height: 40vh;
        }

        .events-hero h1 {
            font-size: 2.25rem;
        }

        .events-grid {
            padding: 1.5rem;
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Slider -->
<section class="events-hero">
    <div class="hero-slider">
        @if($heroImages->count() > 0)
            @foreach($heroImages as $index => $image)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                     style="background-image: url('{{ $image->image_url }}');">
                </div>
            @endforeach
        @else
            <div class="hero-slide active" style="background: linear-gradient(135deg, #C62828 0%, #E53935 100%);"></div>
        @endif
    </div>
    
    <div class="hero-overlay" style="background: linear-gradient(135deg, rgba(198, 40, 40, 0.8) 0%, rgba(0, 0, 0, 0.4) 100%);"></div>

    <div class="events-hero-content scroll-animate" id="events-hero-content">
        <h1 class="scintillate-text">Acara & Kegiatan</h1>
        <p class="scintillate-text">Ikuti berbagai kegiatan seru di GBIS Mojoagung</p>
    </div>

    @if($heroImages->count() > 1)
    <div class="hero-nav">
        <button class="hero-nav-btn prev">❮</button>
        <button class="hero-nav-btn next">❯</button>
    </div>
    @endif
</section>

<div class="events-grid">
    @forelse($events as $index => $event)
    <a href="{{ route('events.show', $event->slug) }}" class="event-card reveal" style="transition-delay: {{ $index * 0.1 }}s;">
        @if($event->image_url)
        <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" class="event-image">
        @else
        <div class="event-image"></div>
        @endif
        
        <div class="event-content">
            <h3 class="event-title">{{ $event->title }}</h3>
            <p style="color: var(--primary-red); font-weight: 600; margin-bottom: 0.5rem;">
                📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('D MMMM Y') }}
            </p>
            <p style="color: #666;">{{ Str::limit($event->description, 120) }}</p>
        </div>
    </a>
    @empty
    <p style="grid-column: 1/-1; text-align: center; color: #999; padding: 4rem;">
        Tidak ada acara ditemukan
    </p>
    @endforelse
</div>

<div style="padding: 0 2rem 3rem; max-width: 1200px; margin: 0 auto;">
    {{ $events->links() }}
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('scroll', function() {
        const heroContent = document.getElementById('events-hero-content');
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
