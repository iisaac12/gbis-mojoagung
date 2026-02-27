@extends('layouts.app')

@section('title', 'Tentang Kami - GBIS Mojoagung')

@push('styles')
<style>
    .about-hero {
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

    .about-hero-content {
        position: relative;
        z-index: 10;
    }

    .about-hero h1, .about-hero p {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .about-hero h1 {
        animation-delay: 0.2s;
    }

    .about-hero p {
        animation-delay: 0.5s;
    }

    .scroll-animate {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }
    
    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
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
        .about-hero {
            padding: 4rem 1.5rem;
            min-height: 40vh;
        }

        .about-hero h1 {
            font-size: 2.25rem;
        }
        
        .section-title {
            font-size: 2rem;
        }

        .section {
            padding: 3rem 1.5rem;
        }
        
        .history-timeline {
            padding-left: 1.5rem;
        }

        .timeline-item::before {
            left: -2rem;
            width: 16px;
            height: 16px;
        }

        .cta-button {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Slider -->
<section class="about-hero">
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

    <div class="about-hero-content scroll-animate" id="about-hero-content">
        <h1 class="scintillate-text">Tentang Kami</h1>
        <p class="scintillate-text">Mengenal lebih dekat GBIS Mojoagung</p>
    </div>

    @if($heroImages->count() > 1)
    <div class="hero-nav">
        <button class="hero-nav-btn prev"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="hero-nav-btn next"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
    @endif
</section>

<!-- Church Description -->
<section class="section">
    <div class="reveal">
        <h2 class="section-title">{{ $churchInfo->name ?? 'GBIS Mojoagung' }}</h2>
        <p style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.1rem; line-height: 1.8;">
            {{ $churchInfo->description ?? 'GBIS Mojoagung adalah gereja yang berdedikasi untuk menyebarkan kasih Kristus ke seluruh dunia melalui ibadah, persekutuan, dan pelayanan.' }}
        </p>
    </div>
</section>

<!-- Vision & Mission -->
<section class="section bg-light">
    <h2 class="section-title">Visi &amp; Misi</h2>
    
    <div class="vm-grid">
        <div class="vm-card reveal" style="transition-delay: 0.1s;">
            <h3>Visi</h3>
            <p>{{ $churchInfo->vision ?? 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia melalui ibadah yang hidup, persekutuan yang erat, dan pelayanan yang nyata.' }}</p>
        </div>
        
        <div class="vm-card reveal" style="transition-delay: 0.3s;">
            <h3>Misi</h3>
            <p>{{ $churchInfo->mission ?? 'Membangun murid-murid Kristus yang dewasa rohani melalui pengajaran Firman Tuhan, ibadah yang penuh kuasa, persekutuan yang hangat, dan pelayanan yang mengasihi.' }}</p>
        </div>
    </div>
</section>

<!-- History -->
<section class="section">
    <h2 class="section-title">Sejarah Kami</h2>
    
    <div class="history-timeline">
        <div class="timeline-item reveal" style="transition-delay: 0.1s;">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">Awal Mula</h3>
            <p>GBIS Mojoagung didirikan sebagai tempat ibadah bagi jemaat di wilayah Mojoagung dan sekitarnya.</p>
        </div>
        
        <div class="timeline-item reveal" style="transition-delay: 0.2s;">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">Pertumbuhan</h3>
            <p>Gereja terus berkembang dengan berbagai pelayanan dan kegiatan yang menyentuh masyarakat.</p>
        </div>
        
        <div class="timeline-item reveal" style="transition-delay: 0.3s;">
            <h3 style="color: var(--primary-blue); margin-bottom: 0.5rem;">Saat Ini</h3>
            <p>Kini GBIS Mojoagung terus melayani dengan setia dan menyebarkan kasih Kristus kepada lebih banyak orang.</p>
        </div>
    </div>
</section>

<!-- Gallery -->
@if($gallery->count() > 0)
<section class="section bg-light reveal">
    <h2 class="section-title">Galeri Foto</h2>
    
    <div class="gallery-grid">
        @foreach($gallery as $index => $photo)
        <div class="gallery-item reveal" style="transition-delay: {{ $index * 0.1 }}s;">
            <img src="{{ $photo->image_url_full }}" alt="{{ $photo->title }}">
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Contact CTA -->
<section class="section reveal" style="text-align: center;">
    <h2 class="section-title">Ingin Tahu Lebih Banyak?</h2>
    <p style="margin-bottom: 2rem; font-size: 1.1rem;">
        Jangan ragu untuk menghubungi kami atau datang langsung!
    </p>
    <a href="{{ route('contact') }}" class="cta-button" style="display: inline-block; background: var(--primary-blue); color: white; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
        Hubungi Kami
    </a>
</section>
@endsection