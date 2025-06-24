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
        'pemeriksaan_id',
        'bagian_kf',
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

    //relasi table pemeriksaan
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
