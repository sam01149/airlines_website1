@extends('layout.app')

@section('title', 'Admin - Kelola Tiket')

@section('content')
<main class="dashboard-container" style="max-width: 1000px;">
    <h1>Kelola Tiket Pengguna</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Lihat, edit, atau hapus tiket yang dipesan pengguna.</p>

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

    @if ($tickets->isEmpty())
        <div class="alert-message success">
            Belum ada tiket yang dipesan oleh pengguna.
        </div>
    @else
        <div class="table-responsive">
            <table class="member-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Rute</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Kursi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->nama_lengkap }}</td>
                            <td>{{ $ticket->NIK }}</td>
                            <td>{{ $ticket->lokasi_keberangkatan }} <i class="fas fa-arrow-right"></i> {{ $ticket->tujuan_penerbangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('d M Y') }}</td>
                            <td>Rp {{ number_format($ticket->harga_tiket, 0, ',', '.') }}</td>
                            <td><span class="ticket-status status-{{ Str::slug($ticket->status) }}">{{ $ticket->status }}</span></td>
                            <td>{{ $ticket->seat_number ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="button small-button" style="background-color: #007bff;">Edit</a>
                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small-button" style="background-color: #dc3545;" onclick="return confirm('Anda yakin ingin menghapus tiket ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div style="text-align: center; margin-top: 30px;">
        <a href="/dashboard" class="button" style="background-color: #555; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
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