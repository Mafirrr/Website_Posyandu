<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanFisik extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_fisik';

    protected $fillable = [
        'konjungtiva',
        'sklera',
        'kulit',
        'leher',
        'gigi_mulut',
        'tht',
        'jantung',
        'paru',
        'perut',
        'tungkai',
    ];

    /**
     * Relasi ke tabel pemeriksaan_kehamilan
     */
    public function trimester1()
    {
        return $this->hasMany(Trimester1::class, 'pemeriksaan_fisik');
    }
    public function trimester3()
    {
        return $this->hasMany(Trimester3::class, 'pemeriksaan_fisik');
    }
    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
