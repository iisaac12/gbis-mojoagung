@extends('layouts.admin')

@section('title', 'Tambah Foto Hero - Admin')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 3rem 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.heroes.index') }}" style="color: var(--primary-blue); text-decoration: none;">Kembali</a>
        <h1 style="color: var(--primary-blue); margin-top: 1rem;">Tambah Foto Hero</h1>
    </div>

    <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <form action="{{ route('admin.heroes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Halaman</label>
                <select name="page_name" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="home">Home</option>
                    <option value="about">About</option>
                    <option value="contact">Contact</option>
                    <option value="schedules">Schedules</option>
                    <option value="events">Events</option>
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Foto Hero</label>
                <input type="file" name="image" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;">
                <small style="color: #666; display: block; margin-top: 0.5rem;">Rekomendasi: 1920x1080px (16:9), Max 2MB</small>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Urutan (Opsional)</label>
                <input type="number" name="sort_order" value="0" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <button type="submit" class="cta-button" style="width: 100%; background: var(--primary-blue); color: white; padding: 1rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                Simpan Foto Hero
            </button>
        </form>
    </div>
</div>
@endsection
