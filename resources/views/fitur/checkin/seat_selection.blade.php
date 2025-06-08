@extends('layout.app')

@section('title', 'Pilih Kursi Anda')

@section('content')
<main class="form-container" style="max-width: 800px;">
    <h1>Pilih Kursi Anda</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 20px;">Pilih kursi yang tersedia. Kursi abu-abu sudah terisi.</p>

    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="seat-map-container">
        <div class="airplane-wing left-wing"></div>
        <div class="airplane-fuselage">
            <div class="row-label-container">
                @php
                    $totalRows = 10; // Sesuaikan dengan controller
                    $seatsPerRow = ['A', 'B', 'C', 'D', 'E', 'F']; // Sesuaikan dengan controller
                @endphp
                @for ($row = 1; $row <= $totalRows; $row++)
                    <div class="row-label">{{ $row }}</div>
                @endfor
            </div>
            <div class="seat-grid">
                @foreach ($seats as $seatName => $isReserved)
                    <div class="seat-item {{ $isReserved ? 'reserved' : 'available' }}" data-seat="{{ $seatName }}">
                        {{ $seatName }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="airplane-wing right-wing"></div>
    </div>

    <form action="{{ route('checkin.process', $ticket->id) }}" method="POST" id="checkin-form">
        @csrf
        <div class="form-group" style="margin-top: 30px;">
            <label for="selected_seat">Kursi Terpilih:</label>
            <input type="text" id="selected_seat" name="seat_number" readonly required placeholder="Klik kursi di atas">
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="agreement" name="agreement" value="1" required>
            <label for="agreement" style="display: inline; margin-left: 10px;">Saya telah membaca dan menyetujui <a href="#" class="link-text">perjanjian pembayaran</a>.</label>
        </div>

        <button type="submit" class="form-submit-button">Next (Lanjutkan Check-in)</button>
    </form>
</main>

<style>
    .seat-map-container {
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 30px;
        margin-top: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow-x: auto;
    }

    .airplane-fuselage {
        display: flex;
        border: 2px solid #555;
        border-radius: 15px;
        padding: 15px;
        background-color: rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .row-label-container {
        display: flex;
        flex-direction: column;
        gap: 10px; /* Adjust based on seat-grid gap */
        margin-right: 15px;
        padding-top: 10px; /* Align with seats */
    }

    .row-label {
        font-weight: bold;
        color: #ffd54f;
        width: 30px;
        text-align: right;
        line-height: 40px; /* Match seat item height */
    }

    .seat-grid {
        display: grid;
        grid-template-columns: repeat(6, 50px); /* 6 columns (A-F), 50px width */
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    .seat-item {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        user-select: none;
    }

    .seat-item.available {
        background-color: #6bff6b;
        color: #333;
    }

    .seat-item.available:hover {
        background-color: #4CAF50;
        transform: scale(1.05);
    }

    .seat-item.reserved {
        background-color: #888;
        color: #ccc;
        cursor: not-allowed;
    }

    .seat-item.selected {
        background-color: #ffd54f;
        color: #333;
        border: 2px solid #fff;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .checkbox-group input[type="checkbox"] {
        width: auto;
        margin-right: 10px;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .seat-grid {
            grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));
            gap: 8px;
        }
        .seat-item {
            width: 40px;
            height: 40px;
            font-size: 0.85rem;
        }
        .row-label {
            line-height: 40px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const seatItems = document.querySelectorAll('.seat-item.available');
        const selectedSeatInput = document.getElementById('selected_seat');
        let currentSelectedSeat = null;

        seatItems.forEach(seat => {
            seat.addEventListener('click', () => {
                if (seat.classList.contains('available')) {
                    // Remove previous selection
                    if (currentSelectedSeat) {
                        currentSelectedSeat.classList.remove('selected');
                    }

                    // Add new selection
                    seat.classList.add('selected');
                    selectedSeatInput.value = seat.dataset.seat;
                    currentSelectedSeat = seat;
                }
            });
        });
    });
</script>
@endsection