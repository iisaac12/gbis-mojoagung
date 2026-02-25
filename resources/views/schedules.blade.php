@extends('layouts.app')

@section('title', 'Jadwal Ibadah - GBIS Mojoagung')

@push('styles')
<style>
    .schedules-hero {
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
        background: #004AAD;
    }

    .schedules-hero-content {
        position: relative;
        z-index: 10;
    }

    .schedules-hero h1, .schedules-hero p {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .schedules-hero h1 {
        animation-delay: 0.2s;
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .schedules-hero p {
        animation-delay: 0.5s;
        font-size: 1.2rem;
    }

    .scroll-animate {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }
    
    .filters {
        background: white;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: -2rem auto 2rem;
        max-width: 1200px;
        border-radius: 10px;
        position: relative;
        z-index: 10;
    }
    
    .filter-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }
    
    .filter-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    
    .filter-btn {
        padding: 0.6rem 1.5rem;
        border: 2px solid var(--primary-blue);
        background: white;
        color: var(--primary-blue);
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary-blue);
        color: white;
    }
    
    .section {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
    
    .schedule-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-left: 5px solid var(--primary-blue);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .schedule-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .schedule-card h3 {
        color: var(--primary-blue);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .schedule-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        color: #555;
    }
    
    .schedule-info strong {
        color: var(--primary-red);
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: #999;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }
    
    .pagination a, .pagination span {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: var(--primary-blue);
    }
    
    .pagination .active {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }
    
    @media (max-width: 768px) {
        .schedules-hero h1 {
            font-size: 2rem;
        }
        
        .filter-row {
            flex-direction: column;
        }
        
        .schedule-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Slider -->
<section class="schedules-hero">
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

    <div class="schedules-hero-content scroll-animate" id="schedules-hero-content">
        <h1 class="scintillate-text">Jadwal Ibadah</h1>
        <p class="scintillate-text">Bergabunglah bersama kami dalam ibadah dan persekutuan</p>
    </div>

    @if($heroImages->count() > 1)
    <div class="hero-nav">
        <button class="hero-nav-btn prev">❮</button>
        <button class="hero-nav-btn next">❯</button>
    </div>
    @endif
</section>

<!-- Filters -->
<div class="filters reveal">
    <div class="filter-row">
        <div class="filter-group">
            <label style="font-weight: 600; color: #555;">Tampilkan:</label>
            <a href="{{ route('schedules', ['filter' => 'upcoming']) }}" 
               class="filter-btn {{ request('filter', 'upcoming') == 'upcoming' ? 'active' : '' }}">
                Mendatang
            </a>
            <a href="{{ route('schedules', ['filter' => 'past']) }}" 
               class="filter-btn {{ request('filter') == 'past' ? 'active' : '' }}">
                Lampau
            </a>
            <a href="{{ route('schedules', ['filter' => 'all']) }}" 
               class="filter-btn {{ request('filter') == 'all' ? 'active' : '' }}">
                Semua
            </a>
        </div>
    </div>
</div>

<!-- Schedules Grid -->
<section class="section">
    @if($services->count() > 0)
    <div class="schedule-grid">
        @foreach($services as $index => $service)
        <div class="schedule-card reveal" style="transition-delay: {{ $index * 0.1 }}s;">
            <h3>{{ $service->title }}</h3>
            
            <div class="schedule-info">
                <span>📅</span>
                <strong>{{ \Carbon\Carbon::parse($service->date)->isoFormat('dddd, D MMMM Y') }}</strong>
            </div>
            
            <div class="schedule-info">
                <span>🕐</span>
                <span>{{ \Carbon\Carbon::parse($service->time_start)->format('H:i') }} - 
                      {{ \Carbon\Carbon::parse($service->time_end)->format('H:i') }}</span>
            </div>
            
            <div class="schedule-info">
                <span>📍</span>
                <span>{{ $service->location }}</span>
            </div>
            
            @if($service->description)
            <p style="margin-top: 1rem; color: #666;">{{ Str::limit($service->description, 100) }}</p>
            @endif
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
        {{ $services->links() }}
    </div>
    @else
    <div class="no-results">
        <h3>Tidak ada jadwal ditemukan</h3>
        <p>Silakan coba filter lain atau periksa kembali nanti.</p>
    </div>
    @endif
</section>
@endsection