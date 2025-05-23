<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsgTrimester3 extends Model
{
    use SoftDeletes;

    protected $table = 'usg_trimester_3';

    protected $fillable = [
        'usg_trimester3',
        'umur_kehamilan_usg_trimester_1',
        'umur_kehamilan_usg_trimester_3',
        'selisih_uk_usg_1_hpht_dengan_trimester_3',
        'jumlah_bayi',
        'letak_bayi',
        'presentasi_bayi',
        'keadaan_bayi',
        'djj',
        'djj_status',
        'sdp',
        'lokasi_plasenta',
        'jumlah_cairan_ketuban',
        'BPD',
        'HC',
        'AC',
        'FL',
        'EFW',
        'HC_Sesuai_Minggu',
        'BPD_Sesuai_Minggu',
        'AC_Sesuai_Minggu',
        'FL_Sesuai_Minggu',
        'EFW_Sesuai_Minggu',
        'kecurigaan_temuan_abnormal',
        'keterangan',
    ];

    protected $casts = [
        'umur_kehamilan_usg_trimester_3' => 'float',
        'BPD' => 'float',
        'HC' => 'float',
        'AC' => 'float',
        'FL' => 'float',
        'EFW' => 'float',
        'HC_Sesuai_Minggu' => 'integer',
        'BPD_Sesuai_Minggu' => 'integer',
        'AC_Sesuai_Minggu' => 'integer',
        'FL_Sesuai_Minggu' => 'integer',
        'EFW_Sesuai_Minggu' => 'integer',
    ];

    public function trimester3()
    {
        return $this->hasMany(Trimester3::class, 'usg_trimester_3');
    }
}
