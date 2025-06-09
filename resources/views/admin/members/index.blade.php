@extends('layout.app')

@section('title', 'Admin - Kelola Anggota')

@section('content')
<main class="dashboard-container" style="max-width: 1000px;">
    <h1>Kelola Data Pengguna</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Lihat, edit, atau hapus data anggota terdaftar.</p>

    @if (session('success'))
        <div class="alert-message success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($members->isEmpty())
        <div class="alert-message success">
            Belum ada anggota terdaftar.
        </div>
    @else
        <div class="table-responsive">
            <table class="member-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($member->created_at)->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.members.edit', $member->id) }}" class="button small-button" style="background-color: #007bff;color:white;">Edit</a>
                                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small-button" style="background-color: #dc3545;" onclick="return confirm('Anda yakin ingin menghapus anggota ini? Ini akan menghapus semua tiket mereka juga!');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('admin.dashboard') }}" class="button"  style="background-color:rgb(220, 181, 66);border-radius:30px;color:black; width: auto; padding: 12px 30px;">Kembali ke Dashboard Admin</a>
    </div>
</main>
<style>
    /* Tambahkan gaya khusus untuk tabel admin jika diperlukan, atau gunakan yang sudah ada */
    .table-responsive {
        overflow-x: auto;
    }
    .small-button {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 20px;
        margin: 0 5px;
    }
</style>
@endsection