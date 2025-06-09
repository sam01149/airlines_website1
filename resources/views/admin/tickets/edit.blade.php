    @extends('layout.app')

    @section('title', 'Admin - Edit Tiket')

    @section('content')
    <main class="form-container" style="max-width: 700px;">
        <h1>Edit Detail Tiket</h1>
        <p style="text-align: center; color: #e0e7ff; margin-bottom: 20px;">Perbarui informasi tiket penerbangan ini.</p>

        @if ($errors->any())
            <div class="alert-message error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Gunakan metode PUT untuk update --}}

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $ticket->nama_lengkap) }}" required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $ticket->nomor_telepon) }}" required>
            </div>

            <div class="form-group">
                <label for="NIK">NIK:</label>
                <input type="number" id="NIK" name="NIK" value="{{ old('NIK', $ticket->NIK) }}" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="laki-laki" {{ old('jenis_kelamin', $ticket->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('jenis_kelamin', $ticket->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lokasi_keberangkatan">Lokasi Keberangkatan:</label>
                <input type="text" id="lokasi_keberangkatan" name="lokasi_keberangkatan" value="{{ old('lokasi_keberangkatan', $ticket->lokasi_keberangkatan) }}" required>
                {{-- Jika Anda memiliki daftar provinsi tetap, ganti ini dengan select --}}
            </div>

            <div class="form-group">
                <label for="tujuan_penerbangan">Tujuan Penerbangan:</label>
                <input type="text" id="tujuan_penerbangan" name="tujuan_penerbangan" value="{{ old('tujuan_penerbangan', $ticket->tujuan_penerbangan) }}" required>
                {{-- Jika Anda memiliki daftar provinsi tetap, ganti ini dengan select --}}
            </div>

            <div class="form-group">
                <label for="tanggal_pemesanan">Tanggal Penerbangan:</label>
                <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ old('tanggal_pemesanan', \Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="harga_tiket">Harga Tiket:</label>
                <input type="number" step="0.01" id="harga_tiket" name="harga_tiket" value="{{ old('harga_tiket', $ticket->harga_tiket) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status Tiket:</label>
                <select id="status" name="status" required>
                    <option value="belum check-in" {{ old('status', $ticket->status) == 'belum check-in' ? 'selected' : '' }}>Belum Check-in</option>
                    <option value="checked-in" {{ old('status', $ticket->status) == 'checked-in' ? 'selected' : '' }}>Checked-in</option>
                </select>
            </div>

            <div class="form-group">
                <label for="seat_number">Nomor Kursi:</label>
                <input type="text" id="seat_number" name="seat_number" value="{{ old('seat_number', $ticket->seat_number) }}">
                <small style="color: #bbb; display: block; margin-top: 5px;">Biarkan kosong jika belum check-in.</small>
            </div>

            <button type="submit" class="form-submit-button">Perbarui Tiket</button>
            <a href="{{ route('admin.tickets.index') }}" class="button" style="background:rgb(220, 181, 66);border-radius:30px;color:black; width: auto; padding: 12px 30px; margin-top: 20px; display: block; text-align: center;">Kembali ke Daftar Tiket</a>
        </form>
    </main> 
    @endsection