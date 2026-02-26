@extends('layouts.app')

@section('title', 'Daftar Akun - GBIS Mojoagung')

@push('styles')
<style>
    .register-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    }
    
    .register-box {
        background: white;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        max-width: 500px;
        width: 100%;
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .register-header h1 {
        color: var(--primary-blue);
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .register-header p {
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
    
    .btn-register {
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
    
    .btn-register:hover {
        background: #003a8c;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 74, 173, 0.3);
    }
    
    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e0e0e0;
    }
    
    .login-link a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 500;
    }
    
    .login-link a:hover {
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
        .register-box {
            padding: 2rem;
        }
        
        .register-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <div class="register-box">
        <div class="register-header">
            <h1>Daftar Akun</h1>
            <p>Buat akun baru untuk mulai berinteraksi</p>
        </div>
        
        @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    required
                    autofocus
                >
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Masukkan alamat email"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan kata sandi (min. 8 karakter)"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi kata sandi"
                    required
                >
            </div>
            
            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>
        </form>
        
        <div class="login-link">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
    </div>
</div>
@endsection
