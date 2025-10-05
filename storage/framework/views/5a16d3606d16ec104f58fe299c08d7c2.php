

<?php $__env->startSection('title', 'Pesan Tiket Pesawat - Abadi Airlines'); ?>

<?php $__env->startSection('content'); ?>
<main class="form-container" style="max-width: 700px;">
    <h1>Pesan Tiket Pesawat</h1>

    <?php if($errors->any()): ?>
        <div class="alert-message error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert-message success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="/proses-pemesanan" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" required>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" value="<?php echo e(old('nomor_telepon')); ?>" required>
        </div>

       <div class="form-group">
            <label for="NIK">NIK:</label>
            <input type="number" id="NIK" name="NIK" value="<?php echo e(old('NIK')); ?>" required />
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" <?php echo e(old('jenis_kelamin') == 'laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                <option value="perempuan" <?php echo e(old('jenis_kelamin') == 'perempuan' ? 'selected' : ''); ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="lokasi_keberangkatan">Lokasi Keberangkatan:</label>
            <select id="lokasi_keberangkatan" name="lokasi_keberangkatan" required onchange="updatePrice()">
                <option value="">Pilih Lokasi Keberangkatan</option>
                <?php $__currentLoopData = $provinsiNama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($nama); ?>" <?php echo e(old('lokasi_keberangkatan') == $nama ? 'selected' : ''); ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tujuan_penerbangan">Tujuan Penerbangan:</label>
            <select id="tujuan_penerbangan" name="tujuan_penerbangan" required onchange="updatePrice()">
                <option value="">Pilih Tujuan Penerbangan</option>
                <?php $__currentLoopData = $provinsiNama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($nama); ?>" <?php echo e(old('tujuan_penerbangan') == $nama ? 'selected' : ''); ?>><?php echo e($nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_pemesanan">Tanggal Penerbangan:</label>
            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?php echo e(old('tanggal_pemesanan')); ?>" required>
        </div>

        <div class="form-group">
            <label for="referral_code">Kode Referral (Opsional):</label>
            <input type="text" id="referral_code" name="referral_code" value="<?php echo e(old('referral_code')); ?>" onkeyup="updatePrice()">
            <small style="color: #bbb; display: block; margin-top: 5px;">Masukkan kode diskon jika ada.</small>
        </div>

        <div class="price-display form-group" style="background-color: rgba(255, 255, 255, 0.15); padding: 15px; border-radius: 8px; text-align: center; font-size: 1.2rem; font-weight: 600; color: #ffd54f; margin-bottom: 20px;">
            Harga Tiket: <span id="harga_tampil">Rp 0</span>
        </div>

        <div class="form-group">
            <label for="jumlah_bayar">Jumlah Bayar (Rupiah):</label>
            <input type="number" id="jumlah_bayar" name="jumlah_bayar" value="<?php echo e(old('jumlah_bayar')); ?>" min="0" required>
        </div>

        <button type="submit" class="form-submit-button">Bayar dan Pesan Tiket</button>
    </form>
</main>

<script>
    const provinsiData = {
        'DKI Jakarta': 0,
        'Jawa Barat': 1,
        'Jawa Tengah': 2,
        'Jawa Timur': 3,
        'Bali': 4,
        'Sumatera Utara': 5,
        'Sulawesi Selatan': 6,
        'Papua': 7,
    };

    const hargaPerUnitJarak = 250000;
    const hargaDasar = 500000;

    async function calculatePriceWithDiscount(lokasiKeberangkatan, tujuanPenerbangan, referralCode = null) {
        if (!provinsiData.hasOwnProperty(lokasiKeberangkatan) || !provinsiData.hasOwnProperty(tujuanPenerbangan)) {
            return 0;
        }

        const jarakKeberangkatan = provinsiData[lokasiKeberangkatan];
        const jarakTujuan = provinsiData[tujuanPenerbangan];

        const selisihJarak = Math.abs(jarakTujuan - jarakKeberangkatan);

        let basePrice = hargaDasar + (selisihJarak * hargaPerUnitJarak);

        if (referralCode) {
            try {
                const response = await fetch('/api/check-voucher?code=' + referralCode);
                const data = await response.json();
                if (data.is_valid) {
                    const discountAmount = basePrice * (data.discount_percentage / 100);
                    basePrice -= discountAmount;
                }
            } catch (error) {
                console.error('Error fetching voucher data:', error);
            }
        }
        return basePrice;
    }

    async function updatePrice() {
        const lokasiKeberangkatan = document.getElementById('lokasi_keberangkatan').value;
        const tujuanPenerbangan = document.getElementById('tujuan_penerbangan').value;
        const referralCode = document.getElementById('referral_code').value;
        const hargaTampil = document.getElementById('harga_tampil');

        if (lokasiKeberangkatan && tujuanPenerbangan) {
            const harga = await calculatePriceWithDiscount(lokasiKeberangkatan, tujuanPenerbangan, referralCode);
            hargaTampil.innerText = 'Rp ' + harga.toLocaleString('id-ID');
        } else {
            hargaTampil.innerText = 'Rp 0';
        }
    }

    document.addEventListener('DOMContentLoaded', updatePrice);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\sam\Documents\File_Coding\HTML_CSS_JAVASCRIPT_dan_GAMBAR\Kuliah\airlines\resources\views/fitur/pesantiket.blade.php ENDPATH**/ ?>