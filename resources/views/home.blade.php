@extends('layouts.app')

@section('title', 'Home - GBIS Mojoagung')

@push('styles')
<style>
    .hero {
        color: white;
        padding: 6rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh; /* Slightly taller for more impact */
        background: #004AAD; /* Fallback color */
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M50 10L90 90H10z" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.15;
        animation: pulse 10s infinite alternate;
    }

    @keyframes pulse {
        from { transform: scale(1); opacity: 0.1; }
        to { transform: scale(1.1); opacity: 0.2; }
    }
    
    .hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 10; /* Above overlay and slider */
    }

    .hero h1, .hero p, .hero .cta-button {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .hero h1 {
        animation-name: ElegantFade;
        animation-delay: 0.2s;
    }

    .hero p {
        animation-name: ElegantFade;
        animation-delay: 0.6s;
    }

    .hero .cta-button {
        animation-name: ElegantFade;
        animation-delay: 1s;
    }

    @keyframes ElegantFade {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .scroll-animate {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }
    
    .hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    .hero p {
        font-size: 1.5rem;
        margin-bottom: 2.5rem;
        opacity: 0.9;
        font-weight: 300;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-button {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        padding: 1.25rem 3rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 20px rgba(198, 40, 40, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .cta-button:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 30px rgba(198, 40, 40, 0.4);
    }
    
    .section {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        color: var(--primary-blue);
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 3rem;
    }
    
    .vision-mission {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .vm-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .vm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .vm-card h3 {
        color: var(--primary-blue);
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    .schedule-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .schedule-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid var(--primary-blue);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.02);
    }
    
    .schedule-card:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    
    .schedule-card h3 {
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }
    
    .schedule-date {
        color: var(--primary-red);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .schedule-time {
        color: #666;
        font-size: 0.9rem;
    }
    
    .bg-light {
        background: var(--gray-light);
    }
    
    @media (max-width: 768px) {
        .hero {
            padding: 4rem 1.5rem;
            min-height: 40vh;
        }

        .hero h1 {
            font-size: 2.25rem;
        }
        
        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        .section {
            padding: 3rem 1.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .cta-button {
            width: 100%;
            padding: 1.1rem 2rem;
        }
    }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Slider -->
<section class="hero">
    <div class="hero-slider">
        @if($heroImages->count() > 0)
            @foreach($heroImages as $index => $image)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                     style="background-image: url('{{ $image->image_url }}');">
                </div>
            @endforeach
        @else
            <div class="hero-slide active" style="background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);"></div>
        @endif
    </div>
    
    <div class="hero-overlay"></div>

    <div class="hero-content scroll-animate" id="hero-content">
        <h1 class="scintillate-text">Selamat Datang di GBIS Mojoagung</h1>
        <p class="scintillate-text">Gereja yang menyebarkan kasih Kristus</p>
        <a href="{{ route('schedules') }}" class="cta-button">
            Bergabunglah dalam Ibadah
        </a>
    </div>

    @if($heroImages->count() > 1)
    <div class="hero-nav">
        <button class="hero-nav-btn prev">❮</button>
        <button class="hero-nav-btn next">❯</button>
    </div>
    @endif
</section>

<!-- Vision & Mission -->
<section class="section">
    <h2 class="section-title">Visi &amp; Misi Kami</h2>
    <p class="section-subtitle">Membangun komunitas rohani yang kuat</p>
    
    <div class="vision-mission">
        <div class="vm-card reveal" style="transition-delay: 0.1s;">
            <h3>Visi</h3>
            <p>{{ $churchInfo->vision ?? 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia.' }}</p>
        </div>
        
        <div class="vm-card reveal" style="transition-delay: 0.3s;">
            <h3>Misi</h3>
            <p>{{ $churchInfo->mission ?? 'Membangun murid-murid Kristus melalui ibadah, persekutuan, dan pelayanan.' }}</p>
        </div>
    </div>
</section>

<!-- This Week's Schedule -->
<section class="section bg-light">
    <h2 class="section-title">Jadwal Minggu Ini</h2>
    <p class="section-subtitle">Bergabunglah bersama kami dalam ibadah dan persekutuan</p>
    
    <div class="schedule-cards">
        @forelse($upcomingServices as $index => $service)
        <div class="schedule-card reveal" style="transition-delay: {{ $index * 0.1 }}s;">
            <h3>{{ $service->title }}</h3>
            <p class="schedule-date">
                📅 {{ \Carbon\Carbon::parse($service->date)->isoFormat('dddd, D MMMM Y') }}
            </p>
            <p class="schedule-time">
                🕐 {{ \Carbon\Carbon::parse($service->time_start)->format('H:i') }} - 
                {{ \Carbon\Carbon::parse($service->time_end)->format('H:i') }}
            </p>
            <p class="schedule-time">📍 {{ $service->location }}</p>
        </div>
        @empty
        <p style="text-align: center; grid-column: 1/-1;">
            Tidak ada jadwal ibadah minggu ini
        </p>
        @endforelse
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('schedules') }}" class="cta-button">
            Lihat Semua Jadwal
        </a>
    </div>
</section>

<!-- Upcoming Events -->
@if($upcomingEvents->count() > 0)
<section class="section">
    <h2 class="section-title">Acara Mendatang</h2>
    <p class="section-subtitle">Acara dan kegiatan khusus</p>
    
    <div class="schedule-cards">
        @foreach($upcomingEvents as $index => $event)
        <div class="schedule-card reveal" style="transition-delay: {{ $index * 0.1 }}s;">
            <h3>{{ $event->title }}</h3>
            <p class="schedule-date">
                📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}
            </p>
            <p>{{ Str::limit($event->description, 100) }}</p>
            <a href="{{ route('events.show', $event->id) }}" style="color: var(--primary-blue); font-weight: 600; text-decoration: none;">
                Selengkapnya
            </a>
        </div>
        @endforeach
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('events') }}" class="cta-button">
            Lihat Semua Acara
        </a>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('scroll', function() {
        const heroContent = document.getElementById('hero-content');
        if (!heroContent) return;
        
        const scrollPosition = window.scrollY;
        const opacity = 1 - (scrollPosition / 400);
        const transform = scrollPosition * 0.4;
        
        if (opacity >= 0) {
            heroContent.style.opacity = opacity;
            heroContent.style.transform = `translateY(${transform}px)`;
        } else {
            heroContent.style.opacity = 0;
        }
    });
</script>
@endpush
