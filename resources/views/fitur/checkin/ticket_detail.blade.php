@extends('layout.app')

@section('title', 'Detail Tiket Penerbangan')

@section('content')
<main class="form-container" style="max-width: 700px;">
    <h1>Detail Tiket Anda</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 20px;">Pastikan detail di bawah ini sudah benar sebelum melanjutkan check-in.</p>

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="ticket-detail-card">
        <div class="detail-group">
            <span class="detail-label">Nama Lengkap:</span>
            <span class="detail-value">{{ $ticket->nama_lengkap }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">NIK:</span>
            <span class="detail-value">{{ $ticket->NIK }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Nomor Telepon:</span>
            <span class="detail-value">{{ $ticket->nomor_telepon }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Jenis Kelamin:</span>
            <span class="detail-value">{{ ucfirst($ticket->jenis_kelamin) }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Lokasi Keberangkatan:</span>
            <span class="detail-value">{{ $ticket->lokasi_keberangkatan }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Tujuan Penerbangan:</span>
            <span class="detail-value">{{ $ticket->tujuan_penerbangan }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Tanggal Penerbangan:</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('d F Y') }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Harga Tiket:</span>
            <span class="detail-value">Rp {{ number_format($ticket->harga_tiket, 0, ',', '.') }}</span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Status:</span>
            <span class="detail-value status-{{ Str::slug($ticket->status) }}">{{ $ticket->status }}</span>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('checkin.seat_selection', $ticket->id) }}" class="form-submit-button" style="width: auto; padding: 12px 30px;">Konfirmasi dan Lanjut Pemilihan Kursi</a>
        <a href="/check-in-list" class="button" style="background-color: #555; margin-left: 10px; width: auto; padding: 12px 30px;">Kembali</a>
    </div>
</main>

<style>
    .ticket-detail-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 25px;
        margin-top: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .detail-group {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.15);
        font-size: 1.05rem;
    }

    .detail-group:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 500;
        color: #e0e7ff;
    }

    .detail-value {
        color: #fff;
        text-align: right;
    }

    .status-belum-check-in {
        color: #ff6b6b;
        font-weight: bold;
    }

    .status-checked-in {
        color: #6bff6b;
        font-weight: bold;
    }
</style>
@endsection