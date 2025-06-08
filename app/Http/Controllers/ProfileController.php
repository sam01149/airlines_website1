<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('fitur.profile_detail', compact('user'));
    }

    // TAMBAHKAN METODE BARU INI
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Simpan foto baru dan dapatkan path-nya
        $path = $request->file('profile_photo')->store('profile-photos', 'public');

        // Update path di database
        $user->update(['profile_photo_path' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}