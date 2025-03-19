<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kehamilan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kehamilan';

    protected $fillable = [
        'anggota_id',
        'tanggal_awal',
        'usia_kehamilan_awal',
        'riwayat_penyakit',
        'riwayat_kehamilan',
        'perkiraan_kehamilan',
    ];

    protected $casts = [
        'tanggal_awal' => 'date',
        'usia_kehamilan_awal' => 'integer',
        'perkiraan_kehamilan' => 'date',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function pemeriksaanTrimester1()
    {
        return $this->hasMany(PemeriksaanTrimester1::class, 'kehamilan_id');
    }

    public function pemeriksaanTrimester3()
    {
        return $this->hasMany(PemeriksaanTrimester3::class, 'kehamilan_id');
    }
}
