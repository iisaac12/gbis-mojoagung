@extends('layouts.app')

@section('title', (session('locale') == 'en' ? 'Service Schedules' : 'Jadwal Ibadah') . ' - GBIS Mojoagung')

@push('styles')
<style>
    .schedules-hero {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        color: white;
        padding: 3rem 2rem;
        text-align: center;
    }
    
    .schedules-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-left: 5px solid var(--primary-blue);
        transition: all 0.3s;
    }
    
    .schedule-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
    
    .language-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 1rem;
    }
    
    .badge-id {
        background: #e3f2fd;
        color: #1976d2;
    }
    
    .badge-en {
        background: #f3e5f5;
        color: #7b1fa2;
    }
    
    .badge-both {
        background: #e8f5e9;
        color: #388e3c;
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
<!-- Hero Section -->
<section class="schedules-hero">
    <h1>{{ session('locale') == 'en' ? 'Service Schedules' : 'Jadwal Ibadah' }}</h1>
    <p>{{ session('locale') == 'en' 
        ? 'Join us in worship and fellowship' 
        : 'Bergabunglah bersama kami dalam ibadah dan persekutuan' }}</p>
</section>

<!-- Filters -->
<div class="filters">
    <div class="filter-row">
        <div class="filter-group">
            <label style="font-weight: 600; color: #555;">
                {{ session('locale') == 'en' ? 'Time:' : 'Waktu:' }}
            </label>
            <a href="{{ route('schedules', ['filter' => 'upcoming', 'language' => request('language', 'all')]) }}" 
               class="filter-btn {{ request('filter', 'upcoming') == 'upcoming' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Upcoming' : 'Mendatang' }}
            </a>
            <a href="{{ route('schedules', ['filter' => 'past', 'language' => request('language', 'all')]) }}" 
               class="filter-btn {{ request('filter') == 'past' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Past' : 'Lampau' }}
            </a>
            <a href="{{ route('schedules', ['filter' => 'all', 'language' => request('language', 'all')]) }}" 
               class="filter-btn {{ request('filter') == 'all' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'All' : 'Semua' }}
            </a>
        </div>
        
        <div style="width: 2px; height: 30px; background: #ddd;"></div>
        
        <div class="filter-group">
            <label style="font-weight: 600; color: #555;">
                {{ session('locale') == 'en' ? 'Language:' : 'Bahasa:' }}
            </label>
            <a href="{{ route('schedules', ['language' => 'all', 'filter' => request('filter', 'upcoming')]) }}" 
               class="filter-btn {{ request('language', 'all') == 'all' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'All' : 'Semua' }}
            </a>
            <a href="{{ route('schedules', ['language' => 'id', 'filter' => request('filter', 'upcoming')]) }}" 
               class="filter-btn {{ request('language') == 'id' ? 'active' : '' }}">
                🇮🇩 Indonesia
            </a>
            <a href="{{ route('schedules', ['language' => 'en', 'filter' => request('filter', 'upcoming')]) }}" 
               class="filter-btn {{ request('language') == 'en' ? 'active' : '' }}">
                🇬🇧 English
            </a>
        </div>
    </div>
</div>

<!-- Schedules Grid -->
<section class="section">
    @if($services->count() > 0)
    <div class="schedule-grid">
        @foreach($services as $service)
        <div class="schedule-card">
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
            
            <span class="language-badge badge-{{ $service->language }}">
                @if($service->language == 'id')
                    🇮🇩 Bahasa Indonesia
                @elseif($service->language == 'en')
                    🇬🇧 English
                @else
                    🌐 {{ session('locale') == 'en' ? 'Bilingual' : 'Dwi Bahasa' }}
                @endif
            </span>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
        {{ $services->links() }}
    </div>
    @else
    <div class="no-results">
        <h3>{{ session('locale') == 'en' ? 'No schedules found' : 'Tidak ada jadwal ditemukan' }}</h3>
        <p>{{ session('locale') == 'en' 
            ? 'Please try different filters or check back later.' 
            : 'Silakan coba filter lain atau periksa kembali nanti.' }}</p>
    </div>
    @endif
</section>
@endsection