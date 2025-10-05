

<?php $__env->startSection('title', 'Detail Tiket Penerbangan'); ?>

<?php $__env->startSection('content'); ?>
<main class="form-container" style="max-width: 700px;">
    <h1>Detail Tiket Anda</h1>
    <p style="text-align: center; color: #e0e7ff; margin-bottom: 20px;">Pastikan detail di bawah ini sudah benar sebelum melanjutkan check-in.</p>

    <?php if($errors->any()): ?>
        <div class="alert-message error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="ticket-detail-card">
        <div class="detail-group">
            <span class="detail-label">Nama Lengkap:</span>
            <span class="detail-value"><?php echo e($ticket->nama_lengkap); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">NIK:</span>
            <span class="detail-value"><?php echo e($ticket->NIK); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Nomor Telepon:</span>
            <span class="detail-value"><?php echo e($ticket->nomor_telepon); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Jenis Kelamin:</span>
            <span class="detail-value"><?php echo e(ucfirst($ticket->jenis_kelamin)); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Lokasi Keberangkatan:</span>
            <span class="detail-value"><?php echo e($ticket->lokasi_keberangkatan); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Tujuan Penerbangan:</span>
            <span class="detail-value"><?php echo e($ticket->tujuan_penerbangan); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Tanggal Penerbangan:</span>
            <span class="detail-value"><?php echo e(\Carbon\Carbon::parse($ticket->tanggal_pemesanan)->format('d F Y')); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Harga Tiket:</span>
            <span class="detail-value">Rp <?php echo e(number_format($ticket->harga_tiket, 0, ',', '.')); ?></span>
        </div>
        <div class="detail-group">
            <span class="detail-label">Status:</span>
            <span class="detail-value status-<?php echo e(Str::slug($ticket->status)); ?>"><?php echo e($ticket->status); ?></span>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
    <?php if($ticket->status == 'belum check-in'): ?>
        <a href="<?php echo e(route('checkin.seat_selection', $ticket->id)); ?>" class="form-submit-button" style="width: auto; padding: 12px 30px; text-decoration: none;">Lanjut ke Pemilihan Kursi</a>
    <?php else: ?>
        <p style="color: #6bff6b; font-size: 1.1rem;">Anda sudah berhasil check-in untuk penerbangan ini.</p>
    <?php endif; ?>

    <a href="<?php echo e(route('my.tickets')); ?>" class="button" style="background-color: #ffd54f;padding: 12px 30px;border-radius:20px; color: black; text-decoration: none; margin-top: 15px; display: inline-block;">Kembali ke Daftar Tiket Saya</a>
</div>
</main>

<style>
    .ticket-detail-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 25px;
        margin-top: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
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

    .status-belum-check-in {
        color: #ff6b6b;
        font-weight: bold;
    }

    .status-checked-in {
        color: #6bff6b;
        font-weight: bold;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\sam\Documents\File_Coding\HTML_CSS_JAVASCRIPT_dan_GAMBAR\Kuliah\airlines\resources\views/fitur/checkin/ticket_detail.blade.php ENDPATH**/ ?>