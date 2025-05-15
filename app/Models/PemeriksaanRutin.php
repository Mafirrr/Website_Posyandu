<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanRutin extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_rutin';

    protected $fillable = [
        'pemeriksaan_id',
        'berat_badan',
        'tekanan_darah_sistol',
        'tekanan_darah_diastol',
        'letak_dan_denyut_nadi_bayi',
        'lingkar_lengan_atas',
    ];

    /**
     * Relasi ke tabel pemeriksaan_kehamilan
     */
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
