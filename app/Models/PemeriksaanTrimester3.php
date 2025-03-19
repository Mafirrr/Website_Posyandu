<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanTrimester3 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemeriksaan_trimester3';

    protected $fillable = [
        'kehamilan_id',
        'petugas_id',
        'tanggal_pemeriksaan',
        'konjungtiva',
        'sklera',
        'kulit',
        'leher',
        'gigi_mulut',
        'tht',
        'jantung',
        'paru',
        'perut',
        'tungkai',
        'janin',
        'jumlah_janin',
        'letak_janin',
        'berat_janin',
        'plasenta',
        'usia_kehamilan',
        'protein_urine',
        'urine_produksi',
        'rencana_konsultasi_lanjut',
        'rencana_persalinan',
        'rencana_kontrasepsi',
        'konseling'
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'berat_janin' => 'double',
        'protein_urine' => 'double',
        'usia_kehamilan' => 'integer',
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
