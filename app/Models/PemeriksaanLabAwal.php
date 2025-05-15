<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanLabAwal extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_lab_awal';

    protected $fillable = [
        'pemeriksaan_id',
        'hemogoblin',
        'golongan_darah_dan_rhesus',
        'gula_darah',
        'hiv',
        'sifilis',
        'hepatitis_b',
    ];

    protected $casts = [
        'hemogoblin' => 'float',
        'gula_darah' => 'float',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
