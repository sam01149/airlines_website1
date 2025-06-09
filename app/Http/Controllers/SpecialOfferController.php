<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Str;

class SpecialOfferController extends Controller
{
    // (Method 'index' untuk user tidak perlu diubah)
    public function index()
    {
        $vouchers = Voucher::where('is_active', true)->orderBy('discount_percentage', 'desc')->get();
        return view('fitur.special_offers', compact('vouchers'));
    }

    // == ADMIN METHODS ==

    // [BARU] Method untuk menampilkan semua voucher di halaman admin
    public function adminIndex()
    {
        $vouchers = Voucher::orderBy('created_at', 'desc')->get(); // Ambil semua voucher
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:20',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'), // Checkbox is_active
        ]);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil ditambahkan!');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code,' . $voucher->id . '|max:20',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        $voucher->update([
            'code' => strtoupper($request->code),
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}