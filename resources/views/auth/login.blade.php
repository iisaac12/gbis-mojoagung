@extends('layouts.app')

@section('title', 'Login - GBIS Mojoagung')

@push('styles')
<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    }
    
    .login-box {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        max-width: 450px;
        width: 100%;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .login-header h1 {
        color: var(--primary-blue);
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .login-header p {
        color: #666;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--gray-dark);
        font-weight: 500;
    }
    
    .form-group input {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: var(--primary-blue);
    }
    
    .btn-login {
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
    
    .btn-login:hover {
        background: #003a8c;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 74, 173, 0.3);
    }
    
    .guest-link {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e0e0e0;
    }
    
    .guest-link a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 500;
    }
    
    .guest-link a:hover {
        text-decoration: underline;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
    
    .alert-error {
        background: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }
    
    @media (max-width: 768px) {
        .login-box {
            padding: 2rem;
        }
        
        .login-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <h1>{{ session('locale') == 'en' ? 'Login' : 'Masuk' }}</h1>
            <p>{{ session('locale') == 'en' 
                ? 'Welcome back! Please login to your account' 
                : 'Selamat datang kembali! Silakan masuk ke akun Anda' }}</p>
        </div>
        
        @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">{{ session('locale') == 'en' ? 'Email or Username' : 'Email atau Username' }}</label>
                <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="{{ session('locale') == 'en' ? 'Enter your email or username' : 'Masukkan email atau username' }}"
                    required
                    autofocus
                >
            </div>
            
            <div class="form-group">
                <label for="password">{{ session('locale') == 'en' ? 'Password' : 'Kata Sandi' }}</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="{{ session('locale') == 'en' ? 'Enter your password' : 'Masukkan kata sandi' }}"
                    required
                >
            </div>
            
            <button type="submit" class="btn-login">
                {{ session('locale') == 'en' ? 'Login' : 'Masuk' }}
            </button>
        </form>
        
        <div class="guest-link">
            <p>{{ session('locale') == 'en' ? 'or' : 'atau' }}</p>
            <a href="{{ route('home') }}">
                {{ session('locale') == 'en' 
                    ? 'Continue as Guest' 
                    : 'Lanjutkan sebagai Tamu' }}
            </a>
        </div>
    </div>
</div>
@endsection