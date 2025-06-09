@extends('layout.app')

@section('title', 'Daftar Tiket untuk Check-in')

@section('content')
<main class="dashboard-container" style="max-width: 900px;">
    <h1>Tiket Tersedia untuk Check-in</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Pilih tiket yang ingin Anda check-in.</p>

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
            Anda tidak memiliki tiket yang menunggu check-in.
        </div>
    @else
        <div class="ticket-list-grid">
            @foreach ($tickets as $ticket)
                <div class="ticket-card">
                    <div class="ticket-header">
                        <h3>{{ $ticket->lokasi_keberangkatan }} <i class="fas fa-arrow-right"></i> {{ $ticket->tujuan_penerbangan }}</h3>
                        <span class="ticket-status status-{{ Str::slug($ticket->status) }}">{{ $ticket->status }}</span>
                    </div>
                    <div class="ticket-body">
                        <p><strong>Nama:</strong> {{ $ticket->nama_lengkap }}</p>
                        <p><strong>Tanggal Penerbangan:</strong> {{ \Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('d F Y') }}</p>
                        <p><strong>Harga:</strong> Rp {{ number_format($ticket->harga_tiket, 0, ',', '.') }}</p>
                        <p><strong>Nomor Telepon:</strong> {{ $ticket->nomor_telepon }}</p>
                    </div>
                    <div class="ticket-footer">
                        <a style="color:white"href="{{ route('checkin.detail', $ticket->id) }}" class="button">Check-in Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div style="text-align: center; margin-top: 30px;">
        <a href="/dashboard" class="button" style="background-color: #ffd54f;color:black; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
    </div>
</main>

<style>
    .ticket-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .ticket-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .ticket-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .ticket-header h3 {
        font-size: 1.5rem;
        color: #ffd54f;
    }

    .ticket-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .status-belum-check-in {
        background-color: #ff6b6b; /* Red */
        color: #fff;
    }

    .status-checked-in {
        background-color: #6bff6b; /* Green */
        color: #333;
    }

    .ticket-body p {
        margin-bottom: 0.8rem;
        color: #e0e7ff;
        font-size: 0.95rem;
    }

    .ticket-body p strong {
        color: #fff;
    }

    .ticket-footer {
        margin-top: 1.5rem;
        text-align: right;
    }

    .ticket-footer .button {
        padding: 0.8rem 1.5rem;
        font-size: 0.95rem;
        border-radius: 25px;
    }
</style>
@endsection