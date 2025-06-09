@extends('layout.app')

@section('title', 'Bantuan & FAQ - Abadi Airlines')

@section('content')
<main class="faq-container">
    <h1>Bantuan & FAQ</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 30px;">Temukan jawaban atas pertanyaan umum Anda di sini.</p>

    <div class="faq-list">
        <div class="faq-item">
            <h2 class="faq-question">Bagaimana cara memesan tiket penerbangan?</h2>
            <div class="faq-answer">
                <p>Anda dapat memesan tiket dengan masuk ke akun Anda, lalu klik "Pesan Tiket" di dashboard. Isi detail penerbangan dan informasi pribadi Anda, lalu selesaikan pembayaran. Pastikan data yang Anda masukkan sudah benar.</p>
            </div>
        </div>

        <div class="faq-item">
            <h2 class="faq-question">Kapan saya bisa melakukan check-in online?</h2>
            <div class="faq-answer">
                <p>Check-in online biasanya tersedia 24 jam sebelum waktu keberangkatan dan ditutup beberapa jam sebelum keberangkatan. Anda bisa mengecek status tiket Anda di bagian "Check-in Online" atau "Tiket Saya".</p>
            </div>
        </div>

        <div class="faq-item">
            <h2 class="faq-question">Bisakah saya mengubah atau membatalkan tiket yang sudah dipesan?</h2>
            <div class="faq-answer">
                <p>Untuk saat ini, fitur perubahan atau pembatalan tiket belum tersedia melalui platform online kami. Mohon hubungi layanan pelanggan kami melalui informasi kontak di bagian "Contact" untuk bantuan lebih lanjut.</p>
            </div>
        </div>

        <div class="faq-item">
            <h2 class="faq-question">Bagaimana cara memilih kursi saat check-in?</h2>
            <div class="faq-answer">
                <p>Setelah Anda memulai proses check-in untuk tiket yang berlaku, Anda akan diarahkan ke halaman pemilihan kursi. Anda dapat memilih kursi yang tersedia (berwarna hijau) dari peta kursi pesawat.</p>
            </div>
        </div>

        <div class="faq-item">
            <h2 class="faq-question">Apa yang harus saya lakukan jika pembayaran tiket saya gagal?</h2>
            <div class="faq-answer">
                <p>Jika pembayaran Anda gagal, Anda dapat mencoba lagi atau memastikan saldo Anda mencukupi. Jika masalah terus berlanjut, hubungi bank atau penyedia layanan pembayaran Anda. Anda juga bisa menghubungi dukungan pelanggan kami.</p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="/dashboard" class="button" style="background-color: #ffd54f;color:black; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
    </div>
</main>

<style>
    .faq-container {
        max-width: 900px;
        margin: 2rem auto;
        background: rgba(0, 0, 0, 0.7);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
    }

    .faq-container h1 {
        font-size: 2.5rem;
        color: #ffd54f;
        margin-bottom: 2rem;
        text-align: center;
    }

    .faq-list {
        margin-top: 20px;
    }

    .faq-item {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        margin-bottom: 15px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .faq-question {
        font-size: 1.3rem;
        color: #fff;
        padding: 18px 25px;
        cursor: pointer;
        background-color: rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s ease;
    }

    .faq-question:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .faq-question::after {
        content: '+';
        font-size: 1.5rem;
        font-weight: bold;
        transition: transform 0.2s ease;
    }

    .faq-item.active .faq-question::after {
        transform: rotate(45deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding: 0 25px; /* Only apply horizontal padding initially */
    }

    .faq-item.active .faq-answer {
        max-height: 200px; /* Adjust as needed, should be larger than content */
        padding-bottom: 25px; /* Add bottom padding when active */
    }

    .faq-answer p {
        color: #e0e7ff;
        line-height: 1.6;
        padding-top: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.closest('.faq-item');
                faqItem.classList.toggle('active');
            });
        });
    });
</script>
@endsection