<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananTiket;
use App\Models\Voucher; // Tambahkan ini
use Illuminate\Support\Facades\Auth;

class PesanTiketController extends Controller
{
    private $provinsiData = [
        'DKI Jakarta' => 0,
        'Jawa Barat' => 1,
        'Jawa Tengah' => 2,
        'Jawa Timur' => 3,
        'Bali' => 4,
        'Sumatera Utara' => 5,
        'Sulawesi Selatan' => 6,
        'Papua' => 7,
    ];

    private $hargaPerUnitJarak = 250000;
    private $hargaDasar = 500000;

    function calculateTicketPrice($lokasi_keberangkatan, $tujuan_penerbangan, $referral_code = null)
    {
        if (!isset($this->provinsiData[$lokasi_keberangkatan]) || !isset($this->provinsiData[$tujuan_penerbangan])) {
            return 0;
        }

        $jarakKeberangkatan = $this->provinsiData[$lokasi_keberangkatan];
        $jarakTujuan = $this->provinsiData[$tujuan_penerbangan];

        $selisihJarak = abs($jarakTujuan - $jarakKeberangkatan);

        $basePrice = $this->hargaDasar + ($selisihJarak * $this->hargaPerUnitJarak);

        // Terapkan diskon jika ada kode referral yang valid
        if ($referral_code) {
            $voucher = Voucher::where('code', $referral_code)
                               ->where('is_active', true)
                               ->first();

            if ($voucher) {
                $discountAmount = $basePrice * ($voucher->discount_percentage / 100);
                $basePrice -= $discountAmount;
            }
        }

        return $basePrice;
    }

    public function index()
    {
        $provinsiNama = array_keys($this->provinsiData);
        return view('fitur.pesantiket', compact('provinsiNama'));
    }

    public function prosesPemesanan(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'NIK' => 'required|string|unique:pemesanan_tiket,NIK',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tujuan_penerbangan' => 'required|string',
            'lokasi_keberangkatan' => 'required|string',
            'tanggal_pemesanan' => 'required|date|after_or_equal:today',
            'jumlah_bayar' => 'required|numeric',
            'referral_code' => 'nullable|string|max:20', // Tambahkan validasi untuk kode referral
        ], [
            'NIK.unique' => 'NIK sudah digunakan untuk pemesanan tiket lain.',
            'tanggal_pemesanan.after_or_equal' => 'Tanggal penerbangan tidak bisa di masa lalu.',
        ]);

        $lokasi_keberangkatan = $request->lokasi_keberangkatan;
        $tujuan_penerbangan = $request->tujuan_penerbangan;
        $referral_code = $request->referral_code;

        $harga_tiket = $this->calculateTicketPrice($lokasi_keberangkatan, $tujuan_penerbangan, $referral_code);

        if ($request->jumlah_bayar < $harga_tiket) {
            return back()->withErrors(['pembayaran' => 'Jumlah pembayaran kurang dari harga tiket. Harga tiket adalah Rp ' . number_format($harga_tiket, 0, ',', '.') . '.'])->withInput();
        }

        if (!Auth::check()) {
            return back()->withErrors(['auth' => 'Anda harus login untuk memesan tiket.'])->withInput();
        }

        PemesananTiket::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'NIK' => $request->NIK,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tujuan_penerbangan' => $tujuan_penerbangan,
            'lokasi_keberangkatan' => $lokasi_keberangkatan,
            'harga_tiket' => $harga_tiket,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'status' => 'belum check-in',
            'seat_number' => null,
        ]);

        return redirect('/my-tickets')->with('success', 'Tiket Anda berhasil dibeli dan sedang menunggu check-in! Harga tiket: Rp ' . number_format($harga_tiket, 0, ',', '.'));
    }
}