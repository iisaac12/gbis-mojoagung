@extends('layouts.admin')

@section('title', 'Pesan Masuk - Admin')

@section('content')
<div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
    <h1 style="color: var(--primary-blue); margin-bottom: 2rem;">Pesan Masuk</h1>

    @if(session('success'))
    <div style="background: #e8f5e9; color: #2e7d32; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
        {{ session('success') }}
    </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--gray-light); text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Nama</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Email</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Tanggal</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Pesan</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e0e0e0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 1rem;"><strong>{{ $contact->name }}</strong></td>
                    <td style="padding: 1rem;">{{ $contact->email }}</td>
                    <td style="padding: 1rem;">
                        <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.85rem; font-weight: 600; {{ $contact->is_guest ? 'background: #fff3e0; color: #e65100;' : 'background: #e8f5e9; color: #2e7d32;' }}">
                            {{ $contact->is_guest ? 'Guest' : 'Member' }}
                        </span>
                    </td>
                    <td style="padding: 1rem;">{{ $contact->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 1rem;">{{ Str::limit($contact->message, 50) }}</td>
                    <td style="padding: 1rem; display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" style="background: var(--primary-blue); color: white; padding: 0.4rem 0.8rem; border-radius: 5px; text-decoration: none; font-size: 0.9rem;">Buka</a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: var(--primary-red); color: white; padding: 0.4rem 0.8rem; border: none; border-radius: 5px; cursor: pointer; font-size: 0.9rem;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 3rem; text-align: center; color: #999;">Tidak ada pesan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
