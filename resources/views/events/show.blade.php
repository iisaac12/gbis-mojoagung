@extends('layouts.app')

@section('title', $event->title . ' - GBIS Mojoagung')

@section('content')
<div class="event-detail-container" style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">
    <div class="reveal">
        <a href="{{ route('events') }}" style="color: var(--primary-blue); text-decoration: none; margin-bottom: 2rem; display: inline-block; transition: transform 0.3s ease;">
            ← Kembali ke Acara
        </a>
    </div>
    
    @if($event->image_url)
    <div class="reveal" style="transition-delay: 0.1s;">
        <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" style="width: 100%; height: auto; border-radius: 15px; margin-bottom: 2rem; display: block; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
    </div>
    @endif
    
    <div class="reveal" style="transition-delay: 0.2s;">
        <span style="display: inline-block; background: var(--primary-red); color: white; padding: 0.5rem 1.5rem; border-radius: 25px; font-weight: 600; margin-bottom: 1.5rem;">
            📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}
        </span>
    </div>
    
    <div class="reveal" style="transition-delay: 0.3s;">
        <h1 style="color: var(--primary-blue); font-size: 2.5rem; margin-bottom: 1.5rem;">{{ $event->title }}</h1>
    </div>
    
    <div class="reveal" style="transition-delay: 0.4s;">
        <div style="white-space: pre-line; line-height: 1.8; color: #555;">
            {{ $event->description }}
        </div>
    </div>
    
    @if($relatedEvents->count() > 0)
    <div style="margin-top: 4rem; padding-top: 3rem; border-top: 2px solid #e0e0e0;">
        <div class="reveal">
            <h2 style="color: var(--primary-blue); margin-bottom: 2rem;">
                Acara Lainnya
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            @foreach($relatedEvents as $index => $related)
            <a href="{{ route('events.show', $related->id) }}" 
               class="related-event-card reveal" 
               style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-decoration: none; color: inherit; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); border: 1px solid rgba(0,0,0,0.03); display: block; transition-delay: {{ ($index + 1) * 0.1 }}s;">
                <h4 style="color: var(--primary-blue); margin-bottom: 0.5rem; transition: color 0.3s;">{{ $related->title }}</h4>
                <p style="color: var(--primary-red); font-weight: 600; margin-bottom: 0.5rem;">
                    📅 {{ \Carbon\Carbon::parse($related->date)->isoFormat('D MMMM Y') }}
                </p>
                <p style="color: #666;">{{ Str::limit($related->description, 80) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
    @media (max-width: 768px) {
        .event-detail-container {
            padding: 2rem 1.5rem !important;
        }
        .event-detail-container h1 {
            font-size: 1.8rem !important;
        }
        .related-event-card {
            padding: 1rem !important;
        }
    }

    .related-event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        border-color: rgba(0, 74, 173, 0.1) !important;
    }
    .related-event-card:hover h4 {
        color: var(--primary-red) !important;
    }
</style>
@endsection