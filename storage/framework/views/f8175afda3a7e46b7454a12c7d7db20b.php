

<?php $__env->startSection('title', 'Tiket Saya - Abadi Airlines'); ?>

<?php $__env->startSection('content'); ?>
<main class="dashboard-container" style="max-width: 900px;">
    <h1>Tiket Saya</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Lihat semua tiket penerbangan Anda di sini.</p>

    <?php if(session('success')): ?>
        <div class="alert-message success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert-message error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($tickets->isEmpty()): ?>
        <div class="alert-message success">
            Anda belum memiliki tiket yang dipesan.
        </div>
    <?php else: ?>
        <div class="ticket-list-grid">
            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="ticket-card">
                    <div class="ticket-header">
                        <h3><?php echo e($ticket->lokasi_keberangkatan); ?> <i class="fas fa-arrow-right"></i> <?php echo e($ticket->tujuan_penerbangan); ?></h3>
                        <span class="ticket-status status-<?php echo e(Str::slug($ticket->status)); ?>"><?php echo e($ticket->status); ?></span>
                    </div>
                    <div class="ticket-body">
                        <p><strong>Nama:</strong> <?php echo e($ticket->nama_lengkap); ?></p>
                        <p><strong>Tanggal Penerbangan:</strong> <?php echo e(\Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('d F Y')); ?></p>
                        <p><strong>Harga:</strong> Rp <?php echo e(number_format($ticket->harga_tiket, 0, ',', '.')); ?></p>
                        <?php if($ticket->status == 'checked-in' && $ticket->seat_number): ?>
                            <p><strong>Kursi:</strong> <?php echo e($ticket->seat_number); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="ticket-footer"style="display:grid;justify-items:end;">
                        <a style="color:white; "href="<?php echo e(route('ticket.detail', $ticket->id)); ?>" class="button">Lihat Detail Tiket</a>

                        <?php if($ticket->status == 'belum check-in'): ?>
                        
                            <a href="<?php echo e(route('checkin.detail', $ticket->id)); ?>" class="button" style="background-color: #ffd54f;color:black;; margin-left: 10px;">Check-in</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 30px;">
        <a  href="/dashboard" class="button" style="background-color:rgb(220, 181, 66);color:black; width: auto; padding: 12px 30px;">Kembali ke Dashboard</a>
    </div>
</main>

<style>
    /* Gaya ini sama dengan di checkin_list.blade.php, bisa di masukkan ke main.css jika ingin */
    
    .ticket-list-grid {
        display: grid;
        
        gap: 25px;
        margin-top: 30px;
    }

    .ticket-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .ticket-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .ticket-header h3 {
        font-size: 1.5rem;
        color: #ffd54f;
    }

    .ticket-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .status-belum-check-in {
        background-color: #ff6b6b; /* Red */
        color: #fff;
    }

    .status-checked-in {
        background-color: #6bff6b; /* Green */
        color: #333;
    }

    .ticket-body p {
        margin-bottom: 0.8rem;
        color: #e0e7ff;
        font-size: 0.95rem;
    }

    .ticket-body p strong {
        color: #fff;
    }

    .ticket-footer {
        margin-top: 1.5rem;
        text-align: right;
    }

    .ticket-footer .button {
        padding: 0.8rem 1.5rem;
        font-size: 0.95rem;
        border-radius: 25px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\sam\Documents\File_Coding\HTML_CSS_JAVASCRIPT_dan_GAMBAR\Kuliah\airlines\resources\views/fitur/my_tickets.blade.php ENDPATH**/ ?>