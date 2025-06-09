<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PesanTiketController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialOfferController; // Import SpecialOfferController
use App\Http\Controllers\AdminTicketController;  // Import AdminTicketController
use App\Http\Controllers\AdminMemberController;  // Import AdminMemberController
use App\Models\Voucher; // Import Voucher model
use Illuminate\Http\Request; // Import Request class

// Rute Publik (tidak memerlukan autentikasi)
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/admin', 'admin@index');
// Tambahkan di luar grup autentikasi (karena biasanya publik)
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Rute Autentikasi
Route::get('/sesi', [UserController::class, 'index'])->name('login'); // Beri nama rute login
Route::post('/sesi/login', [UserController::class, 'login']);
Route::get('/sesi/signup', [UserController::class, 'signup']);
Route::post('/sesi/create', [UserController::class, 'create']);

// Rute untuk Halaman Kontak dan FAQ (biasanya publik)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    return view('fitur.faq');
})->name('faq');

// Rute yang memerlukan autentikasi (untuk pengguna yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sesi/logout', [UserController::class, 'logout'])->name('logout'); // Hanya bisa diakses jika sudah login

    // Rute untuk pemesanan tiket
    Route::get('/pesan-tiket', [PesanTiketController::class, 'index'])->name('pesan.tiket');
    Route::post('/proses-pemesanan', [PesanTiketController::class, 'prosesPemesanan'])->name('proses.pemesanan');

    // Rute untuk Check-in
    Route::get('/check-in-list', [CheckinController::class, 'index'])->name('checkin.list');
    Route::get('/check-in/{id}/detail', [CheckinController::class, 'showTicketDetail'])->name('checkin.detail');
    Route::get('/check-in/{id}/seat-selection', [CheckinController::class, 'showSeatSelection'])->name('checkin.seat_selection');
    Route::post('/check-in/{id}/process', [CheckinController::class, 'processCheckin'])->name('checkin.process');

    // Rute untuk Tiket Saya (Riwayat Pemesanan)
    Route::get('/my-tickets', [CheckinController::class, 'myTickets'])->name('my.tickets');
    Route::get('/ticket/{id}/detail', [CheckinController::class, 'showTicketDetail'])->name('ticket.detail');

    // Rute untuk Penawaran Spesial (bisa diakses semua pengguna yang login)
    Route::get('/special-offers', [SpecialOfferController::class, 'index'])->name('special_offers.index');

    // Rute untuk Detail Profil
    Route::get('/profile-detail', [ProfileController::class, 'showProfile'])->name('profile.detail');
    Route::post('/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');


    // API untuk memeriksa voucher (bisa diakses semua pengguna yang login)
    Route::get('/api/check-voucher', function (Request $request) {
        $code = $request->query('code');
        $voucher = Voucher::where('code', $code)
                           ->where('is_active', true)
                           ->first();

        if ($voucher) {
            return response()->json(['is_valid' => true, 'discount_percentage' => $voucher->discount_percentage]);
        } else {
            return response()->json(['is_valid' => false]);
        }
    });

    // Rute khusus admin (terproteksi oleh middleware 'admin')
    Route::middleware(['admin'])->group(function () {
        // Rute Admin untuk Tiket
        Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/admin/tickets/{ticket}/edit', [AdminTicketController::class, 'edit'])->name('admin.tickets.edit');
        Route::put('/admin/tickets/{ticket}', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
        Route::delete('/admin/tickets/{ticket}', [AdminTicketController::class, 'destroy'])->name('admin.tickets.destroy');

        // Rute Admin untuk Voucher
        // Ganti 'index' menjadi 'adminIndex'
        Route::get('/admin/vouchers', [SpecialOfferController::class, 'adminIndex'])->name('admin.vouchers.index'); // Admin bisa melihat semua voucher, aktif/tidak aktif
        Route::get('/admin/vouchers/create', [SpecialOfferController::class, 'create'])->name('admin.vouchers.create');
        Route::post('/admin/vouchers', [SpecialOfferController::class, 'store'])->name('admin.vouchers.store');
        Route::get('/admin/vouchers/{voucher}/edit', [SpecialOfferController::class, 'edit'])->name('admin.vouchers.edit');
        Route::put('/admin/vouchers/{voucher}', [SpecialOfferController::class, 'update'])->name('admin.vouchers.update');
        Route::delete('/admin/vouchers/{voucher}', [SpecialOfferController::class, 'destroy'])->name('admin.vouchers.destroy');

        // Rute Admin untuk Anggota
        Route::get('/admin/members', [AdminMemberController::class, 'index'])->name('admin.members.index');
        Route::get('/admin/members/{member}/edit', [AdminMemberController::class, 'edit'])->name('admin.members.edit');
        Route::put('/admin/members/{member}', [AdminMemberController::class, 'update'])->name('admin.members.update');
        Route::delete('/admin/members/{member}', [AdminMemberController::class, 'destroy'])->name('admin.members.destroy');

        // Rute Admin lama untuk daftar member (jika masih diperlukan)
        Route::get('/member', [MemberController::class, 'index'])->name('member.list');
        Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    });
});