@extends('layouts.admin')

@section('title', 'Add New Announcement - GBIS Mojoagung')

@section('content')
<div class="topbar">
    <div class="topbar-left">
        <h1>Add New Announcement</h1>
    </div>
</div>

<style>
    @media (max-width: 600px) {
        .recent-section {
            padding: 1.5rem !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }
        .form-actions {
            flex-direction: column-reverse;
        }
        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="recent-section" style="max-width: 850px; margin: 0 auto; padding: 3rem; background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.04);">
    <form action="{{ route('admin.announcements.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--gray-dark); font-size: 0.95rem;">Judul Pengumuman *</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Jadwal Ibadah Minggu Ini"
                   style="width: 100%; padding: 1rem; border: 1px solid #e0e0e0; border-radius: 12px; font-family: inherit; transition: border-color 0.3s;" required>
            @error('title') <small style="color: var(--primary-red); margin-top: 0.5rem; display: block;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--gray-dark); font-size: 0.95rem;">Isi Pengumuman *</label>
            <textarea name="content" rows="6" placeholder="Tuliskan detail pengumuman di sini..."
                      style="width: 100%; padding: 1rem; border: 1px solid #e0e0e0; border-radius: 12px; font-family: inherit; transition: border-color 0.3s; resize: vertical;" required>{{ old('content') }}</textarea>
            @error('content') <small style="color: var(--primary-red); margin-top: 0.5rem; display: block;">{{ $message }}</small> @enderror
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--gray-dark); font-size: 0.95rem;">Tipe Tampilan *</label>
                <select name="type" style="width: 100%; padding: 1rem; border: 1px solid #e0e0e0; border-radius: 12px; font-family: inherit; background: white;" required>
                    <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Info (Biru - Standar)</option>
                    <option value="success" {{ old('type') == 'success' ? 'selected' : '' }}>Success (Hijau - Berhasil)</option>
                    <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Warning (Kuning - Perhatian)</option>
                    <option value="important" {{ old('type') == 'important' ? 'selected' : '' }}>Important (Merah - Mendesak)</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: var(--gray-dark); font-size: 0.95rem;">Tanggal Berakhir (Opsional)</label>
                <input type="date" name="expires_at" value="{{ old('expires_at') }}" 
                       style="width: 100%; padding: 1rem; border: 1px solid #e0e0e0; border-radius: 12px; font-family: inherit;">
                <small style="color: #888; display: block; margin-top: 0.5rem;">Pengumuman akan hilang otomatis setelah tanggal ini.</small>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 2.5rem; margin-bottom: 3rem; padding: 1.5rem; background: #f9f9f9; border-radius: 12px;">
            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; user-select: none;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 1.2rem; height: 1.2rem; cursor: pointer;"> 
                <span style="font-weight: 600; font-size: 1rem;">Aktifkan Sekarang</span>
            </label>
            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; user-select: none;">
                <input type="checkbox" name="is_pinned" value="1" {{ old('is_pinned') ? 'checked' : '' }} style="width: 1.2rem; height: 1.2rem; cursor: pointer;"> 
                <span style="font-weight: 600; font-size: 1rem; color: var(--primary-red);">Sematkan di Atas (Pinned)</span>
            </label>
        </div>

        <div class="form-actions" style="display: flex; gap: 1.5rem; justify-content: flex-end; padding-top: 2rem; border-top: 1px solid #f0f0f0;">
            <a href="{{ route('admin.announcements.index') }}" class="btn" style="background: #f5f5f5; color: #666; padding: 1rem 2rem;">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 1rem 2.5rem; box-shadow: 0 5px 15px rgba(0,74,173,0.3);">Terbitkan Pengumuman</button>
        </div>
    </form>
</div>
@endsection
