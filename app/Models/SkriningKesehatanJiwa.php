<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkriningKesehatanJiwa extends Model
{
    use SoftDeletes;

    protected $table = 'skrining_kesehatan_jiwa';

    protected $fillable = [
        'pemeriksaan_id',
        'skrining_jiwa',
        'tindak_lanjut_jiwa',
        'perlu_rujukan',
    ];

    public function pemeriksaanKehamilan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
