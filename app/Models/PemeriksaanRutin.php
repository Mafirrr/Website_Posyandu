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
        'tinggi_rahim',
        'tekanan_darah_sistol',
        'tekanan_darah_diastol',
        'letak_dan_denyut_nadi_bayi',
        'lingkar_lengan_atas',
        'protein_urin',
        'tablet_tambah_darah',
        'konseling',
        'skrining_dokter',
        'tes_lab_gula_darah',
    ];

    /**
     * Relasi ke tabel pemeriksaan_kehamilan
     */

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'berat_badan' => 'float',
        'tekanan_darah_sistol' => 'integer',
        'tekanan_darah_diastol' => 'integer',
        'lingkar_lengan_atas' => 'float',
    ];
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
