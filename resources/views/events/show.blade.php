@extends('layouts.app')

@section('title', $event->title . ' - GBIS Mojoagung')

@push('styles')
<style>
    .event-header {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        padding: 2rem;
        color: white;
    }
    
    .event-header-content {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .back-link {
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }
    
    .back-link:hover {
        opacity: 1;
        text-decoration: underline;
    }
    
    .event-detail {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }
    
    .event-main {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }
    
    .event-image-large {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        margin-bottom: 2rem;
    }
    
    .event-date-badge {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .event-title-large {
        font-size: 2.5rem;
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }
    
    .event-description-full {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        white-space: pre-line;
    }
    
    .event-sidebar {
        background: var(--gray-light);
        padding: 2rem;
        border-radius: 15px;
        height: fit-content;
    }
    
    .sidebar-section {
        margin-bottom: 2rem;
    }
    
    .sidebar-section:last-child {
        margin-bottom: 0;
    }
    
    .sidebar-section h3 {
        color: var(--primary-blue);
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        padding: 0.75rem;
        background: white;
        border-radius: 8px;
    }
    
    .info-icon {
        font-size: 1.5rem;
    }
    
    .related-events {
        margin-top: 4rem;
        padding-top: 3rem;
        border-top: 2px solid #e0e0e0;
    }
    
    .related-events h2 {
        font-size: 2rem;
        color: var(--primary-blue);
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .related-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .related-card:hover {
        transform: translateY(-5px);
    }
    
    .related-card h4 {
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }
    
    .related-card .date {
        color: var(--primary-red);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    @media (max-width: 968px) {
        .event-main {
            grid-template-columns: 1fr;
        }
        
        .event-title-large {
            font-size: 2rem;
        }
        
        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Event Header -->
<div class="event-header">
    <div class="event-header-content">
        <a href="{{ route('events') }}" class="back-link">
            ← {{ session('locale') == 'en' ? 'Back to Events' : 'Kembali ke Acara' }}
        </a>
    </div>
</div>

<!-- Event Detail -->
<section class="event-detail">
    <div class="event-main">
        <!-- Main Content -->
        <div>
            @if($event->image_url)
            <img src="{{ Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="event-image-large">
            @endif
            
            <span class="event-date-badge">
                📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}
            </span>
            
            <h1 class="event-title-large">{{ $event->title }}</h1>
            
            <div class="event-description-full">
                {{ $event->description }}
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="event-sidebar">
            <div class="sidebar-section">
                <h3>{{ session('locale') == 'en' ? 'Event Details' : 'Detail Acara' }}</h3>
                
                <div class="info-item">
                    <span class="info-icon">📅</span>
                    <div>
                        <strong>{{ session('locale') == 'en' ? 'Date' : 'Tanggal' }}</strong>
                        <p>{{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <span class="info-icon">⏰</span>
                    <div>
                        <strong>{{ session('locale') == 'en' ? 'Status' : 'Status' }}</strong>
                        <p>
                            @if(\Carbon\Carbon::parse($event->date)->isFuture())
                                <span style="color: green;">{{ session('locale') == 'en' ? 'Upcoming' : 'Mendatang' }}</span>
                            @else
                                <span style="color: #999;">{{ session('locale') == 'en' ? 'Past' : 'Selesai' }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="sidebar-section">
                <h3>{{ session('locale') == 'en' ? 'Share This Event' : 'Bagikan Acara' }}</h3>
                <div style="display: flex; gap: 0.5rem;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       style="padding: 0.75rem; background: #1877f2; color: white; border-radius: 8px; text-decoration: none; flex: 1; text-align: center;">
                        Facebook
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . request()->url()) }}" 
                       target="_blank"
                       style="padding: 0.75rem; background: #25d366; color: white; border-radius: 8px; text-decoration: none; flex: 1; text-align: center;">
                        WhatsApp
                    </a>
                </div>
            </div>
            
            <div class="sidebar-section">
                <a href="{{ route('contact') }}" 
                   style="display: block; padding: 1rem; background: var(--primary-blue); color: white; text-align: center; border-radius: 10px; text-decoration: none; font-weight: 600;">
                    {{ session('locale') == 'en' ? 'Contact Us' : 'Hubungi Kami' }}
                </a>
            </div>
        </div>
    </div>
    
    <!-- Related Events -->
    @if($relatedEvents->count() > 0)
    <div class="related-events">
        <h2>{{ session('locale') == 'en' ? 'Other Events' : 'Acara Lainnya' }}</h2>
        
        <div class="related-grid">
            @foreach($relatedEvents as $related)
            <a href="{{ route('events.show', $related->id) }}" class="related-card">
                <h4>{{ $related->title }}</h4>
                <p class="date">📅 {{ \Carbon\Carbon::parse($related->date)->isoFormat('D MMMM Y') }}</p>
                <p>{{ Str::limit($related->description, 80) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection