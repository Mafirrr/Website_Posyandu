<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trimester1 extends Model
{
    use SoftDeletes;
    protected $table = 'trimester_1';

    protected $fillable = [
        'pemeriksaan_id',
        'skrining_kesehatan',
        'pemeriksaan_fisik',
        'pemeriksaan_awal',
        'pemeriksaan_khusus',
        'lab_trimester_1',
        'usg_trimester_1',
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

    public function pemeriksaanAwal()
    {
        return $this->belongsTo(PemeriksaanAwal::class, 'pemeriksaan_awal');
    }

    public function pemeriksaanKhusus()
    {
        return $this->belongsTo(PemeriksaanKhusus::class, 'pemeriksaan_khusus');
    }

    public function labTrimester1()
    {
        return $this->belongsTo(LabTrimester1::class, 'lab_trimester_1');
    }

    public function usgTrimester1()
    {
        return $this->belongsTo(UsgTrimester1::class, 'usg_trimester_1');
    }

    public function pemeriksaanRutin()
    {
        return $this->hasMany(PemeriksaanRutin::class, 'pemeriksaan_id', 'pemeriksaan_id');
    }
}
