<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RencanaKonsultasi extends Model
{
    use SoftDeletes;

    protected $table = 'rencana_konsultasi';

    protected $fillable = [
        'rencana_konsultasi_lanjut',
        'rencana_proses_melahirkan',
        'pilihan_kontrasepsi',
        'kebutuhan_konseling',
    ];

    protected $casts = [
        'rencana_konsultasi_lanjut' => 'array',
    ];
    // Relasi ke PemeriksaanKehamilan
    public function trimester3()
    {
        return $this->hasOne(Trimester3::class, 'rencana_konsultasi');
    }
}
