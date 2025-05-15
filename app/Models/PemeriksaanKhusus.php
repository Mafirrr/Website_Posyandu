<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanKhusus extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_khusus';

    protected $fillable = [
        'pemeriksaan_id',
        'porsio',
        'uretra',
        'vagina',
        'vulva',
        'fluksus',
        'fluor',
    ];

    /**
     * Relasi ke tabel pemeriksaan_kehamilan
     */
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
