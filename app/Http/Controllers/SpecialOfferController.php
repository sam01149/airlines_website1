<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher; // Pastikan model Voucher sudah di-import
use Illuminate\Support\Str; // Untuk generate kode

class SpecialOfferController extends Controller
{
    // Menampilkan daftar voucher yang aktif
    public function index()
    {
        $vouchers = Voucher::where('is_active', true)->orderBy('discount_percentage', 'desc')->get();
        return view('fitur.special_offers', compact('vouchers'));
    }

    // Metode untuk menampilkan form tambah voucher (ADMIN ONLY)
    public function create()
    {
        return view('admin.vouchers.create'); // Anda perlu membuat view ini
    }

    // Metode untuk menyimpan voucher baru (ADMIN ONLY)
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:20',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'is_active' => 'boolean',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code), // Pastikan kode huruf besar
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('special_offers.index')->with('success', 'Voucher diskon berhasil ditambahkan!');
    }

    // Metode untuk menampilkan form edit voucher (ADMIN ONLY)
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher')); // Anda perlu membuat view ini
    }

    // Metode untuk update voucher (ADMIN ONLY)
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code,' . $voucher->id . '|max:20',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'is_active' => 'boolean',
        ]);

        $voucher->update([
            'code' => strtoupper($request->code),
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('special_offers.index')->with('success', 'Voucher diskon berhasil diperbarui!');
    }

    // Metode untuk menghapus voucher (ADMIN ONLY)
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('special_offers.index')->with('success', 'Voucher diskon berhasil dihapus!');
    }
}