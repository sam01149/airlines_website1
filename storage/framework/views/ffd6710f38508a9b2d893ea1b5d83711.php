

<?php $__env->startSection('title', 'Daftar Akun - Abadi Airlines'); ?>

<?php $__env->startSection('content'); ?>
<main class="form-container">
    <h1>Daftar Akun</h1>
    <?php if($errors->any()): ?>
        <div class="alert-message error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/sesi/create" method="POST" id="signup-form">
        <?php echo csrf_field(); ?>
        <div style="width:350px;"class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" value="<?php echo e(Session::get('name')); ?>" name="name" required autocomplete="name">
        </div>

        <div style="width:350px;" class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" value="<?php echo e(Session::get('email')); ?>" name="email" required autocomplete="email">
        </div>

        <div style="width:350px;" class="form-group" style="position: relative;">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            <span class="eye-icon" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <div style="width:350px;" class="form-group" style="position: relative;">
            <label for="confirm-password">Konfirmasi Password:</label>
            <input type="password" id="confirm-password" name="password_confirmation" required autocomplete="new-password">
            <span class="eye-icon" onclick="togglePassword('confirm-password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <button type="submit" class="form-submit-button">Daftar</button>
        <p class="text-center" style="margin-top: 1.5rem; color: #e0e7ff;">Sudah punya akun? <a href="/sesi" class="link-text">Login</a>.</p>
    </form>
</main>

<script>
    document.getElementById('signup-form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            alert('Password dan Konfirmasi Password harus sama!');
            event.preventDefault();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\sam\Documents\File_Coding\HTML_CSS_JAVASCRIPT_dan_GAMBAR\Kuliah\airlines\resources\views/sesi/signup.blade.php ENDPATH**/ ?>