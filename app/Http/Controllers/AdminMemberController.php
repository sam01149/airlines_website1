<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Mengelola model User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminMemberController extends Controller
{
    // Menampilkan daftar semua anggota
    public function index()
    {
        $members = User::all();
        return view('admin.members.index', compact('members'));
    }

    // Menampilkan form edit anggota
    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    // Memperbarui anggota
    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->id,
            'password' => 'nullable|min:6', // Password opsional, hanya diisi jika ingin diubah
            'profile_photo_path' => 'nullable|string|max:2048', // Tambahkan validasi untuk path foto
        ]);

        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->filled('profile_photo_path')) {
            $data['profile_photo_path'] = $request->profile_photo_path; // Ini hanya untuk path manual, untuk upload file perlu logic lebih lanjut
        }


        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // Menghapus anggota
    public function destroy(User $member)
    {
        if ($member->id == Auth::id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun Anda sendiri.']);
        }
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}