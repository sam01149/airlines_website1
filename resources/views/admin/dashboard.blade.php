@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<main class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Selamat datang, Admin {{ Auth::user()->name }}. Kelola sistem dari sini.</p>

    <div class="features-grid">
        <div class="feature-card">
            <h2>Kelola Anggota</h2>
            <p>Lihat, edit, atau hapus data anggota yang terdaftar di sistem.</p>
            <a href="{{ route('admin.members.index') }}" class="button">Kelola Anggota</a>
        </div>

        <div class="feature-card">
            <h2>Kelola Tiket</h2>
            <p>Lihat, edit, atau hapus semua tiket yang dipesan oleh pengguna.</p>
            <a href="{{ route('admin.tickets.index') }}" class="button">Kelola Tiket</a>
        </div>

        <div class="feature-card">
            <h2>Kelola Voucher</h2>
            <p>Tambah, edit, atau nonaktifkan voucher diskon untuk promosi.</p>
            <a href="{{ route('admin.vouchers.index') }}" class="button">Kelola Voucher</a>
        </div>
    </div>
</main>
@endsection