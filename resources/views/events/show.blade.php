@extends('layouts.app')

@section('title', $event->title . ' - GBIS Mojoagung')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">
    <a href="{{ route('events') }}" style="color: var(--primary-blue); text-decoration: none; margin-bottom: 2rem; display: inline-block;">
        ← {{ session('locale') == 'en' ? 'Back to Events' : 'Kembali ke Acara' }}
    </a>
    
    @if($event->image_url)
    <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 15px; margin-bottom: 2rem;">
    @endif
    
    <span style="display: inline-block; background: var(--primary-red); color: white; padding: 0.5rem 1.5rem; border-radius: 25px; font-weight: 600; margin-bottom: 1.5rem;">
        📅 {{ \Carbon\Carbon::parse($event->date)->isoFormat('dddd, D MMMM Y') }}
    </span>
    
    <h1 style="color: var(--primary-blue); font-size: 2.5rem; margin-bottom: 1.5rem;">{{ $event->title }}</h1>
    
    <div style="white-space: pre-line; line-height: 1.8; color: #555;">
        {{ $event->description }}
    </div>
    
    @if($relatedEvents->count() > 0)
    <div style="margin-top: 4rem; padding-top: 3rem; border-top: 2px solid #e0e0e0;">
        <h2 style="color: var(--primary-blue); margin-bottom: 2rem;">
            {{ session('locale') == 'en' ? 'Other Events' : 'Acara Lainnya' }}
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            @foreach($relatedEvents as $related)
            <a href="{{ route('events.show', $related->id) }}" style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); text-decoration: none; color: inherit;">
                <h4 style="color: var(--primary-blue); margin-bottom: 0.5rem;">{{ $related->title }}</h4>
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
@endsection