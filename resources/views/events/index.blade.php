@extends('layouts.app')

@section('title', (session('locale') == 'en' ? 'Events' : 'Acara') . ' - GBIS Mojoagung')

@push('styles')
<style>
    .events-hero {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
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
    
    .event-title {
        color: var(--primary-blue);
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<section class="events-hero">
    <h1>{{ session('locale') == 'en' ? 'Church Events' : 'Acara Gereja' }}</h1>
    <p>{{ session('locale') == 'en' ? 'Special events and activities' : 'Acara dan kegiatan khusus' }}</p>
</section>

<div class="events-grid">
    @forelse($events as $event)
    <a href="{{ route('events.show', $event->id) }}" class="event-card">
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
        {{ session('locale') == 'en' ? 'No events found' : 'Tidak ada acara ditemukan' }}
    </p>
    @endforelse
</div>

<div style="padding: 0 2rem 3rem; max-width: 1200px; margin: 0 auto;">
    {{ $events->links() }}
</div>
@endsection