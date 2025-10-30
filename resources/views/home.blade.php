@extends('layouts.app')

@section('title', 'Home - GBIS Mojoagung')

@push('styles')
<style>
    .hero {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M50 10L90 90H10z" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.1;
    }
    
    .hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .hero p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }
    
    .cta-button {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(198, 40, 40, 0.3);
    }
    
    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(198, 40, 40, 0.4);
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
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .vm-card:hover {
        transform: translateY(-5px);
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
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    
    .schedule-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        transform: translateX(5px);
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
        .hero h1 {
            font-size: 2rem;
        }
        
        .hero p {
            font-size: 1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>{{ session('locale') == 'en' ? 'Welcome to GBIS Mojoagung' : 'Selamat Datang di GBIS Mojoagung' }}</h1>
        <p>{{ session('locale') == 'en' 
            ? 'A church that spreads the love of Christ' 
            : 'Gereja yang menyebarkan kasih Kristus' }}</p>
        <a href="{{ route('schedules') }}" class="cta-button">
            {{ session('locale') == 'en' ? 'Join Our Service' : 'Bergabunglah dalam Ibadah' }}
        </a>
    </div>
</section>

<!-- Vision & Mission -->
<section class="section">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Our Vision & Mission' : 'Visi & Misi Kami' }}</h2>
    <p class="section-subtitle">
        {{ session('locale') == 'en' 
            ? 'Building a strong spiritual community' 
            : 'Membangun komunitas rohani yang kuat' }}
    </p>
    
    <div class="vision-mission">
        <div class="vm-card">
            <h3>{{ session('locale') == 'en' ? '🎯 Vision' : '🎯 Visi' }}</h3>
            <p>{{ $churchInfo->vision ?? (session('locale') == 'en' 
                ? 'To be a church that glorifies God and spreads His love to the world.' 
                : 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia.') }}</p>
        </div>
        
        <div class="vm-card">
            <h3>{{ session('locale') == 'en' ? '🙏 Mission' : '🙏 Misi' }}</h3>
            <p>{{ $churchInfo->mission ?? (session('locale') == 'en' 
                ? 'Building disciples of Christ through worship, fellowship, and service.' 
                : 'Membangun murid-murid Kristus melalui ibadah, persekutuan, dan pelayanan.') }}</p>
        </div>
    </div>
</section>

<!-- This Week's Schedule -->
<section class="section bg-light">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'This Week\'s Schedule' : 'Jadwal Minggu Ini' }}</h2>
    <p class="section-subtitle">
        {{ session('locale') == 'en' 
            ? 'Join us in worship and fellowship' 
            : 'Bergabunglah bersama kami dalam ibadah dan persekutuan' }}
    </p>
    
    <div class="schedule-cards">
        @forelse($upcomingServices as $service)
        <div class="schedule-card">
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
            {{ session('locale') == 'en' 
                ? 'No scheduled services this week' 
                : 'Tidak ada jadwal ibadah minggu ini' }}
        </p>
        @endforelse
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('schedules') }}" class="cta-button">
            {{ session('locale') == 'en' ? 'View All Schedules' : 'Lihat Semua Jadwal' }}
        </a>
    </div>
</section>

<!-- Upcoming Events -->
@if($upcomingEvents->count() > 0)
<section class="section">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Upcoming Events' : 'Acara Mendatang' }}</h2>
    <p class="section-subtitle">
        {{ session('locale') == 'en' 
            ? 'Special events and activities' 
            : 'Acara dan kegiatan khusus' }}
    </p>
    
    <div class="schedule-cards">
        @foreach($upcomingEvents as $event)
        <div class="schedule-card">
            <h3>{{ $event->title }}</h3>
            <p class="schedule-date">
                📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}
            </p>
            <p>{{ Str::limit($event->description, 100) }}</p>
            <a href="{{ route('events.show', $event->id) }}" style="color: var(--primary-blue); font-weight: 600; text-decoration: none;">
                {{ session('locale') == 'en' ? 'Read more →' : 'Selengkapnya →' }}
            </a>
        </div>
        @endforeach
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('events') }}" class="cta-button">
            {{ session('locale') == 'en' ? 'View All Events' : 'Lihat Semua Acara' }}
        </a>
    </div>
</section>
@endif
@endsection