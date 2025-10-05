

<?php $__env->startSection('title', 'Dashboard - Abadi Airlines'); ?>

<?php $__env->startSection('content'); ?>
<main class="dashboard-container">
    <?php if(session('success')): ?>
        <div class="alert-message success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <h1>Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h1>
    <p style="font-size: 1.1rem; color: #e0e7ff; margin-bottom: 2.5rem;">Kelola penerbangan dan informasi akun Anda dengan mudah.</p>

    <div class="features-grid">
        <div class="feature-card">
            <h2>Pesan Tiket</h2>
            <p>Jelajahi destinasi kami dan pesan tiket penerbangan Anda dengan cepat dan mudah.</p>
            <a href="/pesan-tiket" class="button">Pesan Sekarang</a>
        </div>

        <div class="feature-card">
            <h2>Check-in Online</h2>
            <p>Lakukan check-in penerbangan Anda dari mana saja dan pilih kursi favorit Anda.</p>
            <a href="/check-in-list" class="button">Mulai Check-in</a>
        </div>

        <div class="feature-card">
            <h2>Tiket Saya</h2>
            <p>Lihat semua tiket yang telah Anda pesan dan status check-in Anda.</p>
            <a href="/my-tickets" class="button">Lihat Tiket</a>
        </div>

        <div class="feature-card">
            <h2>Detail Profil</h2>
            <p>Perbarui informasi pribadi dan kelola preferensi akun Anda.</p>
            <a href="/profile-detail" class="button">Lihat Profil</a>
        </div>

        

        <div class="feature-card">
            <h2>Bantuan & FAQ</h2>
            <p>Temukan jawaban atas pertanyaan umum Anda dan dapatkan bantuan.</p>
            <a href="/faq" class="button">Dapatkan Bantuan</a> 
        </div>

        <div class="feature-card">
            <h2>Penawaran Spesial</h2>
            <p>Dapatkan informasi terbaru tentang promo dan diskon penerbangan.</p>
            <a href="/special-offers" class="button">Lihat Penawaran</a> 
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\sam\Documents\File_Coding\HTML_CSS_JAVASCRIPT_dan_GAMBAR\Kuliah\airlines\resources\views/dashboard.blade.php ENDPATH**/ ?>