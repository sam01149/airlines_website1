<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananTiket extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_tiket';

    protected $fillable = [
        'user_id', // Tambahkan ini
        'nama_lengkap',
        'nomor_telepon',
        'NIK',
        'jenis_kelamin',
        'tujuan_penerbangan',
        'lokasi_keberangkatan',
        'harga_tiket',
        'tanggal_pemesanan',
        'status', // Tambahkan ini
        'seat_number', // Tambahkan ini
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}