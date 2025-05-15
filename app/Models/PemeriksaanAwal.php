<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanAwal extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_awal';

    protected $fillable = [
        'pemeriksaan_id',
        'tinggi_badan',
        'golongan_darah',
        'status_imunisasi',
        'hemogoblin',
        'gula_darah_puasa',
        'riwayat_kesehatan_ibu_sekarang',
        'riwayat_perilaku',
        'riwayat_penyakit_keluarga',
    ];

    protected $casts = [
        'riwayat_kesehatan_ibu_sekarang' => 'array',
        'riwayat_perilaku' => 'array',
        'riwayat_penyakit_keluarga' => 'array',
        'gula_darah_puasa' => 'float',
        'hemogoblin' => 'float',
        'tinggi_badan' => 'float',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
