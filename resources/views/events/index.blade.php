@extends('layouts.app')

@section('title', (session('locale') == 'en' ? 'Events' : 'Acara') . ' - GBIS Mojoagung')

@push('styles')
<style>
    .events-hero {
        background: linear-gradient(135deg, #C62828 0%, #E53935 100%);
        color: white;
        padding: 3rem 2rem;
        text-align: center;
    }
    
    .events-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
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
    
    .search-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }
    
    .search-box {
        flex: 1;
        min-width: 250px;
        max-width: 400px;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 1rem;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: var(--primary-red);
    }
    
    .filter-btn {
        padding: 0.6rem 1.5rem;
        border: 2px solid var(--primary-red);
        background: white;
        color: var(--primary-red);
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary-red);
        color: white;
    }
    
    .section {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
    
    .event-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
    }
    
    .event-content {
        padding: 1.5rem;
    }
    
    .event-date {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .event-title {
        color: var(--primary-blue);
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    
    .event-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    .read-more {
        color: var(--primary-red);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .read-more:hover {
        text-decoration: underline;
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: #999;
    }
    
    @media (max-width: 768px) {
        .events-hero h1 {
            font-size: 2rem;
        }
        
        .events-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="events-hero">
    <h1>{{ session('locale') == 'en' ? 'Church Events' : 'Acara Gereja' }}</h1>
    <p>{{ session('locale') == 'en' 
        ? 'Special events and activities at GBIS Mojoagung' 
        : 'Acara dan kegiatan khusus di GBIS Mojoagung' }}</p>
</section>

<!-- Search & Filter -->
<div class="search-filter">
    <form action="{{ route('events') }}" method="GET">
        <div class="search-row">
            <div class="search-box">
                <input type="text" 
                       name="search" 
                       placeholder="{{ session('locale') == 'en' ? 'Search events...' : 'Cari acara...' }}"
                       value="{{ request('search') }}">
            </div>
            
            <button type="submit" class="filter-btn" style="background: var(--primary-red); color: white;">
                🔍 {{ session('locale') == 'en' ? 'Search' : 'Cari' }}
            </button>
            
            <div style="width: 2px; height: 30px; background: #ddd;"></div>
            
            <a href="{{ route('events', ['filter' => 'upcoming', 'search' => request('search')]) }}" 
               class="filter-btn {{ request('filter', 'upcoming') == 'upcoming' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Upcoming' : 'Mendatang' }}
            </a>
            <a href="{{ route('events', ['filter' => 'past', 'search' => request('search')]) }}" 
               class="filter-btn {{ request('filter') == 'past' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Past' : 'Lampau' }}
            </a>
            <a href="{{ route('events', ['filter' => 'all', 'search' => request('search')]) }}" 
               class="filter-btn {{ request('filter') == 'all' ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'All' : 'Semua' }}
            </a>
        </div>
    </form>
</div>

<!-- Events Grid -->
<section class="section">
    @if($events->count() > 0)
    <div class="events-grid">
        @foreach($events as $event)
        <a href="{{ route('events.show', $event->id) }}" class="event-card" style="text-decoration: none;">
            @if($event->image_url)
            <img src="{{ Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="event-image">
            @else
            <div class="event-image"></div>
            @endif
            
            <div class="event-content">
                <span class="event-date">
                    📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('D MMM Y') }}
                </span>
                
                <h3 class="event-title">{{ $event->title }}</h3>
                
                <p class="event-description">{{ Str::limit($event->description, 120) }}</p>
                
                <span class="read-more">
                    {{ session('locale') == 'en' ? 'Read more' : 'Selengkapnya' }} →
                </span>
            </div>