@extends('layout.app')

@section('title', 'Detail Profil - Abadi Airlines')

@section('content')
<main class="profile-container">
    <h1>Detail Profil Anda</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 30px;">Kelola informasi pribadi dan foto profil Anda.</p>

    <div class="profile-card">
        <div class="profile-avatar-section">
            <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/default_profile.png') }}" alt="Foto Profil" class="profile-avatar" id="profile-preview">
            <br>

            <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" id="photo-upload-form">
        @csrf
            <label for="profile_photo" class="upload-btn">
            <i class="fas fa-camera"></i> Ganti Foto
            </label>
            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display: none;">
            <button type="submit" id="submit-photo-btn" style="display:none;">Upload</button>
            </form>
    
             <p class="profile-name-display">{{ $user->name }}</p>
            <p class="profile-email-display">{{ $user->email }}</p>
        </div>

        <div class="profile-details-section">
            <div class="detail-group">
                <span class="detail-label">Nama Lengkap:</span>
                <span class="detail-value">{{ $user->name }}</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $user->email }}</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Bergabung Sejak:</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</span>
            </div>
            {{-- Anda bisa menambahkan lebih banyak detail di sini, misalnya NIK, Nomor Telepon, dll. jika ada di tabel users --}}
        </div>

        <div class="profile-actions">
            {{-- Tombol Edit Profil akan membutuhkan form dan route POST untuk update --}}
            {{-- <a href="#" class="button edit-profile-btn">Edit Profil</a> --}}
            <a style="background-color: #ffd54f;color:black;" href="/dashboard" class="button back-to-dashboard-btn">Kembali ke Dashboard</a>
        </div>
    </div>
</main>

<style>
    .profile-container {
        max-width: 600px;
        margin: 2rem auto;
        background: rgba(0, 0, 0, 0.7);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        text-align: center;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profile-avatar-section {
        margin-bottom: 25px;
        text-align: center;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffd54f;
        box-shadow: 0 0 15px rgba(255, 213, 79, 0.4);
        margin-bottom: 15px;
    }

    .upload-btn {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #0056b3;
    }

    .profile-name-display {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffd54f;
        margin-top: 15px;
        margin-bottom: 5px;
    }

    .profile-email-display {
        font-size: 1rem;
        color: #e0e7ff;
    }

    .profile-details-section {
        width: 100%;
        text-align: left;
        margin-top: 20px;
    }

    .detail-group {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.15);
        font-size: 1.05rem;
    }

    .detail-group:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 500;
        color: #e0e7ff;
    }

    .detail-value {
        color: #fff;
        text-align: right;
    }

    .profile-actions {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .profile-actions .button {
        width: auto;
        padding: 12px 30px;
    }

    .edit-profile-btn {
        background-color: #28a745;
    }

    .edit-profile-btn:hover {
        background-color: #218838;
    }

    .back-to-dashboard-btn {
        background-color: #555;
    }

    .back-to-dashboard-btn:hover {
        background-color: #333;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePhotoInput = document.getElementById('profile_photo');
        const profilePreview = document.getElementById('profile-preview');
        const photoUploadForm = document.getElementById('photo-upload-form');


        if (profilePhotoInput) {
            profilePhotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    photoUploadForm.submit();

                    // You would typically submit this file to the server using FormData and fetch/axios
                    // Example (requires backend endpoint to handle upload):
                    // const formData = new FormData();
                    // formData.append('profile_photo', file);
                    // fetch('/profile/upload-photo', {
                    //     method: 'POST',
                    //     headers: {
                    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // If you have CSRF token
                    //     },
                    //     body: formData
                    // }).then(response => response.json())
                    //   .then(data => {
                    //       if (data.success) {
                    //           alert('Foto profil berhasil diunggah!');
                    //       } else {
                    //           alert('Gagal mengunggah foto profil.');
                    //       }
                    //   })
                    //   .catch(error => {
                    //       console.error('Error uploading photo:', error);
                    //       alert('Terjadi kesalahan saat mengunggah foto.');
                    //   });
                }
            });
        }
    });
</script>
@endsection