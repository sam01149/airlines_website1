@extends('layout.app')

@section('title', 'Admin - Edit Anggota')

@section('content')
<main class="form-container" style="max-width: 600px;">
    <h1>Edit Detail Anggota</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 20px;">Perbarui informasi akun anggota ini.</p>

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Gunakan metode PUT untuk update --}}

        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin diubah):</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            <small style="color: #bbb; display: block; margin-top: 5px;">Isi jika Anda ingin mengubah password anggota.</small>
        </div>

        {{-- Jika Anda ingin mengizinkan admin mengelola path foto profil secara manual (misalnya mengosongkan atau mengatur URL) --}}
        {{-- Jika tidak, abaikan bagian ini atau terapkan sistem upload file yang lebih kompleks --}}
        <div class="form-group">
            <label for="profile_photo_path">Path Foto Profil (URL/Path Storage):</label>
            <input type="text" id="profile_photo_path" name="profile_photo_path" value="{{ old('profile_photo_path', $member->profile_photo_path) }}">
            <small style="color: #bbb; display: block; margin-top: 5px;">Untuk mengelola foto profil, Anda mungkin perlu sistem upload yang terpisah.</small>
        </div>

        <button type="submit" class="form-submit-button">Perbarui Anggota</button>
        <a href="{{ route('admin.members.index') }}" class="button" style="background-color: #555; width: auto; padding: 12px 30px; margin-top: 20px; display: block; text-align: center;">Kembali ke Daftar Anggota</a>
    </form>
</main>
@endsection