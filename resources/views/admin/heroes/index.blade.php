@extends('layouts.admin')

@section('title', 'Manajemen Foto Hero - Admin')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 3rem 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: var(--primary-blue);">Manajemen Foto Hero</h1>
        <a href="{{ route('admin.heroes.create') }}" class="cta-button" style="background: var(--primary-blue); color: white; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600;">
            + Tambah Foto Hero
        </a>
    </div>

    @if(session('success'))
    <div style="background: #e8f5e9; color: #2e7d32; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('success') }}
    </div>
    @endif

    <div style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <th style="padding: 1.5rem;">Pratinjau</th>
                    <th style="padding: 1.5rem;">Halaman</th>
                    <th style="padding: 1.5rem;">Urutan</th>
                    <th style="padding: 1.5rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($heroImages->count() > 0)
                    @foreach($heroImages as $image)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1.5rem;">
                            <img src="{{ $image->image_url }}" alt="Hero" style="width: 150px; height: 80px; object-fit: cover; border-radius: 8px;">
                        </td>
                        <td style="padding: 1.5rem; text-transform: capitalize;">{{ $image->page_name }}</td>
                        <td style="padding: 1.5rem;">{{ $image->sort_order }}</td>
                        <td style="padding: 1.5rem;">
                            <form action="{{ route('admin.heroes.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #ffebee; color: #c62828; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; font-weight: 600;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center; color: #999;">
                            Belum ada foto hero yang diunggah.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
