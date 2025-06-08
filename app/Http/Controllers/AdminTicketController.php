<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananTiket;
use App\Models\User; // Jika perlu melihat detail user yang memesan
use Illuminate\Support\Facades\Hash; // Untuk update password user jika perlu

class AdminTicketController extends Controller
{
    // Menampilkan daftar semua tiket
    public function index()
    {
        $tickets = PemesananTiket::orderBy('tanggal_pemesanan', 'desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    // Menampilkan form edit tiket
    public function edit(PemesananTiket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    // Memperbarui tiket
    public function update(Request $request, PemesananTiket $ticket)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'NIK' => 'required|string|unique:pemesanan_tiket,NIK,' . $ticket->id,
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tujuan_penerbangan' => 'required|string',
            'lokasi_keberangkatan' => 'required|string',
            'harga_tiket' => 'required|numeric',
            'tanggal_pemesanan' => 'required|date',
            'status' => 'required|in:belum check-in,checked-in',
            'seat_number' => 'nullable|string|max:10',
        ]);

        $ticket->update($request->all());

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui!');
    }

    // Menghapus tiket
    public function destroy(PemesananTiket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}