@extends('layout.app')

@section('title', 'Hubungi Kami - Abadi Airlines')

@section('content')
<main class="contact-container">
    <h1>Hubungi Kami</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 30px;">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau butuh bantuan.</p>

    <div class="contact-info-grid">
        <div class="contact-card">
            <i class="fas fa-user contact-icon"></i>
            <h2>Nama</h2>
            <p>Samuel</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-envelope contact-icon"></i>
            <h2>Email</h2>
            <p><a href="mailto:samuelarmando93@gmail.com" class="link-text">samuelarmando93@gmail.com</a></p>
        </div>
        <div class="contact-card">
            <i class="fas fa-phone contact-icon"></i>
            <h2>Nomor Telepon</h2>
            <p><a href="tel:+6281260592450" class="link-text">081260592450</a></p>
        </div>
        <div class="contact-card">
            <i class="fab fa-instagram contact-icon"></i>
            <h2>Instagram</h2>
            <p><a href="https://www.instagram.com/samuel_armando_0_/" target="_blank" class="link-text">@samuel_armando_0_</a></p>
        </div>
        <div class="contact-card">
            <i class="fab fa-github contact-icon"></i>
            <h2>GitHub</h2>
            <p><a href="https://github.com/sam01149" target="_blank" class="link-text">sam01149</a></p>
        </div>
        <div class="contact-card address-card">
            <i class="fas fa-map-marker-alt contact-icon"></i>
            <h2>Alamat</h2>
            <p>Jl. Sawah Lunto No.46, Ps. Manggis, Kecamatan Setiabudi, Jakarta, Daerah Khusus Ibukota Jakarta 12979</p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="/dashboard" class="button" style="background-color: #ffd54f;color:black; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
    </div>
</main>

<style>
    .contact-container {
        max-width: 1000px;
        margin: 2rem auto;
        background: rgba(0, 0, 0, 0.7);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
    }

    .contact-container h1 {
        font-size: 2.5rem;
        color: #ffd54f;
        margin-bottom: 2rem;
        text-align: center;
    }

    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 1.8rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .contact-card .contact-icon {
        font-size: 3rem;
        color: #ffd54f;
        margin-bottom: 15px;
    }

    .contact-card h2 {
        font-size: 1.4rem;
        color: #fff;
        margin-bottom: 10px;
    }

    .contact-card p {
        color: #e0e7ff;
        font-size: 1rem;
        word-break: break-word; /* Memastikan teks panjang tidak keluar kotak */
    }

    .contact-card p .link-text {
        font-weight: normal; /* Override default link-text bold */
    }

    .address-card {
        grid-column: span 1; /* Make it take full width on smaller screens if needed */
        text-align: center;
    }

    @media (min-width: 768px) {
        .address-card {
            grid-column: span 2; /* Take 2 columns on larger screens */
        }
    }
</style>
@endsection