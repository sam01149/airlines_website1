@extends('layout.app')

@section('title', 'Pesan Tiket Pesawat - Abadi Airlines')

@section('content')
<main class="form-container" style="max-width: 700px;">
    <h1>Pesan Tiket Pesawat</h1>

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert-message success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/proses-pemesanan" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
        </div>

       <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="number" id="NIK" name="NIK" value="{{ old('NIK') }}" required />
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="lokasi_keberangkatan">Lokasi Keberangkatan:</label>
            <select id="lokasi_keberangkatan" name="lokasi_keberangkatan" required onchange="updatePrice()">
                <option value="">Pilih Lokasi Keberangkatan</option>
                @foreach($provinsiNama as $nama)
                    <option value="{{ $nama }}" {{ old('lokasi_keberangkatan') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tujuan_penerbangan">Tujuan Penerbangan:</label>
            <select id="tujuan_penerbangan" name="tujuan_penerbangan" required onchange="updatePrice()">
                <option value="">Pilih Tujuan Penerbangan</option>
                @foreach($provinsiNama as $nama)
                    <option value="{{ $nama }}" {{ old('tujuan_penerbangan') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_pemesanan">Tanggal Penerbangan:</label>
            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ old('tanggal_pemesanan') }}" required>
        </div>

        <div class="form-group">
            <label for="referral_code">Kode Referral (Opsional):</label>
            <input type="text" id="referral_code" name="referral_code" value="{{ old('referral_code') }}" onkeyup="updatePrice()">
            <small style="color: #bbb; display: block; margin-top: 5px;">Masukkan kode diskon jika ada.</small>
        </div>

        <div class="price-display form-group" style="background-color: rgba(255, 255, 255, 0.15); padding: 15px; border-radius: 8px; text-align: center; font-size: 1.2rem; font-weight: 600; color: #ffd54f; margin-bottom: 20px;">
            Harga Tiket: <span id="harga_tampil">Rp 0</span>
        </div>

        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar (Rupiah):</label>
            <input type="number" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" min="0" required>
        </div>

        <button type="submit" class="form-submit-button">Bayar dan Pesan Tiket</button>
    </form>
</main>

<script>
    const provinsiData = {
        'DKI Jakarta': 0,
        'Jawa Barat': 1,
        'Jawa Tengah': 2,
        'Jawa Timur': 3,
        'Bali': 4,
        'Sumatera Utara': 5,
        'Sulawesi Selatan': 6,
        'Papua': 7,
    };

    const hargaPerUnitJarak = 250000;
    const hargaDasar = 500000;

    async function calculatePriceWithDiscount(lokasiKeberangkatan, tujuanPenerbangan, referralCode = null) {
        if (!provinsiData.hasOwnProperty(lokasiKeberangkatan) || !provinsiData.hasOwnProperty(tujuanPenerbangan)) {
            return 0;
        }

        const jarakKeberangkatan = provinsiData[lokasiKeberangkatan];
        const jarakTujuan = provinsiData[tujuanPenerbangan];

        const selisihJarak = Math.abs(jarakTujuan - jarakKeberangkatan);

        let basePrice = hargaDasar + (selisihJarak * hargaPerUnitJarak);

        if (referralCode) {
            try {
                const response = await fetch('/api/check-voucher?code=' + referralCode);
                const data = await response.json();
                if (data.is_valid) {
                    const discountAmount = basePrice * (data.discount_percentage / 100);
                    basePrice -= discountAmount;
                }
            } catch (error) {
                console.error('Error fetching voucher data:', error);
            }
        }
        return basePrice;
    }

    async function updatePrice() {
        const lokasiKeberangkatan = document.getElementById('lokasi_keberangkatan').value;
        const tujuanPenerbangan = document.getElementById('tujuan_penerbangan').value;
        const referralCode = document.getElementById('referral_code').value;
        const hargaTampil = document.getElementById('harga_tampil');

        if (lokasiKeberangkatan && tujuanPenerbangan) {
            const harga = await calculatePriceWithDiscount(lokasiKeberangkatan, tujuanPenerbangan, referralCode);
            hargaTampil.innerText = 'Rp ' + harga.toLocaleString('id-ID');
        } else {
            hargaTampil.innerText = 'Rp 0';
        }
    }

    document.addEventListener('DOMContentLoaded', updatePrice);
</script>
@endsection