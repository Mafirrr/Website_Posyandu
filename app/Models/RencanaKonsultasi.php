<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RencanaKonsultasi extends Model
{
    use SoftDeletes;

    protected $table = 'rencana_konsultasi';

    protected $fillable = [
        'pemeriksaan_id',
        'rencana_konsultasi_lanjut',
        'rencana_proses_melahirkan',
        'pilihan_kontrasepsi',
        'kebutuhan_konseling',
    ];

    // Relasi ke PemeriksaanKehamilan
    public function pemeriksaanKehamilan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
