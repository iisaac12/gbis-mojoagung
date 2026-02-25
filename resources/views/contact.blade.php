@extends('layouts.app')

@section('title', 'Hubungi Kami - GBIS Mojoagung')

@push('styles')
<style>
    .contact-hero {
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

    .contact-hero-content {
        position: relative;
        z-index: 10;
    }

    .contact-hero h1, .contact-hero p {
        opacity: 0;
        transform: translateY(30px);
        animation: ElegantFade 1s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    }

    .contact-hero h1 {
        animation-delay: 0.2s;
    }

    .contact-hero p {
        animation-delay: 0.5s;
    }

    .scroll-animate {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }
    
    .contact-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }
    
    .contact-info {
        background: var(--gray-light);
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .contact-info h2 {
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: white;
        border-radius: 10px;
    }
    
    .info-icon {
        font-size: 1.8rem;
        min-width: 40px;
    }
    
    .info-content h3 {
        color: var(--primary-blue);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }
    
    .info-content p, .info-content a {
        color: #555;
        text-decoration: none;
    }
    
    .info-content a:hover {
        color: var(--primary-blue);
        text-decoration: underline;
    }
    
    .contact-form {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.03);
    }
    
    .contact-form h2 {
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--gray-dark);
        font-weight: 600;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-blue);
    }
    
    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }
    
    .btn-submit {
        width: 100%;
        padding: 1rem;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        background: #003a8c;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 74, 173, 0.3);
    }
    
    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .map-container {
        margin-top: 3rem;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .map-container iframe {
        width: 100%;
        height: 400px;
        border: none;
    }
    
    @media (max-width: 768px) {
        .contact-hero {
            padding: 4rem 1.5rem;
        }

        .contact-hero h1 {
            font-size: 2.25rem;
        }
        
        .contact-container {
            padding: 2rem 1.5rem;
        }

        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .contact-info, .contact-form {
            padding: 1.5rem;
        }

        .btn-submit {
            padding: 1.1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Slider -->
<section class="contact-hero">
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

    <div class="contact-hero-content scroll-animate" id="contact-hero-content">
        <h1 class="scintillate-text">Hubungi Kami</h1>
        <p class="scintillate-text">Kami senang mendengar dari Anda!</p>
    </div>

    @if($heroImages->count() > 1)
    <div class="hero-nav">
        <button class="hero-nav-btn prev">❮</button>
        <button class="hero-nav-btn next">❯</button>
    </div>
    @endif
</section>

<!-- Contact Content -->
<div class="contact-container">
    <div class="contact-grid">
        <!-- Contact Information -->
        <div class="contact-info reveal" style="transition-delay: 0.1s;">
            <h2>Informasi Kontak</h2>
            
            <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-content">
                    <h3>Alamat</h3>
                    <p>{{ $churchInfo->address ?? 'Jl. Raya Mojoagung No. 123, Mojoagung, Jombang, Jawa Timur 61482' }}</p>
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-content">
                    <h3>Telepon</h3>
                    <a href="tel:{{ $churchInfo->phone ?? '(0321) 123456' }}">
                        {{ $churchInfo->phone ?? '(0321) 123456' }}
                    </a>
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">✉️</span>
                <div class="info-content">
                    <h3>Email</h3>
                    <a href="mailto:{{ $churchInfo->email ?? 'info@gbismojoagung.org' }}">
                        {{ $churchInfo->email ?? 'info@gbismojoagung.org' }}
                    </a>
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">💬</span>
                <div class="info-content">
                    <h3>WhatsApp</h3>
                    <a href="{{ $churchInfo->whatsapp_link ?? 'https://wa.me/6281234567890' }}" target="_blank">
                        Chat dengan kami
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-form reveal" style="transition-delay: 0.3s;">
            <h2>Kirim Pesan</h2>
            
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
            @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nama *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', auth()->user()->username ?? '') }}"
                           placeholder="Nama Anda"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', auth()->user()->email ?? '') }}"
                           placeholder="Email Anda"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="message">Pesan *</label>
                    <textarea id="message" 
                              name="message" 
                              placeholder="Pesan Anda..."
                              required>{{ old('message') }}</textarea>
                </div>
                
                <button type="submit" class="btn-submit">
                    Kirim Pesan
                </button>
                
                @guest
                <p style="margin-top: 1rem; text-align: center; color: #666; font-size: 0.9rem;">
                    Pesan Anda akan dikirim via email
                </p>
                @else
                <p style="margin-top: 1rem; text-align: center; color: #666; font-size: 0.9rem;">
                    Login sebagai {{ auth()->user()->username }}
                </p>
                @endguest
            </form>
        </div>
    </div>
    
    <!-- Google Maps -->
<div class="map-container reveal">
    @if(isset($churchInfo->map_embed))
        {!! $churchInfo->map_embed !!}
    @else
        <iframe 
            src="{{ $churchInfo->map_link }}" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('scroll', function() {
        const heroContent = document.getElementById('contact-hero-content');
        if (!heroContent) return;
        
        const scrollPosition = window.scrollY;
        const opacity = 1 - (scrollPosition / 300);
        const transform = scrollPosition * 0.3;
        
        if (opacity >= 0) {
            heroContent.style.opacity = opacity;
            heroContent.style.transform = `translateY(${transform}px)`;
        } else {
            heroContent.style.opacity = 0;
        }
    });
</script>
@endpush
