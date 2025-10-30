@extends('layouts.app')

@section('title', (session('locale') == 'en' ? 'About Us' : 'Tentang Kami') . ' - GBIS Mojoagung')

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .about-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .section {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .section-title {
        font-size: 2.5rem;
        color: var(--primary-blue);
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .history-timeline {
        position: relative;
        padding-left: 3rem;
    }
    
    .history-timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--primary-blue);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 2rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -3.5rem;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary-red);
        border: 4px solid white;
        box-shadow: 0 0 0 2px var(--primary-blue);
    }
    
    .vm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .vm-card {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .vm-card:hover {
        transform: translateY(-10px);
    }
    
    .vm-card h3 {
        color: var(--primary-blue);
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    
    .vm-card p {
        line-height: 1.8;
        color: #555;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        aspect-ratio: 4/3;
        cursor: pointer;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .bg-light {
        background: var(--gray-light);
    }
    
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .history-timeline {
            padding-left: 2rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="about-hero">
    <h1>{{ session('locale') == 'en' ? 'About Us' : 'Tentang Kami' }}</h1>
    <p>{{ session('locale') == 'en' 
        ? 'Get to know more about GBIS Mojoagung' 
        : 'Mengenal lebih dekat GBIS Mojoagung' }}</p>
</section>

<!-- Church Description -->
<section class="section">
    <h2 class="section-title">{{ $churchInfo->name ?? 'GBIS Mojoagung' }}</h2>
    <p style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.1rem; line-height: 1.8;">
        {{ $churchInfo->description ?? (session('locale') == 'en' 
            ? 'GBIS Mojoagung is a church dedicated to spreading the love of Christ to the world through worship, fellowship, and service.' 
            : 'GBIS Mojoagung adalah gereja yang berdedikasi untuk menyebarkan kasih Kristus ke seluruh dunia melalui ibadah, persekutuan, dan pelayanan.') }}
    </p>
</section>

<!-- Vision & Mission -->
<section class="section bg-light">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Vision & Mission' : 'Visi & Misi' }}</h2>
    
    <div class="vm-grid">
        <div class="vm-card">
            <h3>🎯 {{ session('locale') == 'en' ? 'Vision' : 'Visi' }}</h3>
            <p>{{ $churchInfo->vision ?? (session('locale') == 'en' 
                ? 'To be a church that glorifies God and spreads His love to the world through vibrant worship, close fellowship, and genuine service.' 
                : 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia melalui ibadah yang hidup, persekutuan yang erat, dan pelayanan yang nyata.') }}</p>
        </div>
        
        <div class="vm-card">
            <h3>🙏 {{ session('locale') == 'en' ? 'Mission' : 'Misi' }}</h3>
            <p>{{ $churchInfo->mission ?? (session('locale') == 'en' 
                ? 'Building spiritually mature disciples of Christ through the teaching of God\'s Word, powerful worship, warm fellowship, and loving service.' 
                : 'Membangun murid-murid Kristus yang dewasa rohani melalui pengajaran Firman Tuhan, ibadah yang penuh kuasa, persekutuan yang hangat, dan pelayanan yang mengasihi.') }}</p>
        </div>
    </div>
</section>

<!-- History -->
<section class="section">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Our History' : 'Sejarah Kami' }}</h2>
    
    <div class="history-timeline">
        <div class="timeline-item">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">{{ session('locale') == 'en' ? 'The Beginning' : 'Awal Mula' }}</h3>
            <p>{{ session('locale') == 'en' 
                ? 'GBIS Mojoagung was established as a place of worship for believers in the Mojoagung area and surrounding regions.' 
                : 'GBIS Mojoagung didirikan sebagai tempat ibadah bagi jemaat di wilayah Mojoagung dan sekitarnya.' }}</p>
        </div>
        
        <div class="timeline-item">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">{{ session('locale') == 'en' ? 'Growth' : 'Pertumbuhan' }}</h3>
            <p>{{ session('locale') == 'en' 
                ? 'The church continued to grow with various ministries and activities that touched the community.' 
                : 'Gereja terus berkembang dengan berbagai pelayanan dan kegiatan yang menyentuh masyarakat.' }}</p>
        </div>
        
        <div class="timeline-item">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">{{ session('locale') == 'en' ? 'Today' : 'Saat Ini' }}</h3>
            <p>{{ session('locale') == 'en' 
                ? 'Now GBIS Mojoagung continues to serve faithfully and spread the love of Christ to more people.' 
                : 'Kini GBIS Mojoagung terus melayani dengan setia dan menyebarkan kasih Kristus kepada lebih banyak orang.' }}</p>
        </div>
    </div>
</section>

<!-- Gallery -->
@if($gallery->count() > 0)
<section class="section bg-light">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Photo Gallery' : 'Galeri Foto' }}</h2>
    
    <div class="gallery-grid">
        @foreach($gallery as $photo)
        <div class="gallery-item">
            <img src="{{ $photo->image_url_full }}" alt="{{ $photo->title }}">
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Contact CTA -->
<section class="section" style="text-align: center;">
    <h2 class="section-title">{{ session('locale') == 'en' ? 'Want to Know More?' : 'Ingin Tahu Lebih Banyak?' }}</h2>
    <p style="margin-bottom: 2rem; font-size: 1.1rem;">
        {{ session('locale') == 'en' 
            ? 'Feel free to contact us or visit us directly!' 
            : 'Jangan ragu untuk menghubungi kami atau datang langsung!' }}
    </p>
    <a href="{{ route('contact') }}" class="cta-button" style="display: inline-block; background: var(--primary-blue); color: white; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: 600;">
        {{ session('locale') == 'en' ? 'Contact Us' : 'Hubungi Kami' }}
    </a>
</section>
@endsection