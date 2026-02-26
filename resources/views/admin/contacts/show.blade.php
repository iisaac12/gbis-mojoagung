@extends('layouts.admin')

@section('title', 'Detail Pesan - Admin')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <a href="{{ route('admin.contacts.index') }}" style="color: var(--primary-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; font-weight: 600; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(-5px)'" onmouseout="this.style.transform='translateX(0)'">
        <span>←</span> Kembali ke Daftar Pesan
    </a>

    <div style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="color: var(--primary-blue); margin-bottom: 0.25rem; font-size: 1.8rem;">{{ $contact->name }}</h1>
                <p style="color: #666; font-size: 1rem;">{{ $contact->email }}</p>
            </div>
            <div style="text-align: right;">
                <span style="display: inline-block; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; {{ $contact->is_guest ? 'background: #fff3e0; color: #e65100;' : 'background: #e8f5e9; color: #2e7d32;' }}">
                    {{ $contact->is_guest ? 'Tamu (Guest)' : 'Anggota (Member)' }}
                </span>
                <p style="color: #999; font-size: 0.85rem;">{{ $contact->created_at->isoFormat('dddd, D MMMM Y HH:mm') }}</p>
            </div>
        </div>

        <div style="line-height: 1.8; color: #333; font-size: 1.05rem; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word; background: #fcfcfc; padding: 2rem; border-radius: 12px; border: 1px solid #f0f0f0; max-height: 500px; overflow-y: auto;">
            {{ $contact->message }}
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: var(--primary-red); color: white; padding: 0.8rem 2rem; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; transition: transform 0.2s;">Hapus Pesan</button>
            </form>
            <a href="mailto:{{ $contact->email }}" style="background: var(--primary-blue); color: white; padding: 0.8rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">Balas via Email</a>
        </div>
    </div>
</div>
@endsection
