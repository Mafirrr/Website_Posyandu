<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nifas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nifas';

    protected $fillable = [
        'anggota_id',
        'petugas_id',
        'tanggal_pemeriksaan',
        'tempat_pemeriksaan',
        'periksa_payudara',
        'periksa_pendarahan',
        'periksa_jalan_lahir',
        'vitamin_a',
        'kb_pasca_melahirkan',
        'skrining_kesehatan_jiwa',
        'konseling',
        'tata_laksana_kasus',
        'kesimpulan_ibu',
        'kesimpulan_bayi',
        'masalah_nifas',
        'kesimpulan'
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
    ];

    // Relasi ke tabel Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // Relasi ke tabel Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
