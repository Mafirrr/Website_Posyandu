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
        'periksa_payudara',
        'periksa_pendarahan',
        'periksa_jalan_lahir',
        'vitamin_a',
        'kb_pasca_persalinan',
        'konseling',
        'tata_laksana_kasus'
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'periksa_payudara' => 'boolean',
        'periksa_pendarahan' => 'boolean',
        'periksa_jalan_lahir' => 'boolean',
        'vitamin_a' => 'boolean',
        'kb_pasca_persalinan' => 'boolean',
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
