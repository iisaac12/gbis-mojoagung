@extends('layouts.admin')

@section('title', 'Detail Pesan - Admin')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <a href="{{ route('admin.contacts.index') }}" style="color: var(--primary-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; font-weight: 600; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(-5px)'" onmouseout="this.style.transform='translateX(0)'">
        <span></span> Kembali ke Daftar Pesan
    </a>

    @if(session('success'))
    <div style="background: #e8f5e9; color: #2e7d32; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; text-align: center; border: 1px solid #c8e6c9;">
        {{ session('success') }}
    </div>
    @endif

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

        <div style="margin-bottom: 2.5rem;">
            <p style="font-weight: 600; color: #555; margin-bottom: 0.8rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em;">Pesan:</p>
            <div style="line-height: 1.8; color: #333; font-size: 1.05rem; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word; background: #fcfcfc; padding: 2rem; border-radius: 12px; border: 1px solid #f0f0f0; max-height: 500px; overflow-y: auto;">
                {{ $contact->message }}
            </div>
        </div>

        @if($contact->reply_message)
        <div style="margin-top: 2.5rem; padding-top: 2.5rem; border-top: 2px dashed #eee;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <p style="font-weight: 600; color: var(--primary-blue); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em;">Balasan Admin:</p>
                <p style="color: #999; font-size: 0.8rem;">Dikirim pada: {{ \Carbon\Carbon::parse($contact->replied_at)->isoFormat('D MMMM Y HH:mm') }}</p>
            </div>
            <div style="line-height: 1.8; color: #555; font-size: 1rem; white-space: pre-wrap; word-break: break-word; background: #f0f7ff; padding: 2rem; border-radius: 12px; border: 1px solid #e0eefb;">
                {{ $contact->reply_message }}
            </div>
        </div>
        @else
        <div style="margin-top: 2.5rem; padding-top: 2.5rem; border-top: 2px solid #f0f0f0;">
            <p style="font-weight: 600; color: #555; margin-bottom: 1rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em;">Balas Pesan:</p>
            <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                @csrf
                <textarea name="reply_message" style="width: 100%; min-height: 200px; padding: 1.5rem; border-radius: 12px; border: 2px solid #eee; font-family: inherit; font-size: 1rem; margin-bottom: 1.5rem; transition: border-color 0.3s; focus: outline-none;" placeholder="Tulis balasan Anda di sini..." onfocus="this.style.borderColor='var(--primary-blue)'" onblur="this.style.borderColor='#eee'" required></textarea>
                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="submit" style="background: var(--primary-blue); color: white; padding: 0.8rem 2.5rem; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-2px)'" onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'">Kirim Balasan via Email</button>
                </div>
            </form>
        </div>
        @endif

        <div style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid #eee;">
            <div style="background: #fff5f5; border: 1px solid #feb2b2; padding: 1.5rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <div>
                    <h4 style="color: #c53030; margin: 0 0 0.25rem 0; font-size: 1rem;">Zona Berbahaya</h4>
                    <p style="color: #9b2c2c; margin: 0; font-size: 0.85rem;">Menghapus pesan ini akan menghilangkan seluruh riwayat percakapan secara permanen.</p>
                </div>
                <form id="deleteContactForm" action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="showDeleteModal('deleteContactForm', 'Menghapus pesan ini akan menghilangkan seluruh riwayat percakapan secara permanen.')" style="background: #c53030; color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;" onmouseover="this.style.background='#9b2c2c'" onmouseout="this.style.background='#c53030'">Hapus Pesan Permanen</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
