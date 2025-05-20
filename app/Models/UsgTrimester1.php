<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsgTrimester1 extends Model
{
    use SoftDeletes;

    protected $table = 'usg_trimester_1';

    protected $fillable = [
        'keteraturan_haid',
        'hpht',
        'umur_kehamilan_berdasar_hpht',
        'umur_kehamilan_berdasarkan_usg',
        'hpl_berdasarkan_hpht',
        'hpl_berdasarkan_usg',
        'jumlah_bayi',
        'jumlah_gs',
        'diametes_gs',
        'gs_hari',
        'gs_minggu',
        'crl',
        'crl_hari',
        'crl_minggu',
        'letak_produk_kehamilan',
        'pulsasi_jantung',
        'kecurigaan_temuan_abnormal',
        'keterangan',
    ];

    protected $casts = [
        'umur_kehamilan_berdasar_hpht' => 'integer',
        'umur_kehamilan_berdasarkan_usg' => 'integer',
        'diametes_gs' => 'float',
        'gs_hari' => 'integer',
        'gs_minggu' => 'integer',
        'crl' => 'float',
        'crl_hari' => 'integer',
        'crl_minggu' => 'integer',
    ];
    public function trimester1()
    {
        return $this->hasMany(Trimester1::class, 'usg_trimester_1');
    }
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
