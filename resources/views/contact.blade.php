@extends('layouts.app')

@section('title', (session('locale') == 'en' ? 'Contact Us' : 'Hubungi Kami') . ' - GBIS Mojoagung')

@push('styles')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #004AAD 0%, #0066CC 100%);
        color: white;
        padding: 3rem 2rem;
        text-align: center;
    }
    
    .contact-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
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
        padding: 2rem;
        border-radius: 15px;
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
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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
    
    @media (max-width: 968px) {
        .contact-hero h1 {
            font-size: 2rem;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <h1>{{ session('locale') == 'en' ? 'Contact Us' : 'Hubungi Kami' }}</h1>
    <p>{{ session('locale') == 'en' 
        ? 'We\'d love to hear from you!' 
        : 'Kami senang mendengar dari Anda!' }}</p>
</section>

<!-- Contact Content -->
<div class="contact-container">
    <div class="contact-grid">
        <!-- Contact Information -->
        <div class="contact-info">
            <h2>{{ session('locale') == 'en' ? 'Get In Touch' : 'Informasi Kontak' }}</h2>
            
            <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-content">
                    <h3>{{ session('locale') == 'en' ? 'Address' : 'Alamat' }}</h3>
                    <p>{{ $churchInfo->address ?? 'Jl. Raya Mojoagung No. 123, Mojoagung, Jombang, Jawa Timur 61482' }}</p>
                </div>
            </div>
            
            <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-content">
                    <h3>{{ session('locale') == 'en' ? 'Phone' : 'Telepon' }}</h3>
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
                        {{ session('locale') == 'en' ? 'Chat with us' : 'Chat dengan kami' }}
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-form">
            <h2>{{ session('locale') == 'en' ? 'Send us a Message' : 'Kirim Pesan' }}</h2>
            
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
                    <label for="name">{{ session('locale') == 'en' ? 'Name' : 'Nama' }} *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', auth()->user()->username ?? '') }}"
                           placeholder="{{ session('locale') == 'en' ? 'Your name' : 'Nama Anda' }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', auth()->user()->email ?? '') }}"
                           placeholder="{{ session('locale') == 'en' ? 'Your email' : 'Email Anda' }}"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="message">{{ session('locale') == 'en' ? 'Message' : 'Pesan' }} *</label>
                    <textarea id="message" 
                              name="message" 
                              placeholder="{{ session('locale') == 'en' ? 'Your message...' : 'Pesan Anda...' }}"
                              required>{{ old('message') }}</textarea>
                </div>
                
                <button type="submit" class="btn-submit">
                    {{ session('locale') == 'en' ? 'Send Message' : 'Kirim Pesan' }}
                </button>
                
                @guest
                <p style="margin-top: 1rem; text-align: center; color: #666; font-size: 0.9rem;">
                    {{ session('locale') == 'en' 
                        ? 'Your message will be sent via email' 
                        : 'Pesan Anda akan dikirim via email' }}
                </p>
                @else
                <p style="margin-top: 1rem; text-align: center; color: #666; font-size: 0.9rem;">
                    {{ session('locale') == 'en' 
                        ? 'Logged in as ' . auth()->user()->username 
                        : 'Login sebagai ' . auth()->user()->username }}
                </p>
                @endguest
            </form>
        </div>
    </div>
    
    <!-- Google Maps -->
    <div class="map-container">
        @if(isset($churchInfo->map_embed))
            {!! $churchInfo->map_embed !!}
        @else
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.123456789!2d112.123456!3d-7.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDcnMjQuNCJTIDExMsKwMDcnMjQuNCJF!5e0!3m2!1sen!2sid!4v1234567890" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
        </iframe>
        @endif
    </div>
</div>