<?php

namespace App\Http\Controllers;

// app/Http/Controllers/CheckinController.php

use Illuminate\Http\Request;
use App\Models\PemesananTiket;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    // Menampilkan daftar tiket yang belum check-in
    public function index()
    {
        $tickets = PemesananTiket::where('user_id', Auth::id())
                                ->where('status', 'belum check-in')
                                ->orderBy('tanggal_pemesanan', 'asc')
                                ->get();
        return view('fitur.checkin.checkin_list', compact('tickets'));
    }

    // Menampilkan detail tiket sebelum check-in
    public function showTicketDetail($id)
    {
        $ticket = PemesananTiket::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();
        
        return view('fitur.checkin.ticket_detail', compact('ticket'));
    }

    // Menampilkan form pemilihan kursi
    public function showSeatSelection($id)
    {
        $ticket = PemesananTiket::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();

        if ($ticket->status == 'checked-in') {
            return redirect('/my-tickets')->withErrors(['checkin_error' => 'Tiket ini sudah di-check-in.']);
        }

        // Contoh kursi yang sudah direservasi (bisa dari database lain atau dihitung dinamis)
        $reservedSeats = PemesananTiket::where('tanggal_pemesanan', $ticket->tanggal_pemesanan)
                                        ->where('lokasi_keberangkatan', $ticket->lokasi_keberangkatan)
                                        ->where('tujuan_penerbangan', $ticket->tujuan_penerbangan)
                                        ->whereNotNull('seat_number')
                                        ->pluck('seat_number')
                                        ->toArray();

        // Asumsi layout kursi (contoh sederhana)
        $totalRows = 10;
        $seatsPerRow = ['A', 'B', 'C', 'D', 'E', 'F'];
        $seats = [];
        for ($row = 1; $row <= $totalRows; $row++) {
            foreach ($seatsPerRow as $seatChar) {
                $seatName = $row . $seatChar;
                $seats[$seatName] = in_array($seatName, $reservedSeats); // true if reserved
            }
        }

        return view('fitur.checkin.seat_selection', compact('ticket', 'seats'));
    }

    // Proses check-in akhir
    public function processCheckin(Request $request, $id)
    {
        $request->validate([
            'seat_number' => 'required|string|max:10',
            'agreement' => 'accepted', // Pastikan checkbox dicentang
        ], [
            'agreement.accepted' => 'Anda harus menyetujui perjanjian pembayaran.',
        ]);

        $ticket = PemesananTiket::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();

        

        // Periksa apakah kursi sudah dipilih oleh orang lain (double check)
        $isSeatReserved = PemesananTiket::where('tanggal_pemesanan', $ticket->tanggal_pemesanan)
                                        ->where('lokasi_keberangkatan', $ticket->lokasi_keberangkatan)
                                        ->where('tujuan_penerbangan', $ticket->tujuan_penerbangan)
                                        ->where('seat_number', $request->seat_number)
                                        ->exists();
        if ($isSeatReserved) {
            return back()->withErrors(['seat_number' => 'Kursi ini sudah direservasi. Silakan pilih kursi lain.'])->withInput();
        }

        $ticket->update([
            'status' => 'checked-in',
            'seat_number' => $request->seat_number,
        ]);

        return redirect('/my-tickets')->with('success', 'Check-in berhasil! Kursi Anda: ' . $request->seat_number);
    }

    // Menampilkan semua tiket (history)
    public function myTickets()
    {
        $tickets = PemesananTiket::where('user_id', Auth::id())->orderBy('tanggal_pemesanan', 'desc')->get();
        return view('fitur.my_tickets', compact('tickets'));
    }
}