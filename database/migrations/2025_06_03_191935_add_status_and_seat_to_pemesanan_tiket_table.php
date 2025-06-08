// database/migrations/YYYY_MM_DD_HHMMSS_add_status_and_seat_to_pemesanan_tiket_table.php
// (Ganti YYYY_MM_DD_HHMMSS dengan timestamp yang sesuai)
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
        Schema::table('pemesanan_tiket', function (Blueprint $table) {
            $table->string('status')->default('belum check-in')->after('tanggal_pemesanan');
            $table->string('seat_number')->nullable()->after('status');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id'); // Menambahkan user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan_tiket', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('seat_number');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};