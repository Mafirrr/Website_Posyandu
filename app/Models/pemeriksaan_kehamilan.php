<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pemeriksaan_kehamilan extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = 'pemeriksaan_kehamilan';

    protected $fillable = [
        'kehamilan_id',
        'petugas_id',
        'tanggal_periksa',
        'tempat_periksa',
        'berat_badan',
        'lingkar_lengan_atas',
        'tekanan_darah_atas',
        'tekanan_darah_bawah',
        'tinggi_rahim',
        'denyut_jantung_janin',
        'status_imunisasi_tetanus',
        'konseling',
        'skrining_dokter',
        'tambah_darah',
        'usg',
        'ppia',
        'tata_laksana_kasus'
    ];

    protected $casts = [
        'tanggal_periksa' => 'date',
        'berat_badan' => 'double',
        'lingkar_lengan_atas' => 'double',
        'tekanan_darah_atas' => 'integer',
        'tekanan_darah_bawah' => 'integer',
        'tinggi_rahim' => 'double',
        'denyut_jantung_janin' => 'integer',
    ];

    // Relasi ke tabel Kehamilan
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class, 'kehamilan_id');
    }

    // Relasi ke tabel Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
