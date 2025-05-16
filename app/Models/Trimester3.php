<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trimester3 extends Model
{
    use SoftDeletes;

    protected $table = 'trimester_3';

    protected $fillable = [
        'pemeriksaan_id',
        'skrining_kesehatan',
        'pemeriksaan_fisik',
        'lab_trimester_3',
        'usg_trimester_3',
        'rencana_konsultasi',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }

    public function skriningKesehatan()
    {
        return $this->belongsTo(SkriningKesehatanJiwa::class, 'skrining_kesehatan');
    }

    public function pemeriksaanFisik()
    {
        return $this->belongsTo(PemeriksaanFisik::class, 'pemeriksaan_fisik');
    }

    public function labTrimester3()
    {
        return $this->belongsTo(LabTrimester3::class, 'lab_trimester_3');
    }

    public function usgTrimester3()
    {
        return $this->belongsTo(UsgTrimester3::class, 'usg_trimester_3');
    }

    public function rencanaKonsultasi()
    {
        return $this->belongsTo(RencanaKonsultasi::class, 'rencana_konsultasi');
    }
}
