<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_telepon');
            $table->string('NIK');
            $table->string('jenis_kelamin');
            $table->string('tujuan_penerbangan');
            $table->string('lokasi_keberangkatan'); // Kolom baru untuk lokasi keberangkatan
            $table->decimal('harga_tiket', 10, 2); // Kolom baru untuk harga tiket
            $table->date('tanggal_pemesanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_tiket');
    }
};