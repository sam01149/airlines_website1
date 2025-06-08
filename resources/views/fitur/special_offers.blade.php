@extends('layout.app')

@section('title', 'Penawaran Spesial - Abadi Airlines')

@section('content')
<main class="offers-container">
    <h1>Penawaran Spesial</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 30px;">Dapatkan promo dan diskon menarik untuk penerbangan Anda!</p>

    @if (session('success'))
        <div class="alert-message success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($vouchers->isEmpty())
        <div class="alert-message success">
            Saat ini belum ada penawaran spesial yang tersedia.
        </div>
    @else
        <div class="voucher-grid">
            @foreach ($vouchers as $voucher)
                <div class="voucher-card" data-code="{{ $voucher->code }}">
                    <div class="voucher-header">
                        <h2>Diskon {{ number_format($voucher->discount_percentage, 0) }}%</h2>
                        <span class="voucher-status">{{ $voucher->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                    </div>
                    <div class="voucher-body">
                        <p>Gunakan kode ini saat memesan tiket untuk mendapatkan diskon.</p>
                        <p class="voucher-code-display" id="code-{{ $voucher->id }}">{{ $voucher->code }}</p>
                    </div>
                    <div class="voucher-footer">
                        <button class="button copy-code-btn" data-clipboard-target="#code-{{ $voucher->id }}">Salin Kode</button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div style="text-align: center; margin-top: 30px;">
        <a href="/dashboard" class="button" style="background-color: #555; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
    </div>
</main>

<style>
    .offers-container {
        max-width: 900px;
        margin: 2rem auto;
        background: rgba(0, 0, 0, 0.7);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
    }

    .offers-container h1 {
        font-size: 2.5rem;
        color: #ffd54f;
        margin-bottom: 2rem;
        text-align: center;
    }

    .voucher-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .voucher-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 1.8rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .voucher-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
    }

    .voucher-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .voucher-header h2 {
        font-size: 1.8rem;
        color: #ffd54f;
    }

    .voucher-status {
        background-color: #6bff6b;
        color: #333;
        padding: 0.4rem 0.8rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .voucher-body p {
        color: #e0e7ff;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .voucher-code-display {
        background-color: rgba(0, 0, 0, 0.4);
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        color: #fff;
        letter-spacing: 1px;
        text-align: center;
        user-select: all; /* Allow easy selection for copy */
    }

    .voucher-footer {
        margin-top: 1.5rem;
        text-align: center;
    }

    .voucher-footer .button {
        padding: 0.8rem 1.5rem;
        font-size: 0.95rem;
        border-radius: 25px;
        background-color: #007bff;
    }

    .voucher-footer .button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const copyButtons = document.querySelectorAll('.copy-code-btn');

        copyButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.dataset.clipboardTarget;
                const codeElement = document.querySelector(targetId);
                if (codeElement) {
                    const textToCopy = codeElement.innerText;
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        alert('Kode voucher "' + textToCopy + '" berhasil disalin!');
                    }).catch(err => {
                        console.error('Failed to copy text: ', err);
                    });
                }
            });
        });
    });
</script>
@endsection